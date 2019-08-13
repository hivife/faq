<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qas', function (Blueprint $table) {
            $table->bigIncrements('question_id');
			$table->text('question');
			$table->text('answer');
			$table->integer('category_id');
			$table->integer('private');	
			$table->integer('helpful')->default(0);
			$table->integer('nothelpful')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qas');
    }
}
