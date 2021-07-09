<?php

namespace App\EventSubscriber;

use App\Entity\Transaction;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DatabaseSubscriber implements EventSubscriberInterface
{
    public function onTransaction(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Transaction) {
            $product = $entity->getProduct();

            $price = $product->getPrice();
            $percent = $product->getCommissionPercentage()/100;

            $entity->setCommission($price*$percent*$entity->getQuantity());

            $product->setQuantity($product->getQuantity() - $entity->getQuantity());
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => 'onTransaction',
        ];
    }
}
