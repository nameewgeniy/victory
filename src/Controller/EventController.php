<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Services\EventServiceInterface;
use App\Dto\EventDataDto;
use App\Entity\Post;
use App\Entity\Teaser;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use WhichBrowser\Parser;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/view/{post}', name: 'app_event_view', methods: ['GET'])]
    public function index(Post $post, Request $request, EventServiceInterface $service): Response
    {
        $parser = new Parser($request->headers->get('User-Agent'));

        $service->makeViewPostEvent($post, new EventDataDto(
            device: $parser->device->type ?? '',
            os: $parser->os->name ?? '',
            model: $parser->device->model ?? '',
            geo: 'Краснодар',
            ip: $request->getClientIp() ?? '',
            browser: $parser->browser->name ?? ''
        ));

        return new Response(status: 204);
    }

    #[Route('/teaser/view/{teaser}/{post}', name: 'app_event_teaser_view', methods: ['GET'])]
    public function teaserView(Teaser $teaser, Post $post, Request $request, EventServiceInterface $service): Response
    {
        $parser = new Parser($request->headers->get('User-Agent'));

        $service->makeTeaserViewEvent($teaser, $post, new EventDataDto(
            device: $parser->device->type ?? '',
            os: $parser->os->name ?? '',
            model: $parser->device->model ?? '',
            geo: 'Краснодар',
            ip: $request->getClientIp() ?? '',
            browser: $parser->browser->name ?? ''
        ));

        return new Response(status: 204);
    }

    #[Route('/teaser/click/{teaser}/{post}', name: 'app_event_teaser_click', methods: ['GET'])]
    public function teaserClick(Teaser $teaser, Post $post, Request $request, EventServiceInterface $service): Response
    {
        $parser = new Parser($request->headers->get('User-Agent'));

        $service->makeTeaserClickEvent($teaser, $post, new EventDataDto(
            device: $parser->device->type ?? '',
            os: $parser->os->name ?? '',
            model: $parser->device->model ?? '',
            geo: 'Краснодар',
            ip: $request->getClientIp() ?? '',
            browser: $parser->browser->name ?? ''
        ));

        return new Response(status: 204);
    }

    #[Route('/all', name: 'app_event_all', methods: ['GET'])]
    public function view(EventRepository $repository): Response
    {
        return new Response();
    }
}
