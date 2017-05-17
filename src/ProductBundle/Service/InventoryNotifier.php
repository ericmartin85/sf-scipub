<?php

namespace ProductBundle\Service;

use Symfony\Component\Templating\EngineInterface;

class InventoryNotifier
{
    /**
     * @var InventoryCheckerInterface
     */
    private $checker;

    /**
     * @var EngineInterface
     */
    private $twig;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var string
     */
    private $email;


    /**
     * Constructor.
     *
     * @param InventoryCheckerInterface $checker
     * @param EngineInterface  $twig
     * @param \Swift_Mailer    $mailer
     * @param string           $email
     */
    public function __construct(
        InventoryCheckerInterface $checker,
        EngineInterface $twig,
        \Swift_Mailer $mailer,
        $email
    ) {
        $this->checker = $checker;
        $this->twig = $twig;
        $this->mailer = $mailer;
        $this->email = $email;
    }

    /**
     * Sends a report to the administrator about 'out of stock' products.
     */
    public function notify()
    {
        // Récupérer les produits en rupture en utilisant le service InventoryChecker
        $products = $this->checker->check();

        // Faire le rendu d'un template : rapport d'inventaire
        $body = $this->twig->render('ProductBundle:Email:inventory.html.twig', [
            'products' => $products,
        ]);

        // Envoyer le rapport par mail à l'administrateur
        $message = \Swift_Message::newInstance()
            ->setFrom($this->email)
            ->setTo($this->email)
            ->setBody($body, 'text/html');

        return $this->mailer->send($message);
    }
}