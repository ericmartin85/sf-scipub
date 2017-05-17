<?php

namespace ProductBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CheckProductCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        // php app/console product:check-product
        $this->setName('product:check-product');

        $this->addArgument('productId', InputArgument::OPTIONAL, 'Identifiant');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repository = $this
            ->getContainer()
            ->get('doctrine')
            ->getRepository('ProductBundle:Product');

        $productId = intval($input->getArgument('productId'));
        if (0 == $productId) {
            $helper = $this->getHelper('question');

            $question = new Question('Please enter id of the product [null]: ');


            $productId = intval($helper->ask($input, $output, $question));
        }

        if (0 < $productId) {
            $products = $repository->findBy(['id' => $productId]);
        } else {
            $products = $repository->findAll();
        }

        if (empty($products)) {
            $output->writeln('Aucun produit');
            return;
        }

        // use Symfony\Component\Console\Helper\Table;
        $table = new Table($output);
        $table->setHeaders(['Désignation', 'Stock']);
        /** @var \ProductBundle\Entity\Product[] $products */
        foreach ($products as $product) {
            $table->addRow([
                $product->getDesignation(),
                $product->getStock()
            ]);
        }
        $table->render();
    }
}
