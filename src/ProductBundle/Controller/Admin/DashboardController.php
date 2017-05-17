<?php

namespace ProductBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('ProductBundle:Admin/Dashboard:index.html.twig');
    }
}