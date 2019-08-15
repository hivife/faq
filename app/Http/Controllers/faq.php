<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\category;
use \App\qa;
use \App\User;
class faq extends Controller
{

	function category(Request $request){
		$category = category::select('category_id','name','private')->where('private',0)->get();
		if(isset($request['token'])){
			$user = User::first();	
			$category = category::select('category_id','name','private')->get();
			return $category;
		}
		return $category;
	}
 	function question(Request $request){
		$category_id = $request['category_id'];
		$question = qa::where('private',0)->where('category_id',$category_id)->get();
		return $question;
	}
	
	function rate(Request $request){
		$question_id = $request['question_id'];
		$rating = $request['rating'];
		$question = qa::where('id',$question_id)->first();
		if($rating == 1){
			$question->helpful =$question->helpful + 1; 
			$question->save();
			return response(['message' =>'successful']);
		}
		if($rating == 0){
			$question->nothelpful =$question->nothelpful + 1; 
			$question->save();
			return response(['message' =>'successful']);
		}	
	}
	 function search(Request $request){
		$keyword = $request['keywword'];
		$param = "%".$keyword."%";
		$search = qa::where('private',0);
		$search = $search->where('question','like',$param)->orWhere('answer','like',$param)->orderBy('helpful', 'desc')->take(100)->get();
		foreach ($search as $key => $tag_name) {
			if($tag_name['private'] == 1) {
				unset($search[$key]);
			}
		}
		return $search;
	}
	/*-
	*/ 
	
}
