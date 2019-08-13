<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qa extends Model
{
    protected $fillable = [
		'question',
		'answer',
		'category_id',
		'private'
	];
}
