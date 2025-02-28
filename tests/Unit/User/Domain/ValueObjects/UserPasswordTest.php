<?php
declare(strict_types=1);

namespace Tests\Unit\User\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use Src\User\Domain\ValueObjects\UserPassword;
use Src\User\Domain\Exceptions\WeakPasswordException;

final class UserPasswordTest extends TestCase
{
	public function test_should_create_valid_password(): void
	{
		$value = 'Valid1213!';
		$password = new UserPassword($value);
		$this->assertTrue(password_verify($value, $password->value()));
	}

	public function test_should_throw_exception_for_less_than_8_characters(): void
	{
		$this->expectException(WeakPasswordException::class);
		$password = new UserPassword('123');
		$password->value();
	}

	public function test_should_throw_exception_for_weak_password(): void
	{
		$this->expectException(WeakPasswordException::class);
		$password = new UserPassword('12345678');
		$password->value();
	}
	
}