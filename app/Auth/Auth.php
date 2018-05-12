<?php 

namespace App\Auth;

use App\Models\User;

class Auth
{

// return session of user exist

	public function user()
	{
		if (isset($_SESSION['user']))
		{
			return User::find($_SESSION['user']);
		}
	}

// check if session of user exist
	public function check()
	{
		return isset($_SESSION['user']);
	}
	
	public function role()
    {
        if (isset($_SESSION['user'])) {
            return User::find($_SESSION['user'])->role_id;
        }
    }
// check for security if the password fetched to the email within DB eloquent return true/false and declare the id user in session
	public function attempt($email, $password)
	{
		$user = User::where('email', $email)->first();
		if (!$user) {
			return false;
		}

		if (password_verify($password, $user->password)) {
			$_SESSION['user'] = $user->id;
			return true;
		}
		return false;

	}

	public function logout()
	{
		unset($_SESSION['user']);
	}
}