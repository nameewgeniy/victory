<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Services\EventServiceInterface;
use App\Dto\EventDataDto;
use App\Entity\Event;
use App\Entity\Post;
use App\Entity\Teaser;
use App\Enum\EventTypeEnum;
use Doctrine\ORM\EntityManagerInterface;

class EventService implements EventServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $manager
    ) {
    }

    public function makeViewPostEvent(Post $post, EventDataDto $data): void
    {
        $event = new Event();
        $event->setPost($post);
        $event->setType(EventTypeEnum::ViewPost->value);
        $event->setDevice($data->getDevice());
        $event->setGeo($data->getGeo());
        $event->setIp($data->getIp());
        $event->setOs($data->getOs());
        $event->setDeviceModel($data->getModel());

        $this->manager->persist($event);
        $this->manager->flush();
    }

    public function makeTeaserViewEvent(Teaser $teaser, Post $post, EventDataDto $data): void
    {
        $event = new Event();
        $event->setPost($post);
        $event->setTeaser($teaser);
        $event->setType(EventTypeEnum::TeaserView->value);
        $event->setDevice($data->getDevice());
        $event->setGeo($data->getGeo());
        $event->setIp($data->getIp());
        $event->setOs($data->getOs());
        $event->setDeviceModel($data->getModel());

        $this->manager->persist($event);
        $this->manager->flush();
    }

    public function makeTeaserClickEvent(Teaser $teaser, Post $post, EventDataDto $data): void
    {
        $event = new Event();
        $event->setPost($post);
        $event->setTeaser($teaser);
        $event->setType(EventTypeEnum::TeaserClick->value);
        $event->setDevice($data->getDevice());
        $event->setGeo($data->getGeo());
        $event->setIp($data->getIp());
        $event->setOs($data->getOs());
        $event->setDeviceModel($data->getModel());

        $this->manager->persist($event);
        $this->manager->flush();
    }
}
