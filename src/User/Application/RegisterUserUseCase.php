<?php
declare(strict_types=1);

namespace Src\User\Application;

use Src\User\Domain\Contracts\UserRepositoryInterface;
use Src\User\Application\Dto\RegisterUserRequest;
use Src\User\Domain\Events\UserRegisteredEvent;
use Src\User\Domain\Exceptions\UserAlreadyExistsException;
use Src\User\Domain\User;
use Src\User\Domain\ValueObjects\UserId;
use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\ValueObjects\UserName;
use Src\User\Domain\ValueObjects\UserPassword;

final class RegisterUserUseCase
{
	private $userRepository;

	public function __construct(UserRepositoryInterface $repository) {
		$this->userRepository = $repository;
	}

	public function execute(RegisterUserRequest $request): User
	{
		// Validar si el correo ya está registrado
		$email = new UserEmail($request->getEmail());
		if($this->userRepository->findByEmail($email)) {
			throw new UserAlreadyExistsException($email->value());
		}

		$user = new User(
			UserId::create(),
			new UserName($request->getName()),
			$email,
			new UserPassword($request->getPassword()),
			new \DateTimeImmutable()
		);
		$this->userRepository->save($user);
		
		// Evento al registrar un usuario
		$event = new UserRegisteredEvent($user);
		$event->execute();

		return $user;
	}
}