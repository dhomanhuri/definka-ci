<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionnaire_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->string('answer_id', 20);
            $table->string('judul_pertanyaan', 255)->nullable();
            $table->string('pertanyaan', 255)->nullable();
            $table->string('jawaban', 255)->nullable();
            $table->timestamps();

            $table->foreign('answer_id')->references('telepon')->on('alumnis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
};
