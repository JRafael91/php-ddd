<?php

namespace Src\User\Domain\Exceptions;

final class WeakPasswordException extends \DomainException
{
	public function __construct(string $reason)
	{
		parent::__construct($reason);
	}
}