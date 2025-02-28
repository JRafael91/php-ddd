<?php
declare(strict_types=1);

namespace Src\User\Domain\Exceptions;

final class InvalidEmailException extends \DomainException
{
    public function __construct(string $email)
    {
        parent::__construct(sprintf('<%s> No es un correo válido', $email));
    }
}