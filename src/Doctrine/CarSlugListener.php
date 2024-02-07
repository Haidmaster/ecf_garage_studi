<?php

namespace App\Doctrine\Listener;

use App\Entity\Car;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class CarSlugListener
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    // doctrine.event_listener
    // public function prePersist(LifecycleEventArgs $event)
    // {
    //     $car = $event->getObject();
    //     if($car instanceof Car) {
    //         $car->setSlug($this->slugger->slug($car->getLibelle())->lower());
    //     }
    // }

    // public function preUpdate(LifecycleEventArgs $event)
    // {

    // }

    // // doctrine.orm.entity_listener
    // public function prePersist(Car $car)
    // {
    //     $car->setSlug($this->slugger->slug($car->getModel())->lower());
    // }

    // public function preUpdate(LifecycleEventArgs $event)
    // {
    // }
}
