<?php

namespace HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

/**
 * Joue le rôle le préfix :
 * @Route("/blog")
 */
class BlogController extends Controller
{
    /**
     * Route réelle :
     * @Route(
     *     "/{page}",
     *     name="blog_list",
     *     defaults={"page": 1},
     *     requirements={"page": "\d+"}
     * )
     */
    public function listAction($page)
    {
        return $this->render('HelloBundle:Default:index.html.twig');

        //return new Response('Blog list: ' . $page);
    }

    /**
     * @Route(
     *     "/{slug}.{_format}",
     *     name="blog_detail",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "slug": "[a-z-]+",
     *         "_format": "html|json"
     *     }
     * )
     */
    public function detailAction($slug, $_format)
    {
        if ($_format === 'json') {
            return new Response(json_encode([
                'content' => $slug
            ]));
        }

        return new Response('Blog detail: ' . $slug . ' . ' . $_format);
    }
}
