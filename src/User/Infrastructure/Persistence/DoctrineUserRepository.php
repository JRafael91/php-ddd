<?php
declare (strict_types=1);

namespace Src\User\Infrastructure\Persistence;

use Doctrine\ORM\EntityManager;
use Src\User\Domain\Contracts\UserRepositoryInterface;
use Src\Shared\Infrastructure\Persistence\DoctrineConfiguration;
use Src\User\Infrastructure\Persistence\Doctrine\DoctrineUser;
use Src\User\Domain\User;
use Src\User\Domain\ValueObjects\UserId;
use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\ValueObjects\UserName;
use Src\User\Domain\ValueObjects\UserPassword;

final class DoctrineUserRepository implements UserRepositoryInterface
{

	private EntityManager $entityManager;

	public function __construct()
	{
		$this->entityManager = DoctrineConfiguration::getEntityManager();
	}

	public function save(User $user): void
	{
		$doctrineUser = new DoctrineUser();
		$doctrineUser->setId($user->id()->value());
		$doctrineUser->setName($user->name()->value());
		$doctrineUser->setEmail($user->email()->value());
		$doctrineUser->setPassword($user->password()->value());
		$doctrineUser->setCreatedAt($user->createdAt());
		$this->entityManager->persist($doctrineUser);
		$this->entityManager->flush();
	}

	public function findById(UserId $id): ?User
	{
		$doctrineUser = $this->entityManager->find(DoctrineUser::class, $id->value());

		if ($doctrineUser == null) {
			return null;
		}

		$user = new User(
			new UserId($doctrineUser->getId()),
			new UserName($doctrineUser->getName()),
			new UserEmail($doctrineUser->getEmail()),
			new UserPassword($doctrineUser->getPassword()),
			$doctrineUser->getCreatedAt()
		);
		return $user;
	}

	public function findByEmail(UserEmail $email): ?User
	{
		$doctrineUser = $this->entityManager->getRepository(DoctrineUser::class)->findOneBy(['email' => $email->value()]);

		if ($doctrineUser == null) {
			return null;
		}
		return new User(
			new UserId($doctrineUser->getId()),
			new UserName($doctrineUser->getName()),
			new UserEmail($doctrineUser->getEmail()),
			new UserPassword($doctrineUser->getPassword()),
			$doctrineUser->getCreatedAt()
		);
	}

	public function delete(UserId $id): void
	{

		$doctrineUser = $this->entityManager->find(DoctrineUser::class, $id->value());

		if ($doctrineUser == null) {
			throw new \InvalidArgumentException('El usuario no existe');
		}
		$this->entityManager->remove($doctrineUser);
		$this->entityManager->flush();
	}

}