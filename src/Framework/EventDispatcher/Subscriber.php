<?php

namespace Framework\EventDispatcher;

interface Subscriber
{
    public function getSubscribedEvents(): array;
}