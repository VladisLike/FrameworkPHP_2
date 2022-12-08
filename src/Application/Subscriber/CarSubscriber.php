<?php

namespace Application\Subscriber;

use Application\Event\NewCarEvent;
use Application\Event\SeveralCarEvent;
use Framework\EventDispatcher\Subscriber;

class CarSubscriber implements Subscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            NewCarEvent::NAME => 'onNewCarHandler',
            SeveralCarEvent::NAME => 'onSeveralCarHandler'
        ];
    }

    public function onNewCarHandler(NewCarEvent $event)
    {
        dump('handle new car event');
        dump($event);
    }
    public function onSeveralCarHandler(SeveralCarEvent $event)
    {
        dump('handle several cars event');
        dump($event);
    }
}