<?php

namespace App\Purgers;

use Doctrine\Bundle\FixturesBundle\Purger\PurgerFactory;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Purger\PurgerInterface;
use Doctrine\ORM\EntityManagerInterface;

class MySQLPurgerFactory implements PurgerFactory
{

    /**
     * Adapted from {@see \Doctrine\Bundle\FixturesBundle\Purger\ORMPurgerFactory} to return a MySQL-specific {@see PurgerInterface}.
     * {@inheritDoc}
     */
    public function createForEntityManager(
        ?string                $emName,
        EntityManagerInterface $em,
        array                  $excluded = [],
        bool                   $purgeWithTruncate = false
    ): PurgerInterface
    {
        $purger = new MySQLPurger($em, $excluded);
        $purger->setPurgeMode($purgeWithTruncate ? ORMPurger::PURGE_MODE_TRUNCATE : ORMPurger::PURGE_MODE_DELETE);

        return $purger;
    }
}
