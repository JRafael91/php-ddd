<?php
declare(strict_types=1);

namespace Src\User\Domain\ValueObjects;

final class UserName
{
  private $value;

  public function __construct(string $name)
  {
    $this->validate($name);
    $this->value = $name;
  }

  public function value(): string
  {
    return $this->value;
  }
	
  private function validate(string $name): void
  {
		if (empty($name)) {
			throw new \InvalidArgumentException('Nombre es requerido');
		}
		if (strlen($name) < 3) {
			throw new \InvalidArgumentException('Nombre debe tener al menos 3 caracteres');
		}
		if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
			throw new \InvalidArgumentException('El nombre solo puede contener caracteres alfabéticos y espacios');
		}
	}
}