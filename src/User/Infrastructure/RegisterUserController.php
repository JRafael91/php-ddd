<?php
declare(strict_types=1);

namespace Src\User\Infrastructure;

use Src\User\Application\Dto\RegisterUserRequest;
use Src\User\Application\Dto\UserResponseDTO;
use Src\User\Application\RegisterUserUseCase;
use Src\User\Domain\Contracts\UserRepositoryInterface;
use Src\User\Infrastructure\Persistence\DoctrineUserRepository;
use Src\Shared\Infrastructure\Http\JsonResponse;

final class RegisterUserController
{

	private UserRepositoryInterface $repository;

	public function __construct(DoctrineUserRepository $repository){
		$this->repository = $repository;
	}

	public function __invoke(RegisterUserRequest $request): void
	{
		try {
			$registerUser = new RegisterUserUseCase($this->repository);
			$user = $registerUser->execute($request);
			$response = new UserResponseDTO($user);
			JsonResponse::success($response->toArray(), 201);
		} catch (\InvalidArgumentException $e) {
			JsonResponse::error($e->getMessage(), 400);
		} catch (\Exception $e) {
			JsonResponse::error($e->getMessage(), 500);
		}
	}
}