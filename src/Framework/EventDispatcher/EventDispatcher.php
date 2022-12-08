<?php

namespace Framework\EventDispatcher;

class EventDispatcher
{
    private array $listeners = [];

    public function addListener($listener, string $eventName): void
    {
        $this->listeners[$eventName][] = $listener;
    }

    public function addSubscriber(Subscriber $subscriber): void
    {
        foreach ($subscriber->getSubscribedEvents() as $eventName => $listenerName) {
            $this->addListener([$subscriber, $listenerName], $eventName);
        }
    }

    private function notifyAllListeners(Event $event, string $eventName): void
    {
        if (\array_key_exists($eventName, $this->listeners) === false) return;

        \array_walk($this->listeners[$eventName], function ($listener) use ($event) {
            $listener($event);
        });
    }

    public function dispatch(Event $event, string $eventName): void
    {
        $this->initializeSubscribers($event, $eventName);
        $this->notifyAllListeners($event, $eventName);
    }

    private function initializeSubscribers(Event $event, string $eventName): void
    {

    }
}