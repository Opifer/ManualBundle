<?php

namespace Opifer\ManualBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HelpController extends Controller
{
    /**
     * @Route("/help", name="opifer.manual.help.index", options={"expose"=true})
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function helpAction(Request $request)
    {
        $search_form = $this->createFormBuilder()
            ->add('search-field', 'search', ['required' => false])
            ->add('search', 'submit')
            ->getForm();

        $catRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Category');
        $categories = $catRepo->findAll();

        $search_form->handleRequest($request);
        if ($request->isMethod('POST'))
        {
            $data = $search_form->getData();
            
            $artRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Article');
            $articles = $artRepo->getSearchedArticles($data[ 'search-field' ]);
            return $this->render('OpiferManualBundle:Help:search.html.twig', [
                'articles'    => $articles,
                'search_form' => $search_form->createView(),
            ]);
        }

        return $this->render('OpiferManualBundle:Help:index.html.twig', [
            'categories'  => $categories,
            'search_form' => $search_form->createView(),
        ]);
    }

    /**
     * @Route("/help/{slug}", name="opifer.manual.help.show", options={"expose"=true})
     *
     * @param string $slug the slug use to get the article
     *
     * @return \Symfony\Component\HttpFoundation\Response
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