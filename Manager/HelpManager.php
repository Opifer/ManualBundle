<?php

namespace Opifer\ManualBundle\Manager;

use Opifer\ManualBundle\Entity\Article;
use Opifer\ManualBundle\Entity\Category;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Finder\Finder;

/**
 * Class HelpManager
 *
 * A helper class to help with the
 *
 * @package Opifer\ManualBundle\Manager
 */
class HelpManager
{
    protected $container;
    protected $bundles = [];

    /**
     * @param array                                            $bundles the bundles loaded from the config.yml
     * @param \Symfony\Component\DependencyInjection\Container $container the application container
     */
    public function __construct(array $bundles, Container $container)
    {
        $this->bundles = $bundles;
        $this->container = $container;

        $this->setBundles($bundles);
    }

    /**
     * @param array $bundles the bundles prepended by a @ sign.
     */
    public function setBundles($bundles)
    {
        foreach ($bundles as $key => $value)
        {
            $this->bundles[$key] = '@'.$value.'/Resources/manual';

        }
    }

    /**
     * Get the prepared bundles.
     * prepared means they are ready for the finder to look into for the markdown files.
     *
     * @return array $preparedBundles
     */
    public function getBundles()
    {
        return $this->bundles;
    }

    public function indexArticles()
    {
        $em = $this->container->get('doctrine')->getManager();

        $categories = $this->prepareItems();

        // Get the prefix used to prefix for the tables.
        $dbPrefix = $this->container->getParameter('database_table_prefix');

        // Refreshing the database
        $this->refreshTables(
            [
                "{$dbPrefix}help_article",
                "{$dbPrefix}help_category"
            ]
        );

        foreach($categories as $category => $articles)
        {
            $categoryEntity = new Category();
            $categoryEntity->setTitle($category);
            $em->persist($categoryEntity);

           foreach($articles as $article)
           {
               $articleEntity = new Article();
               $articleEntity->setTitle($article['title']);
               $articleEntity->setCategory($categoryEntity);
               $articleEntity->setContent($article['content']);
               $articleEntity->setUpdatedAt($article['updated_at']);
               $em->persist($articleEntity);
           }
        }
        $em->flush(); // flushes the change to the database
    }

    /**
     * Prepares the items before they are passed to the command.
     *
     * @return array $categories
     *          An array of categories with an array of $articles
     */
    public function prepareItems()
    {
        $fileLocator = $this->container->get('file_locator');

        foreach ($this->getBundles() as $key => $path)
        {
            $path = $fileLocator->locate($path);

            $filesInPath = new Finder();
            $filesInPath->in($path)->files();

            foreach ($filesInPath as $file)
            {
                $content = $file->getContents();

                $lastUpdated = \date_timestamp_set(\date_create(), filemtime($file));

                // Split the string into
                $raw = $file->getRelativePathname();
                $rawExplode = explode('/', $raw);

                $url = $rawExplode[1];
                $url1 = explode('.', $url); // drop the extension at the end.
                $url = $url1[0]; // the slug without the file extension.

                $category = $rawExplode[0]; // get the folder names as category names.

                $articles =
                    [
                        'title' => $url,
                        'content' => $content,
                        'updated_at' => $lastUpdated
                    ];

                $categories[$category][] = $articles;
            }
        }
        return $categories;
    }

    /**
     * Refreshes the help tables so the articles/categories
     * don't get inserted each time you run the command.
     * This function can also be used out side of the command.
     */
    public function refreshTables()
    {
        $em = $this->container->get('doctrine')->getManager();
        $repository = $this->container->get('doctrine')->getRepository('OpiferManualBundle:Category');
        $categories = $repository->findAll();

        foreach($categories as $category)
        {
            $em->remove($category);
        }
        $em->flush();
    }
}