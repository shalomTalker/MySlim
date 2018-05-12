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

// 	public function getSignUp($request, $response)
// 	{
// 		return $this->view->render($response, 'auth/signup.twig');
// 	}

// 	public function postSignUp($request, $response)
// 	{


// 		$validation = $this->validator->validate($request, [
// 			'email' => v::noWhitespace()->notEmpty()->email()->EmailAvailable(),
// 			'name' => v::notEmpty()->alpha(),
// 			'phone' => v::notEmpty()->PhoneValid(),
// 			'password' => v::noWhitespace()->notEmpty(),
// 			'confirm_password' => v::noWhitespace()->notEmpty(),
// 			'role' => v::notEmpty(),
// 		]);

// 		$password = $request->getParam('password'); 
// 		$confirm_password = $request->getParam('confirm_password');

// 		if ($password !== $confirm_password) {
// 			$this->flash->addMessage('error', 'could not signup you with unmatch passwords.' );
// 			return $response->withRedirect($this->router->pathFor('auth.signup'));
// 		}
		
// 		if ($validation->failed()) {
// 			$this->flash->addMessage('error', 'could not signup you with those details.' );
// 			return $response->withRedirect($this->router->pathFor('auth.signup'));
// 		}
// 		$user = User::create([
// 			'email' => $request->getParam('email'),
// 			'name' => $request->getParam('name'),
// 			'phone' => $request->getParam('phone'),
// 			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
// 			'role_id' => $request->getParam('role'),
// 			'role' => ($request->getParam('role') == '1') ? 'Sales' : 'Administrator',
// 		]);

// 		$this->flash->addMessage('info', 'You have been sign up');

// //create session for new registered user so he may be redirected automatically to home.twig
// 		$this->auth->attempt($user->email, $request->getParam('password'));

// 		return $response->withRedirect($this->router->pathFor('home'));
// 	}
}
 