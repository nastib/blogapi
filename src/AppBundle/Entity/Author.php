<?php

namespace AppBundle\Entity;

use Hateoas\Configuration\Annotation as Hateoas;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table()
 * @Serializer\ExclusionPolicy("ALL")
 * 
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_author_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups = {"GET_SHOW","GET_LIST"})  
 * ) 
 */ 

class Author
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"GET_SHOW","GET_LIST"})  
     * @Serializer\Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Groups({"GET_SHOW","GET_LIST"}) 
     * @Serializer\Expose 
     */
    private $fullname;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Groups({"GET_SHOW","GET_LIST"}) 
     * @Serializer\Expose 
     */
    private $biography;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author", cascade={"persist"}) 
     * @*Serializer\Groups({"GET_SHOW","GET_LIST"})  
     * @*Serializer\Expose 
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    public function getBiography()
    {
        return $this->biography;
    }

    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    public function getArticles()
    {
        return $this->articles;
    }
}
