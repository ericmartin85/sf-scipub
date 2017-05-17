<?php

namespace HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * @Route(
     *     "/customer/list",
     *     name="customer_list"
     * )
     */
    public function listAction()
    {
        $url = $this->generateUrl('customer_new');
        $urlDetail = $this->generateUrl('customer_detail', [
            'id' => 123
        ]);

        return new Response(
            'Liste des clients<br>' .
            '<a href="' . $url . '">Nouveau client</a><br>' .
            '<a href="' . $urlDetail . '">Clinet détail</a>'
        );
    }

    /**
     * @Route(
     *     "/customer/new",
     *     name="customer_new"
     * )
     */
    public function newAction()
    {
        return new Response('Nouveau client');
    }

    /**
     * @Route(
     *     "/customer/{id}",
     *     name="customer_detail",
     *     requirements={"id": "\d+"}
     * )
     */
    public function detailAction($id)
    {
        return new Response('Détail du client ' . $id);
    }

    /**
     * @Route(
     *     "/customer/{id}/update",
     *     name="customer_update",
     *     requirements={"id": "\d+"}
     * )
     */
    public function updateAction($id)
    {
        return new Response('Mise à jour du client ' . $id);
    }
}
