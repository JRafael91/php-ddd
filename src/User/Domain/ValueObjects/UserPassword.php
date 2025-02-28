<?php
declare (strict_types = 1);

namespace Src\User\Domain\ValueObjects;

use Src\User\Domain\Exceptions\WeakPasswordException;

final class UserPassword
{
	private $value;

	private const MIN_LENGTH = 8;
	private const REQUIRED_PATTERNS = [
		'uppercase' => '/[A-Z]/',
		'lowercase' => '/[a-z]/',
		'number' => '/[0-9]/',
		'special' => '/[!@#$%^&*()\-_=+{};:,<.>]/'
	];

	public function __construct(string $password) {
		$this->validate($password);
		$this->value = $password;
	}

	public function value(): string {
		return $this->hash($this->value);
	}

	private function validate(string $password): void
	{
		if (strlen($password) < self::MIN_LENGTH) {
			throw new WeakPasswordException('La contraseña debe tener al menos 8 caracteres');
		}
		foreach (self::REQUIRED_PATTERNS as $type => $pattern) {
			if (!preg_match($pattern, $password)) {
				throw new WeakPasswordException(sprintf('La contraseña debe contener al menos un %s', $type));
			}
		}
	}

	private function hash(string $password): string {
		return password_hash($password, PASSWORD_ARGON2ID);
	}
}