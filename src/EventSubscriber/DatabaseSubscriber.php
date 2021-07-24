<?php

namespace App\EventSubscriber;

use App\Entity\Bonus;
use App\Entity\Supplier;
use App\Entity\Transaction;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class DatabaseSubscriber implements EventSubscriberInterface
{
    private UserPasswordHasherInterface $userPasswordHasher;
    private Security $security;

    /**
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param Security $security
     */
    public function __construct(UserPasswordHasherInterface $userPasswordHasher, Security $security)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->security = $security;
    }


    public function onTransaction(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Transaction) {
            $product = $entity->getProduct();

            $price = $product->getPrice();
            $percent = $product->getCommissionPercentage();

            $entity->setCommission($price*$percent*$entity->getQuantity());
            $entity->setUser($this->security->getUser());

            $product->setQuantity($product->getQuantity() - $entity->getQuantity());


            $bonus = new Bonus();
            $bonus->setUser($entity->getUser());
            $bonus->setAmount($entity->getCommission());

            $entity->setBonus($bonus);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => [
                ['onTransaction', 1],
                ['onUser', 2],
                ['setUserRole', 3]
            ],
        ];
    }

    public function onUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof User) {
            $entity->setPassword($this->userPasswordHasher->hashPassword($entity, $entity->getPassword()));
        }
    }

    public function setUserRole(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Supplier) {
            $roles = $entity->getUser()->getRoles();
            array_push($roles, $entity->getUserRole());
            $entity->getUser()->setRoles($roles);
        }
    }
}
