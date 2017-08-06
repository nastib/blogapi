<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\RestBundle\Request\ParamFetcherInterface;
use AppBundle\Representation\Articles;
use Symfony\Component\Validator\ConstraintViolationList;
use AppBundle\Exception\ResourceValidationException;
use Hateoas\HateoasBuilder;

class AuthorController extends FOSRestController
{
     /**
     * @Get(
     *     path = "/authors/{id}",
     *     name = "app_author_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View(
     *     statusCode = 200,
      *    serializerGroups = {"GET_SHOW","GET_LIST"}
     * )
     * 
     */
    public function showAction(Author $author)
    {
        //dump($author); die; 
        return $author;
        
    }
}
