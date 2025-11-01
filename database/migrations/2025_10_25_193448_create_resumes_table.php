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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            
            // Personal Info
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('portfolio')->nullable();
            
            // Summary
            $table->text('summary')->nullable();

            // Education (JSON)
            $table->json('education')->nullable(); 
            // e.g. [{"degree":"B.Sc CS","institution":"XYZ","year":"2020"}]

            // Experience (JSON)
            $table->json('experience')->nullable();
            // e.g. [{"role":"Developer","company":"ABC","from":"2022","to":"2023"}]

            // Skills (JSON or comma-separated)
            $table->json('skills')->nullable();

            // Projects (JSON)
            $table->json('projects')->nullable();

            // Languages
            $table->json('languages')->nullable();

            // Certifications
            $table->json('certifications')->nullable();

            // Other
            $table->text('hobbies')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
