<?php
namespace App\Controllers;

use App\Controllers\Controller;
// use App\Models\Course;
// use App\Models\Student;
// use App\Models\User;

class DBcontroller extends Controller
{
    public function getUsersList()
    {
        $userlist = array('users'=>$this->db2->select('SELECT id, name, phone, role, email, updated_at, created_at  from users;'));
        $parsedUsers = array();
        foreach ($userlist as $key => $value) {
            foreach ($value as $subkey => $subvalue) {
                $parsedUsers[$subkey] = $subvalue;
            }
        }
        return $parsedUsers;
    }    

    public function getCoursesList()
    {
        $courselist = array('courses'=>$this->db2->select('SELECT id, name, description, image, updated_at, created_at from courses;'));
        $parsedCourses = array();
        foreach ($courselist as $key => $value) {
            foreach ($value as $subkey => $subvalue) {
                $parsedCourses[$subkey] = $subvalue;
            }
        }
        return $parsedCourses;
    }

    public function getStudentsList()
    {
        $studentlist = array('students'=>$this->db2->select('SELECT id, name, phone, email, image, updated_at, created_at from students;'));
        $parsedStudents = array();
        foreach ($studentlist as $key => $value) {
            foreach ($value as $subkey => $subvalue) {
                $parsedStudents[$subkey] = $subvalue;
            }
        }
        return $parsedStudents;
    }

    public function getOneStudent($student_id)
    {
        $stmt = $this->db2->select("SELECT id, name, phone, email, image, updated_at, created_at FROM students WHERE id = $student_id;");
        return (array) $stmt[0];
    }

    public function getOneCourse($course_id)
    {
        $stmt = $this->db2->select("SELECT id, name, description, image, updated_at, created_at FROM courses WHERE id = $course_id;");
        return (array) $stmt[0];
    }

    public function getOneAdmin($admin_id)
    {
        $stmt = $this->db2->select("SELECT id, name, email, phone, role_id, role, image, updated_at, created_at FROM users WHERE id = $admin_id;");
        return (array) $stmt[0];
    }

