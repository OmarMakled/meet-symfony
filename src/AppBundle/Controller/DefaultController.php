<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="show_posts", methods={"GET", "POST"})
     * @Route("/{id}", name="update_post", methods={"GET", "POST"})
     */
    public function indexAction(Request $request, $id = null)
    {
        $em = $this->getDoctrine()->getManager();

        $post = (! $id) ? new Post : $em->getRepository(Post::class)->find($id);

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class)
            ->add('body', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Post'))
            ->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) {
            $em->persist($post);
            $em->flush();

            return $this->redirect('/ar');
        }

        $posts = $em->getRepository(Post::Class)->findAll();
        return $this->render('default/index.html.twig', [
            'posts'     =>  $posts,
            'form'      =>  $form->createView()
        ]);
    }
}
