<?php

namespace App\Purgers;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;


class MySQLPurger extends ORMPurger
{
    /**
     * {@inheritDoc}
     */
    public function __construct(private readonly EntityManagerInterface $entityManager, array $excluded = [])
    {
        parent::__construct($this->entityManager, $excluded);
    }

    /**
     * Purges the MySQL database with temporarily disabled foreign key checks.
     * {@inheritDoc}
     */
    public function purge(): void
    {
        $connection = $this->entityManager->getConnection();

        try {
            $connection->executeStatement('SET FOREIGN_KEY_CHECKS = 0');

            parent::purge();
        } finally {
            $connection->executeStatement('SET FOREIGN_KEY_CHECKS = 1');
        }
    }
}
