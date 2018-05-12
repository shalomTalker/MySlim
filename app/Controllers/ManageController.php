<?php 
 

namespace App\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;


class ManageController extends Controller 
{

	public function getCreateStudent($request, $response)
	{
		return $this->view->render($response, '/manage/createstudent.twig');
	}

	public function postCreateStudent($request, $response)
	{


		$validation = $this->validator->validate($request, [
			'name' => v::notEmpty()->alpha(),
			'phone' => v::notEmpty()->PhoneValid(),
			'email' => v::noWhitespace()->notEmpty()->email()->EmailAvailable(),
		]);

		if ($validation->failed()) {
			$this->flash->addMessage('error', 'could not add this Student with those details.' );
			return $response->withRedirect($this->router->pathFor('manage.createstudent'));
		}

		$student = Student::create([
			'name' => $request->getParam('name'),
			'phone' => $request->getParam('phone'),
			'email' => $request->getParam('email'),
		]);

		$this->flash->addMessage('info', 'You have successfully added the Student to the school');


		return $response->withRedirect($this->router->pathFor('home'));
	}

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function getStudent($request, $response, $args)
	{
		$student_id = $args['student_id'];
		// var_dump($container->Student);
		// die();

        $student = $container->DBcontroller->getOneStudent($student_id);
		return $this->view->render($response, '/manage/showstudent.twig', ['student' => $student]);
	}

	public function getCreateCourse($request, $response)
	{
		return $this->view->render($response, '/manage/createcourse.twig');
	}

	public function postCreateCourse($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'name' => v::notEmpty()->alpha(),
			'description' => v::notEmpty(),
		]);

		if ($validation->failed()) {
			$this->flash->addMessage('error', 'could not add this Course with those details.' );
			return $response->withRedirect($this->router->pathFor('manage.createcourse'));
		}

		$student = Course::create([
			'name' => $request->getParam('name'),
			'description' => $request->getParam('description'),
		]);

		$this->flash->addMessage('info', 'You have successfully added the Course to the school');


		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function indexAdmin ($request, $response) 
	{
		return $this->view->render($response, '/admin.twig');
	}

	public function getCreateAdmin($request, $response)
	{
		return $this->view->render($response, '/manage/createadmin.twig');
	}

	public function postCreateAdmin($request, $response)
	{


		$validation = $this->validator->validate($request, [
			'email' => v::noWhitespace()->notEmpty()->email()->EmailAvailable(),
			'name' => v::notEmpty()->alpha(),
			'phone' => v::notEmpty()->PhoneValid(),
			'password' => v::noWhitespace()->notEmpty(),
			'confirm_password' => v::noWhitespace()->notEmpty(),
			'role' => v::notEmpty(),
		]);
		  /////////
        // //get uploads
        // $uploadedFiles = $request->getUploadedFiles();
        // // get image from uploads
        // $uploadedFile = $uploadedFiles['image'];
        // //image validate chunk end
        // $this->ImageValidator->failed($uploadedFile);

		$password = $request->getParam('password'); 
		$confirm_password = $request->getParam('confirm_password');

		if ($password !== $confirm_password) {
			$this->flash->addMessage('error', 'could not signup you with unmatch passwords.' );
			return $response->withRedirect($this->router->pathFor('manage.createadmin'));
		}
		
		if ($validation->failed())/* || $this->ImageValidator->failed($uploadedFile))*/ {
			$this->flash->addMessage('error', 'could not signup you with those details.' );
			return $response->withRedirect($this->router->pathFor('manage.createadmin'));
		}
		$user = User::create([
			'email' => $request->getParam('email'),
			'name' => $request->getParam('name'),
			'phone' => $request->getParam('phone'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
			'role_id' => $request->getParam('role'),
			'role' => ($request->getParam('role') == '1') ? 'Sales' : 'Administrator',
			// 'image' => $request->getParam('image'),
		]);


		$this->flash->addMessage('info', 'You have successfully added User to the school');

//create session for new registered user so he may be redirected automatically to home.twig
		// $this->auth->attempt($user->email, $request->getParam('password'));

		return $response->withRedirect($this->router->pathFor('admin'));
	}

}

