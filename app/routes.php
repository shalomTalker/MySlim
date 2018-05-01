<?php
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
// get home page whithin function index that include in "HomeController" class

// setting a group access for guest user
$app->group('', function () {
    // sign-up

    $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', 'AuthController:postSignUp');

    //sign in
    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');

})->add(new GuestMiddleware($container));

$app->group('', function () {
    $this->get('/', 'HomeController:index')->setName('home');

    $this->get('/manage/createstudent', 'ManageController:getCreateStudent')->setName('manage.createstudent');
    $this->post('/manage/createstudent', 'ManageController:postCreateStudent');

    $this->get('/manage/createcourse', 'ManageController:getCreateCourse')->setName('manage.createcourse');
    $this->post('/manage/createcourse', 'ManageController:postCreateCourse');
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordController:postChangePassword');

})->add(new AuthMiddleware($container));
