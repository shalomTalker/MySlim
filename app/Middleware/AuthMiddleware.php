<?php 

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
	public function __invoke($request, $response, $next)
	{
//check if there is session['user'] is connected
		if (!$this->container->auth->check()) 
		{
			$this->container->flash->addMessage('error', 'Please sign in before doing that.');
			return $response->withRedirect($this->container->router->pathFor('auth.signin'));
		}
 
		$response = $next($request, $response);
		return $response; 

	}
}
	