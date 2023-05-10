<?php

namespace App\EventSubscriber;

use App\Repository\ProductRepository;
use App\Service\LoadData;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class LoadDataSubscriber implements EventSubscriberInterface
{
    private $loadData;
    private $twig;

    public function __construct(LoadData $loadData, Environment $twig)
    {
        $this->twig = $twig;
        $this->loadData = $loadData;
    }
    public function onKernelController(ControllerEvent $event): void
    {
        $data = $this->loadData->loadData();
        $this->twig->addGlobal("data" , $data);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
