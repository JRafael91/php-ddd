<?php
declare (strict_types=1);

namespace Src\User\Application;

use Src\User\Domain\Contracts\UserRepositoryInterface;
use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\ValueObjects\UserId;

final class DeleteUserUseCase
{
	private $userRepository;

	public function __construct(UserRepositoryInterface $repository)
	{
		$this->userRepository = $repository;
	}

	public function execute(string $id): void
	{
		// Validar si existe usuario
		$userId = new UserId($id);
		if (!$this->userRepository->findById($userId)) {
			throw new UserNotFoundException();
		}
		
		$this->userRepository->delete($userId);
	}
}