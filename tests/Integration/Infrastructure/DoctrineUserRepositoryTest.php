<?php
declare(strict_types=1);

namespace Tests\Integration\Infrastructure;

use PHPUnit\Framework\TestCase;
use Src\User\Infrastructure\Persistence\DoctrineUserRepository;
use Src\User\Application\RegisterUserUseCase;
use Src\User\Application\GetUserByIdUseCase;
use Src\User\Application\Dto\RegisterUserRequest;
use Src\User\Domain\User;

final class DoctrineUserRepositoryTest extends TestCase
{
	private $repository;
	private $registerUserUseCase;
	private $getUserByIdUseCase;

	protected function setUp(): void
	{
		$this->repository = new DoctrineUserRepository();
		$this->registerUserUseCase = new RegisterUserUseCase($this->repository);
		$this->getUserByIdUseCase = new GetUserByIdUseCase($this->repository);
	}

	public function test_should_save_new_user(): void
	{
		$request = new RegisterUserRequest(
			'Rafael Acosta',
			'rafael@example.com',
			'Valid1213!'
		);
		
		$user = $this->registerUserUseCase->execute($request);
		$this->assertInstanceOf(User::class, $user);

		$findUser = $this->getUserByIdUseCase->execute($user->id()->value());

		$this->assertEquals($user->id()->value(), $findUser->id()->value());
		$this->assertEquals($user->name()->value(), $findUser->name()->value());
		$this->assertEquals($user->email()->value(), $findUser->email()->value());
	}

	
}