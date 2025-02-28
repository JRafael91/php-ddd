<?php
declare (strict_types=1);

namespace Src\User\Application;

use Src\User\Domain\Contracts\UserRepositoryInterface;
use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\User;
use Src\User\Domain\ValueObjects\UserId;

final class GetUserByIdUseCase
{
	private $userRepository;

	public function __construct(UserRepositoryInterface $repository)
	{
		$this->userRepository = $repository;
	}

	public function execute(string $id): ?User
	{
		$user = $this->userRepository->findById(new UserId($id));

		if ($user == null) {
			throw new UserNotFoundException();
		}

		return $user;
	}
}