<?php

namespace AppBundle\Entity;

use Hateoas\Configuration\Annotation as Hateoas;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 * @Serializer\ExclusionPolicy("ALL")
 * 
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_article_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"GET_SHOW","GET_LIST"})   
 * ) 
 * 
 * @Hateoas\Relation(
 *      "modify",
 *      href = @Hateoas\Route(
 *          "app_article_update",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"GET_SHOW","GET_LIST"}) 
 * )
 * 
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "app_article_update",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"GET_SHOW","GET_LIST"}) 
 * )
 * 
 * @Hateoas\Relation( 
 *   "author", 
 *   embedded = @Hateoas\Embedded("expr(object.getAuthor())"),
 *   exclusion = @Hateoas\Exclusion(groups = {"GET_SHOW"}) 
 * ) 
 * 
 * 
 * @Hateoas\Relation(
 *     "weather",
 *     embedded = @Hateoas\Embedded("expr(service('app.weather').getCurrent())")
 * )  
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO") 
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"GET_LIST"})  
     * @Serializer\Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @*Serializer\Since("1.0")
     * @Assert\NotBlank(groups={"Create"})
     * @Serializer\Groups({"GET_SHOW","GET_LIST"}) 
     * @Serializer\Expose 
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Since("1.0")
     * @Assert\NotBlank(groups={"Create"})
     * @Serializer\Groups({"GET_SHOW","GET_LIST"})  
     * @Serializer\Expose
     */
    private $content;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Since("2.0") 
     * @Serializer\Groups({"GET_SHOW","GET_LIST"})
     * @Serializer\Expose  
     */
    private $shortDescription;  
    
    /**
     * @ORM\ManyToOne(targetEntity="Author", cascade={"all"}, fetch="EAGER")
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"GET_LIST"})
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

    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }
 
    
}