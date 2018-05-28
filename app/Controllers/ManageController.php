<?php 
 

namespace App\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
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

        $file = $request->getUploadedFiles();
        $profileImage = $file['image'];

		if ($validation->failed() || $this->ImageValidator->failed($profileImage)) {
			$this->flash->addMessage('error', 'could not add this Student with those details.' );
			return $response->withRedirect($this->router->pathFor('manage.createstudent'));
		}

		$image = $this->ImageValidator->moveUploadedFile($this->container->directory_IMG_students, $profileImage);
	
		$student = Student::create([
			'name' => $request->getParam('name'),
			'phone' => $request->getParam('phone'),
			'email' => $request->getParam('email'),
			'image' => $image,

		]);

		$this->flash->addMessage('info', 'You have successfully added the Student to the school');

		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function getEditStudent($request, $response, $args)
	{
		$student_id = $args['student_id'];
        $student = $this->DBcontroller->getOneStudent($student_id);
        $hisEnroll = $this->DBcontroller->getHisEnroll($student_id);
		return $this->view->render($response, '/manage/editstudent.twig', ['student' => $student, 'hisEnroll' => $hisEnroll]);
	}

	public function postEditStudent($request, $response, $args)
	{
        $id = $args['student_id'];
        $table = 'students';
		$validation = $this->validator->validate($request, [
			'name' => v::notEmpty()->alpha(),
			'phone' => v::notEmpty()->PhoneValid(),
			'email' => v::noWhitespace()->notEmpty()->email(),
		]);

		$file = $request->getUploadedFiles();
        $profileImage = $file['image'];
     
        

		if ($validation->failed() || $this->ImageValidator->failed($profileImage)) {
			$this->flash->addMessage('error', 'could not update this Student with those details.' );
			return $response->withRedirect($this->router->pathFor('manage.editstudent',$args));
		}

		$body = $request->getParsedBody();
		$image = $this->ImageValidator->moveUploadedFile($this->container->directory_IMG_students, $profileImage, $id, $table);
		$student = Student::where('id', $id)->update([
			'name' => $body['name'],
			'phone' => $body['phone'],
			'email' => $body['email'],
			'image' => $image,
		]);
 
		$courses =  $body['course'];

		Enrollment::where('student_id', $id)->delete();

		foreach ($courses as $course) {
			$Enrollment = Enrollment::create([

				'student_id' => $id,
				'course_id' => $course,
				'admin_id' => $body['admin'],
			]);
		}

		$this->flash->addMessage('info', 'You have successfully update Student.');

		return $response->withRedirect($this->router->pathFor('manage.showstudent',$args));
	}


    public function getStudent($request, $response, $args)
	{
		$student_id = $args['student_id'];
        $student = $this->DBcontroller->getOneStudent($student_id);
        $hisEnroll = $this->DBcontroller->getHisEnroll($student_id);

		return $this->view->render($response, '/manage/showstudent.twig', ['student' => $student, 'hisEnroll' => $hisEnroll]);
	}

	public function getDeleteStudent($request, $response, $args)
	{
		$student_id = $args['student_id'];
        $student = $this->DBcontroller->getOneStudent($student_id);
		return $this->view->render($response, '/manage/deletestudent.twig', ['student' => $student]);
	}

	public function postDeleteStudent($request, $response, $args)
	{
        $id = $args['student_id'];
		$student = Student::where('id', $id)->delete([
			'name' => $request->getParam('name'),
			'phone' => $request->getParam('phone'),
			'email' => $request->getParam('email'),
			// 'image' => $request->getParam('image'),
		]);
		$this->flash->addMessage('info', 'You have successfully delete Student.');

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

		$file = $request->getUploadedFiles();
        $profileImage = $file['image'];

		if ($validation->failed() || $this->ImageValidator->failed($profileImage)) {
			$this->flash->addMessage('error', 'could not add this Course with those details.' );
			return $response->withRedirect($this->router->pathFor('manage.createcourse'));
		}

		$image = $this->ImageValidator->moveUploadedFile($this->container->directory_IMG_courses, $profileImage);

		$course = Course::create([
			'name' => $request->getParam('name'),
			'description' => $request->getParam('description'),
			'image' => $image,

		]);

		$this->flash->addMessage('info', 'You have successfully added the Course to the school');


		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function getEditCourse($request, $response, $args)
	{
		$course_id = $args['course_id'];
        $course = $this->DBcontroller->getOneCourse($course_id);
		return $this->view->render($response, '/manage/editcourse.twig', ['course' => $course]);
	}

	public function postEditCourse($request, $response, $args)
	{
        $id = $args['course_id'];
		$validation = $this->validator->validate($request, [
			'name' => v::notEmpty()->alpha(),
			'description' => v::notEmpty(),
		]);

		$file = $request->getUploadedFiles();
        $profileImage = $file['image'];
        $table = 'courses';

		if ($validation->failed() || $this->ImageValidator->failed($profileImage)) {
			$this->flash->addMessage('error', 'could not update this Course with those details.' );
			return $response->withRedirect($this->router->pathFor('manage.editcourse', $args));
		}
		$image = $this->ImageValidator->moveUploadedFile($this->container->directory_IMG_courses, $profileImage, $id, $table);

		$course = Course::where('id', $id)->update([
			'name' => $request->getParam('name'),
			'description' => $request->getParam('description'),
			'image' => $image,
		]);

		$this->flash->addMessage('info', 'You have successfully update Course.');

		return $response->withRedirect($this->router->pathFor('manage.showcourse', $args));
	}
	public function getCourse($request, $response, $args)
	{
		$course_id = $args['course_id'];
        $course = $this->DBcontroller->getOneCourse($course_id);
        $AllRegistered = $this->DBcontroller->getAllRegistered($course_id);
		return $this->view->render($response, '/manage/showcourse.twig', ['course' => $course, 'allRegistered' => $AllRegistered]);
	}

	public function getDeleteCourse($request, $response, $args)
	{
		$course_id = $args['course_id'];
        $course = $this->DBcontroller->getOneCourse($course_id);
		return $this->view->render($response, '/manage/deletecourse.twig', ['course' => $course]);
	}

	public function postDeleteCourse($request, $response, $args)
	{
        $id = $args['course_id'];
		$course = Course::where('id', $id)->delete([
			'name' => $request->getParam('name'),
			'description' => $request->getParam('description'),
			// 'image' => $request->getParam('image'),
		]);
		$this->flash->addMessage('info', 'You have successfully delete Course.');

		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function indexAdmin ($request, $response) 
	{
		$adminPage = 'forTwigCheck';
		return $this->view->render($response, '/admin.twig', ['adminPage' => $adminPage]);
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

		$file = $request->getUploadedFiles();
        $profileImage = $file['image'];
		$requireImg = true;

		$password = $request->getParam('password'); 
		$confirm_password = $request->getParam('confirm_password');

		if ($password !== $confirm_password) {
			$this->flash->addMessage('error', 'could not signup you with unmatch passwords.' );
			return $response->withRedirect($this->router->pathFor('manage.createadmin'));
		}
		
		if ($validation->failed() || $this->ImageValidator->failed($profileImage)) {
			$this->flash->addMessage('error', 'could not signup you with those details.' );
			return $response->withRedirect($this->router->pathFor('manage.createadmin'));
		}

		$image = $this->ImageValidator->moveUploadedFile($this->container->directory_IMG_admins, $profileImage);

		$user = User::create([
			'email' => $request->getParam('email'),
			'name' => $request->getParam('name'),
			'phone' => $request->getParam('phone'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
			'role_id' => $request->getParam('role'),
			'role' => ($request->getParam('role') == '1') ? 'Sales' : 'Administrator',
			'image' => $image,
		]);


		$this->flash->addMessage('info', 'You have successfully added User to the school');

//create session for new registered user so he may be redirected automatically to home.twig
		// $this->auth->attempt($user->email, $request->getParam('password'));

		return $response->withRedirect($this->router->pathFor('admin'));
	}


	public function getEditAdmin($request, $response, $args)
	{
		$admin_id = $args['admin_id'];
        $admin = $this->DBcontroller->getOneAdmin($admin_id);
		return $this->view->render($response, '/manage/editadmin.twig', ['admin' => $admin]);
	}

	public function postEditAdmin($request, $response, $args)
	{
        $id = $args['admin_id'];
		$validation = $this->validator->validate($request, [
			'email' => v::noWhitespace()->notEmpty()->email(),
			'name' => v::notEmpty()->alpha(),
			'phone' => v::notEmpty()->PhoneValid(),
			'role' => v::notEmpty(),
		]);

		$file = $request->getUploadedFiles();
        $profileImage = $file['image'];
        $table = 'users';

		if ($validation->failed() || $this->ImageValidator->failed($profileImage)) {
			$this->flash->addMessage('error', 'could not update this user with those details.' );
			return $response->withRedirect($this->router->pathFor('manage.editadmin',$args));
		}

		$image = $this->ImageValidator->moveUploadedFile($this->container->directory_IMG_admins, $profileImage, $id, $table);

		switch ($request->getParam('role')) {
			case '1':
				$role_name = 'sales';
				break;
			case '2':
				$role_name = 'Administrator';
				break;
			case '3':
				$role_name = 'owner';
				break;
		}

		$user = User::where('id', $id)->update([
			'email' => $request->getParam('email'),
			'name' => $request->getParam('name'),
			'phone' => $request->getParam('phone'),
			'role_id' => $request->getParam('role'),
			'role' => $role_name,
			'image' => $image,
		]);

		$this->flash->addMessage('info', 'You have successfully update User.');

		return $response->withRedirect($this->router->pathFor('manage.showadmin',$args));
	}


    public function getAdmin($request, $response, $args)
	{
		$admin_id = $args['admin_id'];
        $admin = $this->DBcontroller->getOneAdmin($admin_id);
		return $this->view->render($response, '/manage/showadmin.twig', ['admin' => $admin]);
	}

	public function getDeleteAdmin($request, $response, $args)
	{
		$admin_id = $args['admin_id'];
        $admin = $this->DBcontroller->getOneAdmin($admin_id);
		return $this->view->render($response, '/manage/deleteadmin.twig', ['admin' => $admin]);
	}

	public function postDeleteAdmin($request, $response, $args)
	{
        $id = $args['admin_id'];
		$user = User::where('id', $id)->delete([
			'email' => $request->getParam('email'),
			'name' => $request->getParam('name'),
			'phone' => $request->getParam('phone'),
			'role_id' => $request->getParam('role'),
			'role' => ($request->getParam('role') == '1') ? 'Sales' : 'Administrator',
			// 'image' => $request->getParam('image'),
		]);
		$this->flash->addMessage('info', 'You have successfully delete User.');

		return $response->withRedirect($this->router->pathFor('admin'));
	}

}

