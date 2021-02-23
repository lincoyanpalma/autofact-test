<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'answers';

    /**
     * Run the migrations.
     * @table answers
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('answer')->nullable();
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('user_id');

            $table->index(["question_id"], 'fk_questions_questionid_answers_idx');

            $table->index(["user_id"], 'fk_users_userid_answers_idx');
            $table->nullableTimestamps();


            $table->foreign('question_id', 'fk_questions_questionid_answers_idx')
                ->references('id')->on('questions')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_users_userid_answers_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
