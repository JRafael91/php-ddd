<?php
declare(strict_types=1);

namespace Src\User\Domain\Exceptions;

final class WeakPasswordException extends \DomainException
{
	public function __construct(string $reason)
	{
		parent::__construct($reason);
	}
}