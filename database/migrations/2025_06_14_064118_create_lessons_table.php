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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Course::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Course\Chapter::class)->constrained()->cascadeOnDelete();
            $table->string('video_url')->nullable();
            $table->string('storage')->nullable();
            $table->string('volume')->nullable();
            $table->string('duration');
            $table->string('file_type');
            $table->boolean('is_downloadable')->default(true);
            $table->boolean('is_preview')->default(true);
            $table->string('status')->default(\App\Enums\Status::ACTIVE->value);
            $table->tinyInteger('order');
            $table->tinyInteger('lesson_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
