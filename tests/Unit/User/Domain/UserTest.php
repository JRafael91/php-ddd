<?php
declare(strict_types=1);

namespace Src\Tests\Unit\User\Domain;

use PHPUnit\Framework\TestCase;
use Src\User\Domain\User;
use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\ValueObjects\UserId;
use Src\User\Domain\ValueObjects\UserName;
use Src\User\Domain\ValueObjects\UserPassword;

final class UserTest extends TestCase
{
	public function test_should_create_valid_user(): void
  {
		$uuid = UserId::create();
    $user = new User(
      $uuid,
      new UserName('Rafael Acosta'),
      new UserEmail('rafael@example.com'),
      new UserPassword('Valid123!'),
      new \DateTimeImmutable()
    );

		
		$this->assertEquals($uuid->value(), $user->id()->value());
    $this->assertEquals('Rafael Acosta', $user->name()->value());
    $this->assertEquals('rafael@example.com', $user->email()->value());
  }
}