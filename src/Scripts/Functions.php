<?php

if (!function_exists('Events')) {
    function Events(string $class): \Enigmo\Eventing\Listener
    {
        return \Enigmo\Eventing\Listener::getListener($class);
    }
}