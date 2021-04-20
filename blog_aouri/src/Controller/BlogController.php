<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BlogController extends AbstractController
{
    public function index()
    {
        return $this->render('blog/index.html.twig');
    }
     


    /**
     * @Route("/show", name="article_show")
     */

    public function show()
    {
    	return $this->render('blog/show.html.twig', [
        ]);
    }
    
      /**
     * @Route("/edit", name="edit_article")
     */
    public function edit($id)
    {
    	return $this->render('blog/edit.html.twig', [
            'slug' => $id
        ]);
    }


     /**
     * @Route("/add", name="form_add")
     */
    public function add(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article->setCreatedAt(new \DateTime());
            $article->setAuthor($this->getUser()->getEmail()); 

            if ($article->getIsPublished()) {
                $article->setUpdatedAt(new \DateTime());
            }

            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($article); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

            return new Response('L\'article a bien été enregistrer.');
        }

    	return $this->render('blog/add.html.twig', [
            'form' => $form->createView()
        ]);
    }





    public function remove($id)
    {
    	return new Response('<h1>Delete article: ' .$id. '</h1>');
    }

}   