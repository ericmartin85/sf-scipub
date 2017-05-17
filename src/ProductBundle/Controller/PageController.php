<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function homeAction()
    {
        // Récupérer la liste de catégories
        $categories = $this
            ->getDoctrine()
            ->getRepository('ProductBundle:Category')
            ->findAll();

        return $this->render('ProductBundle:Page:home.html.twig', [
            'category_list' => $categories,
        ]);
    }

    public function categoryAction($categorySlug)
    {
        $category = $this
            ->getDoctrine()
            ->getRepository('ProductBundle:Category')
            ->findOneBy(['slug' => $categorySlug]);

        return $this->render('ProductBundle:Page:category.html.twig', [
            'category' => $category,
        ]);
    }

    public function productAction($categorySlug, $productSlug)
    {
        $category = $this
            ->getDoctrine()
            ->getRepository('ProductBundle:Category')
            ->findOneBy(['slug' => $categorySlug]);

        // Récupérer le Product d'après le paramètre $productSlug
        $product = $this
            ->getDoctrine()
            ->getRepository('ProductBundle:Product')
            ->findOneBy([
                'category' => $category,
                'slug'     => $productSlug,
            ]);

        // Renvoyer le rendu du template product.html.twig
        //  (dans ce template, afficher la designation et la description
        //   du produit).
        return $this->render('ProductBundle:Page:product.html.twig', [
            'product' => $product,
        ]);
    }
}
