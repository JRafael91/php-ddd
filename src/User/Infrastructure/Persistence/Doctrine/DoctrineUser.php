<?php

namespace Src\User\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
final class DoctrineUser
{
	#[ORM\Id]
	#[ORM\Column(type: 'string', length: 36)]
	private string $id;

	#[ORM\Column(type: 'string')]
	private string $name;

	#[ORM\Column(type: 'string')]
	private string $email;

	#[ORM\Column(type: 'string')]
	private string $password;

	#[ORM\Column(type: 'datetime_immutable')]
	private \DateTimeImmutable $createdAt;

	public function setId(string $id): void {
		$this->id = $id;
	}

	public function getId(): string {
		return $this->id;
	}

	public function setName(string $name): void {
		$this->name = $name;
	}

	public function getName(): string {
		return $this->name;
	}

	public function setEmail(string $email): void {
		$this->email = $email;
	}

	public function getEmail(): string {
		return $this->email;
	}

	public function setPassword(string $password): void {
		$this->password = $password;
	}

	public function getPassword(): string {
		return $this->password;
	}

	public function setCreatedAt(\DateTimeImmutable $createdAt): void {
		$this->createdAt = $createdAt;
	}

	public function getCreatedAt(): \DateTimeImmutable {
		return $this->createdAt;
	}
}