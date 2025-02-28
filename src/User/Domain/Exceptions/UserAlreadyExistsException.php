<?php

namespace Src\User\Domain\Exceptions;

final class UserAlreadyExistsException extends \DomainException
{
	public function __construct(string $email)
	{
		parent::__construct(sprintf('El usuario <%s> ya se encuentra registrado', $email));
	}
}