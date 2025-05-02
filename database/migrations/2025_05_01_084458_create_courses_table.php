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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Category::class)->nullable()->constrained()->cascadeOnDelete();
            $table->tinyInteger('course_type')->nullable()->default(\App\Enums\CourseType::COURSE->value);
            $table->string('name');
            $table->string('slug');
            $table->string('seo_description')->nullable();
            $table->string('duration')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('demo_video_storage')->nullable()->default(\App\Enums\VideoStorageType::YOUTUBE);
            $table->string('demo_video_url')->nullable();
            $table->text('description')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('discount_price')->nullable();
            $table->boolean('has_certificate')->default(true)->nullable();
            $table->boolean('qna')->default(true)->nullable();
            $table->text('message_for_reviewer')->nullable();
            $table->string('approve_status')->default(\App\Enums\ApproveStatus::PENDING->value);
            $table->string('status')->default(\App\Enums\Status::DRAFT->value);
            $table->foreignIdFor(\App\Models\Course\Level::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Course\Language::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
