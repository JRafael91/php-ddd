<?php
declare(strict_types=1);

namespace Src\User\Domain;

use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\ValueObjects\UserPassword;
use Src\User\Domain\ValueObjects\UserName;
use Src\User\Domain\ValueObjects\UserId;

final class User
{
	private UserId $id;
	private UserName $name;
	private UserEmail $email;
	private UserPassword $password;
	private \DateTimeImmutable $createdAt;

	public function __construct(
		UserId $id,
		UserName $name,
		UserEmail $email,
		UserPassword $password,
		\DateTimeImmutable $createdAt
	) {
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
		$this->createdAt = $createdAt;
	}

	public function id(): UserId
	{
		return $this->id;
	}

	public function name(): UserName
	{
		return $this->name;
	}

	public function email(): UserEmail
	{
		return $this->email;
	}

	public function password(): UserPassword
	{
		return $this->password;
	}

	public function createdAt(): \DateTimeImmutable
	{
		return $this->createdAt;
	}
}