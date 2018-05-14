<?php
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
// get home page whithin function index that include in "HomeController" class

// setting a group access for guest user
$app->group('', function () {


//sign in
    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');

})->add(new GuestMiddleware($container));

$app->group('', function () {
//indexHome
    $this->get('/', 'HomeController:index')->setName('home');


//CreateStudent
    $this->get('/manage/createstudent', 'ManageController:getCreateStudent')->setName('manage.createstudent');
    $this->post('/manage/createstudent', 'ManageController:postCreateStudent');
// getStudent
    $this->get('/manage/showstudent/{student_id:\d+}', 'ManageController:getStudent')->setName('manage.showstudent');
// getEditCourse
    $this->get('/manage/editstudent/{student_id:\d+}', 'ManageController:getEditStudent')->setName('manage.editstudent');
    $this->post('/manage/editstudent/{student_id:\d+}', 'ManageController:postEditStudent');
    

//CreateCourse
    $this->get('/manage/createcourse', 'ManageController:getCreateCourse')->setName('manage.createcourse');
    $this->post('/manage/createcourse', 'ManageController:postCreateCourse');
// getCourse
    $this->get('/manage/showcourse/{course_id:\d+}', 'ManageController:getCourse')->setName('manage.showcourse');
// getEditCourse
    $this->get('/manage/editcourse/{course_id:\d+}', 'ManageController:getEditCourse')->setName('manage.editcourse');
    $this->post('/manage/editcourse/{course_id:\d+}', 'ManageController:postEditCourse');


//indexAdmin
    $this->get('/admin', 'ManageController:indexAdmin')->setName('admin');

//CreateAdmin
    $this->get('/manage/createadmin', 'ManageController:getCreateAdmin')->setName('manage.createadmin');
    $this->post('/manage/createadmin', 'ManageController:postCreateAdmin');
// getAdmin
    $this->get('/admin/manage/showadmin/{admin_id:\d+}', 'ManageController:getAdmin')->setName('manage.showadmin');
// getEditAdmin
    $this->get('/admin/manage/editadmin/{admin_id:\d+}', 'ManageController:getEditAdmin')->setName('manage.editadmin');
    $this->post('/admin/manage/editadmin/{admin_id:\d+}', 'ManageController:postEditAdmin');


//ChangePassword
    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordController:postChangePassword');

//SignOut
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

})->add(new AuthMiddleware($container));
