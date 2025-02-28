<?php
declare(strict_types=1);

namespace Src\User\Domain\Contracts;
use Src\User\Domain\User;
use Src\User\Domain\ValueObjects\UserId;
use Src\User\Domain\ValueObjects\UserEmail;

interface UserRepositoryInterface
{
	public function save(User $user): void;
	public function findById(UserId $id): ?User;
	public function findByEmail(UserEmail $email): ?User;
	public function delete(UserId $user): void;
}