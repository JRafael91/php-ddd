<?php
declare(strict_types=1);

namespace Src\User\Application\Dto;

use Src\User\Domain\User;

final class UserResponseDTO
{
	private string $id;
	private string $name;
	private string $email;
	private \DateTimeImmutable $createdAt;

	public function __construct(User $user)
	{
		$this->id = $user->id()->value();
		$this->name = $user->name()->value();
		$this->email = $user->email()->value();
		$this->createdAt = $user->createdAt();
	}

	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
		];
	}
}