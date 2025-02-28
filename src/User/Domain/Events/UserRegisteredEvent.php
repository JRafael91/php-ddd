<?php
declare(strict_types=1);

namespace Src\User\Domain\Events;
use Src\User\Domain\User;

final class UserRegisteredEvent
{
	
	private User $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function execute(): void
	{
		$this->sendEmail();
	}

	private function sendEmail(): void
	{
		sprintf("Enviando correo a %s (%s)\n", $this->user->name()->value(), $this->user->email()->value());
	}

}