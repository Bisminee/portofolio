<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('case_no', 4);
            $table->string('title');
            $table->string('subtitle');
            $table->string('ownership')->default('Personal project');
            $table->string('year', 20);
            $table->text('summary');
            $table->text('problem');
            $table->text('solution');
            $table->json('implementation')->nullable();
            $table->json('tech')->nullable();
            $table->json('decisions')->nullable();
            $table->json('challenges')->nullable();
            $table->json('results')->nullable();
            $table->string('repo_url');
            $table->string('demo_label')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('demo_note')->nullable();
            $table->string('docs_url')->nullable();
            $table->string('art_path');
            $table->text('art_alt');
            $table->text('evidence_note');
            $table->boolean('featured')->default(false);
            $table->boolean('published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
