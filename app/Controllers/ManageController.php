<?php 
 

namespace App\Controllers;

use App\Models\Student;
use App\Models\Course;
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
			'email' => v::noWhitespace()->notEmpty()->email(),
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
}