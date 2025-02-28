<?php
declare(strict_types=1);

namespace Src\Shared\Infrastructure\Routing;

use Src\Shared\Infrastructure\Http\JsonResponse;
use Src\User\Infrastructure\RegisterUserController;
use Src\User\Infrastructure\GetUserByIdController;
use Src\User\Infrastructure\DeleteUserController;
use Src\User\Infrastructure\Persistence\DoctrineUserRepository;
use Src\User\Application\Dto\RegisterUserRequest;

final class Router 
{
  private array $routes = [];
  private DoctrineUserRepository $repository;

  public function __construct()
  {
    $this->repository = new DoctrineUserRepository();
    $this->initializeRoutes();
  }

  private function initializeRoutes(): void
  {
		// GET /
		$this->routes['GET']['/'] = function() {
			JsonResponse::success('Welcome to the API');
		};
    // POST /users
    $this->routes['POST']['/users'] = function() {
      $data = json_decode(file_get_contents('php://input'), true);
        
      if (!isset($data['name']) || !isset($data['email']) || !isset($data['password'])) {
        JsonResponse::error('Missing required fields', 400);
        return;
      }
      $request = new RegisterUserRequest(
        $data['name'],
        $data['email'],
        $data['password']
      );
      $controller = new RegisterUserController($this->repository);
      $controller($request);
    };
    // GET /users/{id}
    $this->routes['GET']['/users/([a-zA-Z0-9-]+)'] = function($id) {
      $controller = new GetUserByIdController($this->repository);
      $controller($id);
    };
    // DELETE /users/{id} 
    $this->routes['DELETE']['/users/([a-zA-Z0-9-]+)'] = function($id) {
      $controller = new DeleteUserController($this->repository);
      $controller($id);
    };
  }

  public function dispatch(): void
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    foreach ($this->routes[$method] ?? [] as $route => $handler) {
      $pattern = "#^{$route}$#";
            
      if (preg_match($pattern, $uri, $matches)) {
        array_shift($matches); // Remove full match
        call_user_func_array($handler, $matches);
        return;
      }
    }

  	JsonResponse::error('Route not found', 404);
  }
}