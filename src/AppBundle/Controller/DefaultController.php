<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::Class)->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'posts' =>  $posts
        ]);
    }
}
