<?php
declare (strict_types=1);

namespace Src\User\Infrastructure;

use Src\User\Infrastructure\Persistence\DoctrineUserRepository;
use Src\User\Application\DeleteUserUseCase;
use Src\Shared\Infrastructure\Http\JsonResponse;
use Src\User\Domain\Exceptions\UserNotFoundException;

final class DeleteUserController
{
	private $repository;

	public function __construct(DoctrineUserRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(string $id): void
	{
		try {
			$deleteUser = new DeleteUserUseCase($this->repository);
			$deleteUser->execute($id);
			JsonResponse::success();
		} catch (UserNotFoundException $e) {
			JsonResponse::error($e->getMessage(), 400);
		} catch (\Exception $e) {
			JsonResponse::error($e->getMessage(), 500);
		}
	}

}