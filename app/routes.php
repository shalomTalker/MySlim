<?php
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\RoleMiddleware;
// get home page whithin function index that include in "HomeController" class

// setting a group access for guest user
$app->group('', function () {

//sign in
    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');

})->add(new GuestMiddleware($container));

$app->group('', function () {

//indexAdmin
    $this->get('/admin', 'ManageController:indexAdmin')->setName('admin');

// getAdmin
    $this->get('/admin/manage/showadmin/{admin_id:\d+}', 'ManageController:getAdmin')->setName('manage.showadmin');

//CreateAdmin
    $this->get('/manage/createadmin', 'ManageController:getCreateAdmin')->setName('manage.createadmin');
    $this->post('/manage/createadmin', 'ManageController:postCreateAdmin');

// getDeleteAdmin
    $this->get('/admin/manage/deleteadmin/{admin_id:\d+}', 'ManageController:getDeleteAdmin')->setName('manage.deleteadmin');
    $this->post('/admin/manage/deleteadmin/{admin_id:\d+}', 'ManageController:postDeleteAdmin');

// getEditAdmin
    $this->get('/admin/manage/editadmin/{admin_id:\d+}', 'ManageController:getEditAdmin')->setName('manage.editadmin');
    $this->post('/admin/manage/editadmin/{admin_id:\d+}', 'ManageController:postEditAdmin');

// getEditStudent
    $this->get('/manage/editstudent/{student_id:\d+}', 'ManageController:getEditStudent')->setName('manage.editstudent');
    $this->post('/manage/editstudent/{student_id:\d+}', 'ManageController:postEditStudent');
    
// getEditCourse
    $this->get('/manage/editcourse/{course_id:\d+}', 'ManageController:getEditCourse')->setName('manage.editcourse');
    $this->post('/manage/editcourse/{course_id:\d+}', 'ManageController:postEditCourse');

// getDeleteCourse
    $this->get('/manage/deletecourse/{course_id:\d+}', 'ManageController:getDeleteCourse')->setName('manage.deletecourse');
    $this->post('/manage/deletecourse/{course_id:\d+}', 'ManageController:postDeleteCourse');    
})->add(new RoleMiddleware($container));


$app->group('', function () {
//indexHome
    $this->get('/', 'HomeController:index')->setName('home');

//CreateStudent
    $this->get('/manage/createstudent', 'ManageController:getCreateStudent')->setName('manage.createstudent');
    $this->post('/manage/createstudent', 'ManageController:postCreateStudent');

// getStudent
    $this->get('/manage/showstudent/{student_id:\d+}', 'ManageController:getStudent')->setName('manage.showstudent');

// getDeleteStudent
    $this->get('/manage/deletestudent/{student_id:\d+}', 'ManageController:getDeleteStudent')->setName('manage.deletestudent');
    $this->post('/manage/deletestudent/{student_id:\d+}', 'ManageController:postDeleteStudent');    
    
//CreateCourse
    $this->get('/manage/createcourse', 'ManageController:getCreateCourse')->setName('manage.createcourse');
    $this->post('/manage/createcourse', 'ManageController:postCreateCourse');

// getCourse
    $this->get('/manage/showcourse/{course_id:\d+}', 'ManageController:getCourse')->setName('manage.showcourse');

//ChangePassword
    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordController:postChangePassword');

//SignOut
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

})->add(new AuthMiddleware($container));
