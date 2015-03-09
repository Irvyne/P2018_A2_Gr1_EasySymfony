<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/app/test", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/hello/{name}", name="hello_world")
     */
    public function helloWorldAction($name)
    {
        return $this->render('AppBundle::hello-world.html.twig', [
            'name' => $name,
        ]);
    }

    /**
     * @Route(
     *      "/{year}-{month}-{day}-{name}/{page}",
     *      requirements={
     *          "year"="\d{4}",
     *          "month"="\d{2}",
     *          "day"="\d{2}",
     *          "page"="\d+"
     *      },
     *      defaults={
     *          "page"="1"
     *      },
     *      name="article"
     * )
     */
    public function articleAction($year, $month, $day, $name, $page)
    {
        return new Response('Article, page '.$page);
    }

    /**
     * @ParamConverter
     * @Route("/article/{id}", name="abc")
     */
    public function catchAllAction(Article $article)
    {
        return $this->render('default/index.html.twig');
    }
}
