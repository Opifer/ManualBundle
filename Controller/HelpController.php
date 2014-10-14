<?php

namespace Opifer\ManualBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class HelpController
 *
 * This is the controller responsible for the help functionality
 * Please note that all routes defined in this bundle are prefixed by /admin
 * This is set in Resources/config/routing.yml
 *
 * The prefix route used by all the actions below:
 * @Route("/admin/help")
 *
 * @package Opifer\ManualBundle\Controller
 */
class HelpController extends Controller
{
    /**
     * @Route("/", name="opifer.manual.help.index", options={"expose"=true})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function helpAction()
    {
        $catRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Category');
        $categories = $catRepo->findAll();

        return $this->render('OpiferManualBundle:Help:index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/search", name="opifer.manual.help.search", options={"expose"=true})
     * @Method({"POST"})
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $searchQuery = $request->get('searchForm');
        $artRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Article');
        $serializer = $this->container->get('jms_serializer');


        // Set search result to be the serialized database entities it the search box is not empty
        if ($searchQuery != "")
        {
            $searchResult = $artRepo->getSearchedArticles($searchQuery);
            $searchResult = $serializer->serialize($searchResult, 'json'); // Serialized the entity
            $response = array ("responseCode" => 200, "searchResult" => $searchResult);
        }
        // If it is empty, set an errorMessage
        else
        {
            $response = array ("responseCode" => 400, "errorMessage" => "No entries found, try to enter some text.");
        }

        $response = json_encode($response); //json encode the array
        return new Response($response, 200, array ('Content-Type' => 'application/json'));
    }

    /**
     * @Route("/{slug}", name="opifer.manual.help.show", options={"expose"=true})
     *
     * @param string $slug the slug use to get the article
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticleAction($slug)
    {
        $articleRepo = $this->getDoctrine()->getRepository('OpiferManualBundle:Article');
        $article = $articleRepo->findOneBySlug($slug);

        if(empty($article))
        {
            throw $this->createNotFoundException("No article found with slug: ". $slug);
        }

        return $this->render('OpiferManualBundle:Help:showArticle.html.twig', [
            'article' => $article,
        ]);
    }
}