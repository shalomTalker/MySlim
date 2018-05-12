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
//index
    $this->get('/', 'HomeController:index')->setName('home');


//CreateStudent
    $this->get('/manage/createstudent', 'ManageController:getCreateStudent')->setName('manage.createstudent');

    $this->post('/manage/createstudent', 'ManageController:postCreateStudent');

// getStudent
    $this->get('/manage/showstudent/{student_id:\d+}', 'ManageController:getStudent')->setName('manage.showstudent');
    

//CreateCourse
    $this->get('/manage/createcourse', 'ManageController:getCreateCourse')->setName('manage.createcourse');

    $this->post('/manage/createcourse', 'ManageController:postCreateCourse');


//ChangePassword
    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');

    $this->post('/auth/password/change', 'PasswordController:postChangePassword');


//indexAdmin
    $this->get('/admin', 'ManageController:indexAdmin')->setName('admin');

    

// sign-up//CreateAdmin
    $this->get('/manage/createadmin', 'ManageController:getCreateAdmin')->setName('manage.createadmin');
    
    $this->post('/manage/createadmin', 'ManageController:postCreateAdmin');






//SignOut
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

})->add(new AuthMiddleware($container));
