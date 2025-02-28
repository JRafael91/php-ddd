<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Src\Shared\Infrastructure\Persistence\DoctrineConfiguration;

$entityManager = DoctrineConfiguration::getEntityManager();

ConsoleRunner::run(
	new SingleManagerProvider($entityManager)
);