<?php

namespace ProductBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class InventoryCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('product:inventory');

        $this->addOption('notify', null, InputOption::VALUE_NONE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // use Symfony\Component\Console\Input\InputOption

        // php app/console product:inventory --notify
        if ($input->getOption('notify')) {
            /** @var \ProductBundle\Service\InventoryNotifier $notifier */
            $notifier = $this->getContainer()->get('product.inventory.notifier');

            $sent = $notifier->notify();

            $output->writeln($sent . ' email(s) envoyés.');

            return;
        }

        /** @var \ProductBundle\Service\InventoryChecker $checker */
        $checker = $this->getContainer()->get('product.inventory.checker');

        $products = $checker->check();

        $output->writeln(count($products) . ' produits en rupture.');
    }
}