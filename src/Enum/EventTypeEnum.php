<?php

declare(strict_types=1);

namespace App\Enum;

enum EventTypeEnum: string
{
    case ViewPost = 'view';
    case StartVideo = 'start';
    case Quartile = 'quartile';
    case TeaserView = 'teaserView';
    case TeaserClick = 'teaserClick';
}
