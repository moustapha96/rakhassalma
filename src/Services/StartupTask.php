<?php


namespace App\Services;

use App\Entity\TableCounter;
use App\Repository\TableCounterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mailer\MailerInterface;

use Symfony\Component\String\UnicodeString;

/**
 * @Service()
 * @Tag(name="kernel.event_listener", event=KernelEvents::REQUEST)
 */

class StartupTask  implements EventSubscriberInterface
{

    public $em;
    public $repo;
    public      $mailer;
    public function __construct(
        EntityManagerInterface $em,
        MailerInterface $mailer,
    ) {
        $this->em = $em;
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

    public function onKernelController(ControllerEvent $event)
    {
        $request = $event->getRequest();
        $setting = [];
    }
}
