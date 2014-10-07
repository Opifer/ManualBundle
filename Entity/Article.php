<?php

namespace Opifer\ManualBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Help
 *
 * @ORM\Table(name="help_article", indexes={@ORM\Index(columns={"title"}, name="search_idx")})
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Opifer\ManualBundle\Entity\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="articles", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @return string $title
     */
    public function __toString()
    {
        return $this->getTitle();
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
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->setSlug($title);

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
     *
     * @param string $title the title to create the slug from
     *
     * @return Article
     */
    public function setSlug($title)
    {
        $this->slug = $this->createSlug($title);

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
     * Set category
     *
     * @param string $category
     *
     * @return Article
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Generates a slug from the Title,
     * and it lowercases the title for use in a URL
     * Furthermost it gets rid of any unwated characters.
     *
     * @param $title the title gotten from the file / folder names
     *
     * @return string $title the title generated from the slug
     */
    public function createSlug($title)
    {
        $title = preg_replace('#[^\\pL\d]+#u', '-', $title);
        $title = trim($title, '-');

        if (function_exists('inconv'))
        {
            $title = iconv('utf-8', 'us-ascii//TRANSLIT', $title);
        }

        $title = strtolower($title);
        $title = preg_replace('#[^-\w]+#', '', $title);

        if (empty($title))
        {
            return 'n-a';
        }

        return $title;
    }
}
