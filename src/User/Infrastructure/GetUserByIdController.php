<?php
declare(strict_types=1);

namespace Src\User\Infrastructure;

use Src\User\Infrastructure\Persistence\DoctrineUserRepository;
use Src\User\Application\GetUserByIdUseCase;
use Src\Shared\Infrastructure\Http\JsonResponse;
use Src\User\Application\Dto\UserResponseDTO;
use Src\User\Domain\Exceptions\UserNotFoundException;

final class GetUserByIdController
{
	private $repository;

	public function __construct(DoctrineUserRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(string $id): void
	{
		try {
			$getUserById = new GetUserByIdUseCase($this->repository);
			$user = $getUserById->execute($id);
			$response = new UserResponseDTO($user);
			JsonResponse::success($response->toArray());
		} catch (UserNotFoundException $e) {
			JsonResponse::error($e->getMessage(), 400);
		} catch (\Exception $e) {
			JsonResponse::error($e->getMessage(), 500);
		}
	}
}