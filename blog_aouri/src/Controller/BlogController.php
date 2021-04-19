<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
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
    public function add()
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

    	return $this->render('blog/add.html.twig', [
            'form' => $form->createView()
        ]);
    }




    public function remove($id)
    {
    	return new Response('<h1>Delete article: ' .$id. '</h1>');
    }

}   