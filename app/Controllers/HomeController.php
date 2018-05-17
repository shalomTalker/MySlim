<?php  

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;

class HomeController extends Controller {

	
	public function index ($request, $response) {
		$homePage = 'forTwigCheck';
		return $this->view->render($response, 'home.twig', ['homePage' => $homePage]);
	}
}
