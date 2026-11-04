<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('type', 32);
            $table->string('organization');
            $table->string('role_en');
            $table->string('role_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_ongoing')->default(false);
            $table->text('description_en');
            $table->text('description_id');
            $table->json('highlights_en');
            $table->json('highlights_id');
            $table->json('technologies')->nullable();
            $table->string('team_type', 32)->default('team');
            $table->string('location')->nullable();
            $table->string('work_format')->nullable();
            $table->text('evidence_url')->nullable();
            $table->string('image_path')->nullable();
            $table->json('gallery')->nullable();
            $table->string('image_alt_en')->nullable();
            $table->string('image_alt_id')->nullable();
            $table->string('permission_status', 32)->default('pending');
            $table->string('related_slug')->nullable();
            $table->unsignedInteger('priority')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
