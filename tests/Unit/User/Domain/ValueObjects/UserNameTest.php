<?php
declare(strict_types=1);

namespace Tests\Unit\User\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use Src\User\Domain\ValueObjects\UserName;

final class UserNameTest extends TestCase
{
	public function test_should_create_valid_name(): void
	{
		$name = new UserName('Rafael');
		$this->assertEquals('Rafael', $name->value());
	}

	public function test_should_throw_exception_for_invalid_characters(): void
	{
		$this->expectException(\InvalidArgumentException::class);
		$name = new UserName('Rafael 1112123');
		$name->value();
	}

	public function test_should_throw_exception_for_invalid_name(): void
	{
		$this->expectException(\InvalidArgumentException::class);
		$name = new UserName('');
		$name->value();
	}

	public function test_should_throw_exception_for_short_name(): void
	{
		$this->expectException(\InvalidArgumentException::class);
		$name = new UserName('R');
		$name->value();
	}
}