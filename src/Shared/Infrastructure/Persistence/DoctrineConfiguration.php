<?php
declare(strict_types=1);

namespace Src\Shared\Infrastructure\Persistence;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

final class DoctrineConfiguration
{
	public static ?EntityManager $entityManager = null;

	public static function getEntityManager(): EntityManager
	{
		if (self::$entityManager === null) {
			$dotenv = Dotenv::createImmutable(__DIR__ . '/../../../../');
			$dotenv->load();
			
			$paths = [__DIR__ . '/../../../User/Infrastructure/Persistence/Doctrine'];
			$connections = DriverManager::getConnection([
				'driver' => 'pdo_mysql',
				'user' => $_ENV['DB_USER'],
				'password' => $_ENV['DB_PASSWORD'],
				'dbname' => $_ENV['DB_NAME'],
				'host' => $_ENV['DB_HOST'],
				'port' => $_ENV['DB_PORT'],
			]);

			$config = ORMSetup::createAttributeMetadataConfiguration($paths, true);
			self::$entityManager = new EntityManager($connections, $config);
		}

		return self::$entityManager;
	}
}