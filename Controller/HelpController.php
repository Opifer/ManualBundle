<?php

namespace Opifer\ManualBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Annotation\Route;

class HelpController extends Controller
{
    /**
     * @Route("/help", name="opifer.manual.help.index", options={"expose"=true})
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function helpAction(Request $request)
    {
        $catRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Category');
        $categories = $catRepo->findAll();

        return $this->render('OpiferManualBundle:Help:index.html.twig', [            
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/help/{slug}", name="opifer.manual.help.show", options={"expose"=true})
     *
     * @param string $slug the slug use to get the article
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function showArticleAction($slug)
    {
        $articleRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Article');
        $article = $articleRepo->findOneBySlug($slug);

        return $this->render('OpiferManualBundle:Help:showArticle.html.twig', [
            'article' => $article,
        ]);
    }
}