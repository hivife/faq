<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\category;
use \App\qa;
use \App\User;

class faqprivate extends Controller
{
	function category(Request $request){
		$category = category::select('category_id','name','private')->get();
		return $category;

	}
	 function question(Request $request){
		$category_id = $request['category_id'];
		$question = qa::where('category_id',$category_id)->get();
		return $question;
	}
	function search(Request $request){
		$keyword = $request['keywword'];
		$param = "%".$keyword."%";
		$search = qa::where('question','like',$param)->orWhere('answer','like',$param)->orderBy('helpful', 'desc')->take(100)->get();
		return $search;
	}
}
