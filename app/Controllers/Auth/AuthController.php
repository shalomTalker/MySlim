<?php  

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;


class AuthController extends Controller 
{

	public function getSignOut($request, $response)
	{
		$this->auth->logout();
		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function getSignIn($request, $response)
	{
		return $this->view->render($response, 'auth/signin.twig');
	}

	public function postSignIn($request, $response)
	{
		$validation = $this->validator->validate($request, 
		[
			'email' => v::noWhitespace()->notEmpty()->email(),
			'password' => v::noWhitespace()->notEmpty(),

		]);

		if ($validation->failed()) 
		{
			
			$this->flash->addMessage('error', 'could not sign you in without any details.' );
			return $response->withRedirect($this->router->pathFor('auth.signin'));
		}
//==========================================
		$auth = $this->auth->attempt(
			$request->getParam('email'),
			$request->getParam('password')
		);
		if (!$auth) 
				{
					$this->flash->addMessage('error', 'could not sign you in. one from those details is wrong.' );
					return $response->withRedirect($this->router->pathFor('auth.signin'));
				}		
		$this->flash->addMessage('info', 'You have been sign in');
		return $response->withRedirect($this->router->pathFor('home'));
	}
}
 