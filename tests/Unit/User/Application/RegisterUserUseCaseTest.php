<?php
declare(strict_types=1);

namespace Tests\Unit\User\Application;

use PHPUnit\Framework\TestCase;
use Src\User\Application\RegisterUserUseCase;
use Src\User\Application\Dto\RegisterUserRequest;
use Src\User\Domain\Contracts\UserRepositoryInterface;
use Src\User\Domain\User;

class RegisterUserUseCaseTest extends TestCase
{
	private $repository;
	private $registerUserUseCase;

	protected function setUp(): void
	{
		$this->repository = $this->createMock(UserRepositoryInterface::class);
		$this->registerUserUseCase = new RegisterUserUseCase($this->repository);
	}

	public function test_should_register_new_user(): void
	{
		$request = new RegisterUserRequest(
			'Rafael Acosta',
			'rafael@example.com',
			'Valid12121!'
		);

		$this->repository->expects($this->once())
		->method('save');

		$user = $this->registerUserUseCase->execute($request);

		$this->assertInstanceOf(User::class, $user);
		$this->assertEquals('Rafael Acosta', $user->name()->value());
		$this->assertEquals('rafael@example.com', $user->email()->value());
	}
}