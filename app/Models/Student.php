<?php 

namespace App\Models;

use illuminate\Database\Eloquent\Model;

class Student extends Model {
	protected $table = 'students';

	protected $fillable =[
		'name',
		'phone',
		'email',
	];
//function getCourse
//function getAllCourses
// function update
// function delete

	// public function setPassword($password)
	// {
	// 	$this->update([
	// 		'password' => password_hash($password, PASSWORD_DEFAULT)
	// 	]);
	// }
}