    // public function getCoursesList()
    // {
    //     $courses = array('courses' => $this->db2->select('SELECT id,name,description,start_date,end_date FROM courses WHERE active="1"', [1]));
    //     $parsedCourses = array();
    //     foreach ($courses as $key => $value) {
    //         foreach ($value as $subkey => $subvalue) {
    //             $parsedCourses[$subkey] = $subvalue;
    //         }
    //     }
    //     return $parsedCourses;
    // }
    // public function getSalesList()
    // {
    //     $users = array('sales' => $this->db2->select('SELECT id,name,role,email,phone FROM users where role = "1" AND active="1"'));
    //     $parsedUsers = array();
    //     foreach ($users as $key => $value) {
    //         foreach ($value as $subkey => $subvalue) {
    //             $parsedUsers[$subkey] = $subvalue;
    //         }
    //     }
    //     return $parsedUsers;
    // }
    // public function getStudentsList()
    // {
    //     $users = array('students' => $this->db2->select('SELECT id,name,email,phone FROM students WHERE active="1"'));
    //     $parsedUsers = array();
    //     foreach ($users as $key => $value) {
    //         foreach ($value as $subkey => $subvalue) {
    //             $parsedUsers[$subkey] = $subvalue;
    //         }
    //     }
    //     return $parsedUsers;
    // }
    // public function showDetails($request, $response, $args)
    // {
    //     $id = $args['id'];
    //     $table = $args['table'];
    //     $output = [];
    //     $enrollemnts = [];
    //     switch ($table) {
    //         case 'courses':
    //             $pdo = $this->db2->getPdo();
    //             //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //             $statement = $pdo->prepare(
    //                 "SELECT enrollments.id, courses.name, students.name,enrollments.user_id
    //                     from courses
    //                         INNER JOIN enrollments on courses.id = enrollments.course_id
    //                         INNER JOIN students on students.id = enrollments.student_id
    //                         INNER JOIN users c_user on courses.user_id = c_user.id
    //                         INNER JOIN users s_user on students.user_id = s_user.id
    //                         INNER JOIN users e_user on enrollments.user_id = e_user.id
    //                     where students.active = 1 and courses.active = 1 and enrollments.active = 1 and courses.id=:id");
    //             $statement->execute(['id' => $id]);
    //             $enrollemnts = $statement->fetchAll();
    //             $output = $this->db2->select("SELECT id,name,description,start_date,end_date FROM $table WHERE id =$id");
    //             break;
    //         case 'users':
    //             $output = $this->db2->select("SELECT `id`,`name`,`role`,`email`,`phone` FROM $table WHERE id =$id");
    //             break;
    //         case 'students':
    //             //fetch student enrollemnts
    //             $pdo = $this->db2->getPdo();
    //             $statement = $pdo->prepare(
    //                 "SELECT enrollments.id, courses.name, students.name
    //                     from courses
    //                         INNER JOIN enrollments on courses.id = enrollments.course_id
    //                         INNER JOIN students on students.id = enrollments.student_id
    //                         INNER JOIN users c_user on courses.user_id = c_user.id
    //                         INNER JOIN users s_user on students.user_id = s_user.id
    //                         INNER JOIN users e_user on enrollments.user_id = e_user.id
    //                     where students.active = 1 and courses.active = 1 and enrollments.active = 1 and students.id=:id");
    //             $statement->execute(['id' => $id]);
    //             $enrollemnts = $statement->fetchAll();
    //             $output = $this->db2->select("SELECT `id`,`name`,`email`,`phone` FROM $table WHERE id =$id");
    //             break;
    //     }
    //     $data['logged'] = $this->auth->user()->id;
    //     $data['enrollments'] = $enrollemnts;
    //     $data['selectedEntity'] = $output;
    //     return $response->getBody()->write(json_encode($data));
    // }
    // public function updateEntry($request, $response, $args)
    // {
    //     $id = $request->getParam('id');
    //     $table = $request->getParam('type');
    //     $action = $request->getParam('action');
    //     $tester = "";
    //     switch ($action) {
    //         case 'enroll':
    //             $tester = "enroll!!";
    //             break;
    //         case 'update':
    //             $tester = "update!!";
    //             break;
    //         case 'del':
    //             $tester = "delete!!";
    //             $output = json_encode($this->db2->update("UPDATE $table SET `active`='0' WHERE id=$id"));
    //             break;
    //     }
    //     //$csrf = array("csrf_name_value" => $this->container->csrf->getTokenName(), "csrf_value_value" => $this->container->csrf->getTokenValue());
    //     $derp = array($id, $table, $action, $tester);
    //     return $response->getBody()->write(json_encode($derp), $output);
    // }
    // public function getEnrollments($request, $response, $args)
    // {
    //     $id = (int) $request->getParam('id');
    //     $table = $request->getParam('type');
    //     switch ($table) {
    //         case 'students':
    //             $pdo = $this->db2->getPdo();
    //             $statement = $pdo->prepare(
    //                 "SELECT enrollments.id, courses.name, students.name
    //                 from courses
    //                     INNER JOIN enrollments on courses.id = enrollments.course_id
    //                     INNER JOIN students on students.id = enrollments.student_id
    //                     INNER JOIN users c_user on courses.user_id = c_user.id
    //                     INNER JOIN users s_user on students.user_id = s_user.id
    //                     INNER JOIN users e_user on enrollments.user_id = e_user.id
    //                 where students.active = 1 and courses.active = 1 and enrollments.active = 1 and students.id=:id"
    //             );
    //             $statement->execute(['id' => $id]);
    //             $statement = $statement->fetchAll();
    //             break;
    //         case 'courses':
    //             $statement = Course::select(
    //                 "SELECT enrollments.id, courses.name, students.name,enrollments.user_id
    //             from courses
    //                 INNER JOIN enrollments on courses.id = enrollments.course_id
    //                 INNER JOIN students on students.id = enrollments.student_id
    //                 INNER JOIN users c_user on courses.user_id = c_user.id
    //                 INNER JOIN users s_user on students.user_id = s_user.id
    //                 INNER JOIN users e_user on enrollments.user_id = e_user.id
    //             where students.active = 1 and courses.active = 1 and enrollments.active = 1 and courses.id=$id"
    //             );
    //             break;
    //     }
    //     return $response->getBody()->write(
    //         //var_dump($query)
    //         json_encode($statement)
    //     );
    // }
}