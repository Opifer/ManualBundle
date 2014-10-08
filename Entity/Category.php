<?php

namespace Opifer\ManualBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Opifer\ManualBundle\Entity\Article;

/**
 * Category
 *
 * @ORM\Table(name="help_category")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Opifer\ManualBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="category", cascade={"all"})
     */
    private $articles;

    /**
     * Sets the articles variable to be a new ArrayCollection.
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    /**
     * @return string $title the title to be handled as string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Set Article
     *
     * @param string $articles
     * @return Article $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * get article
     *
     * @return string $article
     */
    public function getArticles()
    {
        return $this->articles;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     * Automagically sets the slug
     * to be the slugified $title
     *
     * @param string $title
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->setSlug($this->title);

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     * Uses createSlug to make a slug from the title.
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $this->createSlug($slug);

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add articles
     *
     * @param Article $articles
     * @return Category
     */
    public function addArticle(Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param Article $articles
     */
    public function removeArticle(Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Generates a slug from the Title,
     * and it lowercases the title for use in a URL
     * Furthermost it gets rid of any unwated characters.
     *
     * @param $title
     * @return string $title
     */
    public function createSlug($title)
    {
        $title = preg_replace('#[^\\pL\d]+#u', '-', $title);
        $title = trim($title, '-');

        if(function_exists('inconv'))
            $title = iconv('utf-8', 'us-ascii//TRANSLIT', $title);

        $title = strtolower($title);
        $title = preg_replace('#[^-\w]+#', '', $title);

        if(empty($title))
        {
            return 'n-a';
        }

        return $title;
    }
}
