<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\qa;
use \App\category;




class AdminController extends Controller
{
	
    //
	function index(){
		$questions = qa::get();
		$category = category::get();
		/* dd($questions); */
		return view('questions',['questions' => $questions ,'category' => $category]);
	}	
	function category(){
		$category = category::get();
		/* dd($questions); */
		return view('categories',['category' => $category]);
	}	
	function edit($question_id){
		$question = qa::find($question_id);
		$category = category::get();		
		return view('edit',['question' => $question,'category' => $category]);
	
	}
	function editquestion($question_id,$answer,$question,$category_id){
		//dd($question_id,$question,$answer,$category_id);
		$question1 = qa::find($question_id);
		$question1->answer = $answer;
		$question1->question = $question;
		$question1->category_id = $category_id;	
		$question1->save();
		$questions = qa::get();
		$category = category::get();
		return view('questions',['questions' => $questions,'category' => $category]);
	
	}	
	function createquestion($question,$answer,$category_id){
		//dd($question_id,$question,$answer,$category_id);
		$question1 = new qa;
		$question1->answer = $answer;
		$question1->question = $question;
		$question1->category_id = $category_id;	
		$question1->save();
		$questions = qa::get();
		$category = category::get();
		return view('questions',['questions' => $questions,'category' => $category]);
	
	}
	function delete($question_id){
		$question = qa::find($question_id)->delete();
		return redirect('admin');
	
	}
	function publish($question_id){
		$question = qa::where('id',$question_id)->first();
		$question->private = 0;
		$question->save();
		return redirect('admin');
	}
	function private($question_id){
		$question = qa::where('category_id',$question_id)->first();
		$question->private = 1;
		$question->save();
		return redirect('admin');
	}
	function deletecat($category_id){
		$question = category::find($category_id)->delete();
		return redirect('admin/category');
	
	}
	function publishcat($category_id){
		//dd($category_id);
		$question = category::where('category_id',$category_id)->first();
		$question->private = 0;
		$question->save();
		return redirect('admin/category');
	}
	function privatecat($category_id){
		//dd($category_id);
		$question = category::where('category_id',$category_id)->first();
		$question->private = 1;
		$question->save();
		return redirect('admin/category');
	}
}
