<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $editedAt;

    /**
     * @ORM\ManyToMany(targetEntity="Keyword", inversedBy="article", cascade={"persist"})
     * @ORM\JoinTable(
     *  name="article_keyword",
     *  joinColumns={
     *      @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="keyword_id", referencedColumnName="id")
     *  }
     * )
     */
    private $keywords;


    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="article", cascade={"persist"})
     * @ORM\JoinTable(
     *  name="article_category",
     *  joinColumns={
     *      @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     *  }
     * )
     */
    private $categories;


    /**
    * @ORM\OneToMany(targetEntity="Comment", cascade={"persist", "remove"}, mappedBy="article")
    */
    protected $comments;


    public function __construct()
    {
        $this->publishedAt  = new DateTime(); 
        $this->editedAt     = new DateTime(); 
        $this->keywords     = new ArrayCollection();
        $this->categories   = new ArrayCollection();
    }
    


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getEditedAt(): ?\DateTimeInterface
    {
        return $this->editedAt;
    }

    public function setEditedAt(?\DateTimeInterface $editedAt): self
    {
        $this->editedAt = $editedAt;

        return $this;
    }

    public function addKeyword(Keyword $keyword): self
    {
        $this->keywords[] = $keyword;
 
        return $this;
    }
 
    public function removeKeyword(Keyword $keyword): bool
    {
        return $this->keywords->removeElement($keyword);
    }
 
    public function getKeywords(): Collection
    {
        return $this->keywords;
    }



    public function addCategory(Category $category): self
    {
        $this->categories[] = $category;
 
        return $this;
    }
 
    public function removeCategory(Category $category): bool
    {
        return $this->categories->removeElement($category);
    }
 
    public function getCategories(): Collection
    {
        return $this->categories;
    }
    

    public function getComments()
    {
        return $this->comments;
    }
}
