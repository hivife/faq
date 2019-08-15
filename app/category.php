<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
   protected $fillable = [
		'name','private'
	];
	protected $primaryKey = 'category_id';
}
