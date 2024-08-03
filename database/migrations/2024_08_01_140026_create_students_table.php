<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('gender_id')->references('id')->on('genders')->cascadeOnDelete();
            $table->foreignId('nationality_id')->references('id')->on('nationalities')->cascadeOnDelete();
            $table->foreignId('blood_id')->references('id')->on('type_bloods')->cascadeOnDelete();
            $table->foreignId('Grade_id')->references('id')->on('Grades')->cascadeOnDelete();
            $table->foreignId('Classroom_id')->references('id')->on('Classrooms')->cascadeOnDelete();
            $table->foreignId('section_id')->references('id')->on('sections')->cascadeOnDelete();
            $table->foreignId('parent_id')->references('id')->on('my_parents')->cascadeOnDelete();
            $table->string('academic_year');
            $table->date('Date_Birth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
