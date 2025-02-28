<?php
declare(strict_types=1);

namespace Src\Tests\Unit\User\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\Exceptions\InvalidEmailException;

final class UserEmailTest extends TestCase
{
	public function test_should_create_valid_email(): void
	{
		$email = new UserEmail('valid@email.com');
		$this->assertEquals('valid@email.com', $email->value());
	}

	public function test_should_throw_exception_when_email_is_invalid(): void
	{
		$this->expectException(InvalidEmailException::class);
		$email = new UserEmail('invalidemail');
		$email->value();
	}
}