<?php

namespace Enigmo\Eventing;

class Event
{
    public string $type = 'base';
    public bool $propagating = true;
    public bool $prevented = false;

    public function stopPropagation()
    {
        $this->propagating = false;
    }

    public function preventDefault()
    {
        $this->prevented = true;
    }
}