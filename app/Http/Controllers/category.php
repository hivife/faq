<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class category extends Controller
{
    //
	function index(){
		$dbname = env("DB_DATABASE");
		$dbservername = env("DB_HOST");
		$dbusername = env("DB_USERNAME");
		$dbpassword = env("DB_PASSWORD");
		$private = $_GET['private'];
		$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
		//return $private;
		return $conn;
	}
}
