<?php
declare(strict_types=1);

namespace Src\User\Domain\ValueObjects;

use Src\User\Domain\Exceptions\InvalidEmailException;

final class UserEmail
{
	private $email;

	public function __construct(string $email)
	{
		$this->email = $email;
	}

	public function value(): string
	{
		$this->validate($this->email);
		return $this->email;
	}

	private function validate(string $email): void
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			throw new InvalidEmailException($email);
		}
	}
}