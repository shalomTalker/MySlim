<?php 

namespace App\Middleware;

class GuestMiddleware extends Middleware
{
	public function __invoke($request, $response, $next)
	{
//check if there is session['user'] is connected
		if ($this->container->auth->check()) 
		{
			$this->container->flash->addMessage('info', 'Welcome to CodeSchool please sign-In.');
			return $response->withRedirect($this->container->router->pathFor('home'));
		}
		
		$response = $next($request, $response);
		return $response; 

	}
}
	