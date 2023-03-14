<?php

declare(strict_types=1);

namespace App\Dto;

class EventDataDto
{
    public function __construct(
        private readonly string $device,
        private readonly string $os,
        private readonly string $model,
        private readonly string $geo,
        private readonly string $ip,
        private readonly string $browser,
    ) {
    }

    public function getDevice(): string
    {
        return $this->device;
    }

    public function getOs(): string
    {
        return $this->os;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getGeo(): string
    {
        return $this->geo;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getBrowser(): string
    {
        return $this->browser;
    }
}
