<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Movie;
use App\Services\ApiPosterUrlService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExternalApiPosterUrlSubscriber implements EventSubscriberInterface
{
    private $apiPosterUrlService;

    public function __construct(ApiPosterUrlService $apiPosterUrlService)
    {
        $this->apiPosterUrlService = $apiPosterUrlService;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $movie = $event->getRequest()->attributes->get('data');

        if (!$movie instanceof Movie) {
            return;
        }

        $externalData = $this->apiPosterUrlService->getPoster($movie->getTitle(), $movie->getId());

        // Add the external data to the movie entity
        $movie->externalApiPosterUrl = $externalData;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['onKernelRequest', EventPriorities::PRE_READ],
        ];
    }
}
