<?php

namespace App\Command;

use App\Service\MySlugger;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSlugifyCommand extends Command
{
    protected static $defaultName = 'ProductSlugify';
    protected static $defaultDescription = 'Add a short description for your command';

    private $mySlugger;
    private $productRepository;
    private $entityManager;


    public function __construct(ProductRepository $productRepository, MySlugger $mySlugger, ManagerRegistry $doctrine)
    {
        $this->productRepository = $productRepository;
        $this->mySlugger = $mySlugger;
        $this->entityManager = $doctrine->getManager();

        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->info('Mise à jour de nos slug dans la bdd');

        $products = $this->productRepository->findAll();

        foreach ($products as $product) 
        {
            $name = $product->getName();
            $product->setSlug($this->mySlugger->slugify($name));

            $this->entityManager->flush();
            
        }





        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
