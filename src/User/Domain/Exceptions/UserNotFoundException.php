<?php

namespace Src\User\Domain\Exceptions;

final class UserNotFoundException extends \DomainException
{
	public function __construct()
	{
		parent::__construct('El usuario no se encuentra registrado');
	}
}