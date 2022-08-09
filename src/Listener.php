<?php

namespace Enigmo\Eventing;

use Enigmo\Eventing\Event;

class Listener
{
    private static array $listeners = [];

    private string $class;
    private array $handlers;

    public static function getListener(string $class): Listener
    {
        if (!isset(static::$listeners[$class])) {
            static::$listeners[$class] = new Listener($class);
        }
        return static::$listeners[$class];
    }

    public function __construct(string $class)
    {
        $this->class = $class;
        $this->handlers = [];
    }

    public function on(string $event, callable $handler)
    {
        if (!isset($this->handlers[$event])) {
            $this->handlers[$event] = [];
        }
        $this->handlers[$event][] = $handler;
    }

    public function emit(Event $event)
    {
        if (isset($this->handlers[$event->type])) {
            foreach ($this->handlers[$event->type] as $handler) {
                $handler($event);
                if (!$event->propagating) {
                    break;
                }
            }
        }
    }
}