<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\category;
use \App\qa;

class faq extends Controller
{
    //
	function category(){
		
		$category = category::select('category_id','name','private')->where('private',0)->get();
		return $category;
	}
 	function question($category_id){
		$question = qa::where('private',0)->where('category_id',$category_id)->get();
		return $question;
	}
	function rate($question_id,$rating){
		$question = qa::where('id',$question_id)->first();
		//dd($question->question);
		if($rating == 1){
			$question->helpful =$question->helpful + 1; 
			$question->save();
			/*
			$question->update(['helpful' => $rating]);
			*/
			return ;
		}
		if($rating == 0){
			$question->nothelpful =$question->nothelpful + 1; 
			$question->save();
			return ;
		}
		
	} 
	function ratepost(Request $request){
		return $request;
	}
	 function search($keyword){
		$param = "%".$keyword."%";
		$search = qa::where('private',0)->where('question','like',$param)->orWhere('answer','like',$param)->orderBy('helpful', 'desc')->take(100)->get();
		return $search;
	}
	/*-
	*/ 
	
}
