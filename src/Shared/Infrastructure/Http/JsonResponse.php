<?php
declare(strict_types=1);

namespace Src\Shared\Infrastructure\Http;

final class JsonResponse
{
	
	public static function success($data = null, int $code = 200): void
	{
		http_response_code($code);
		header('Content-Type: application/json');
		echo json_encode([
			'status' => 'success',
			'data' => $data
		]);
	}

	public static function error(string $message, int $code = 400): void
	{
		http_response_code($code);
		header('Content-Type: application/json');
		echo json_encode([
			'status' => 'error',
			'message' => $message
		]);
	}
}