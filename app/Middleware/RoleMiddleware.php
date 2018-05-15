<?php 

namespace App\Middleware;

class RoleMiddleware extends Middleware
{
	public function __invoke($request, $response, $next)
	{
//check if there is correct role 
		if (/*!$this->container->auth->check() */$this->container->auth->role() == 1) 
		{
			$this->container->flash->addMessage('info', 'You do not have the correct permission to access this page .');
			return $response->withRedirect($this->container->router->pathFor('home'));
		}
 
		$response = $next($request, $response);
		return $response; 

	}
}
	