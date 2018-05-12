<?php 

namespace App\Models;

use illuminate\Database\Eloquent\Model;
use App\Controllers\Controller;

class Student extends Model {
	protected $table = 'students';

	protected $fillable =[
		'name',
		'phone',
		'email',
	];
	
	public function getOne($student_id)
	{
		$stmt = array('student'=>$this->db2->select('SELECT id, name, phone, email, image, updated_at, created_at FROM students WHERE id = $student_id;'));
		return $stmt;
	}
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