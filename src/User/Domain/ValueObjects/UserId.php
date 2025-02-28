<?php
declare(strict_types=1);

namespace Src\User\Domain\ValueObjects;
use Ramsey\Uuid\Uuid;

final class UserId
{
	private string $value;

	public function __construct(string $value)
	{
		$this->value = $value;
	}

	public function value(): string
	{
		return $this->value;
	}

	public static function create(): self
	{
		return new self(Uuid::uuid4()->toString());
	}
}