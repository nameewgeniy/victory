<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Dto\EventDataDto;
use App\Entity\Post;
use App\Entity\Teaser;

interface EventServiceInterface
{
    public function makeViewPostEvent(Post $post, EventDataDto $data): void;

    public function makeTeaserViewEvent(Teaser $teaser, Post $post, EventDataDto $data): void;

    public function makeTeaserClickEvent(Teaser $teaser, Post $post, EventDataDto $data): void;
}
