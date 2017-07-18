<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO") 
     * @Serializer\Expose
     *  
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Groups({"GET_SHOW"}) 
     * @Serializer\Expose
     * @Assert\NotBlank(groups={"Create"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Groups({"GET_SHOW"})   
     * @Serializer\Expose
     * @Assert\NotBlank(groups={"Create"})
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Author", cascade={"all"}, fetch="EAGER")
     * @Serializer\Groups({"GET_SHOW","GET_LIST"})  
     * @Serializer\Expose
     */
    private $author;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(Author $author)
    {
        $this->author = $author;
    }
}
