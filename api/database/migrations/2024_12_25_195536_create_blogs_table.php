<?php

use App\Enum\BlogStatus;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->json('keywords')->nullable();
            $table->json('seo_metadata')->nullable();
            $table->tinyInteger('is_scheduled')->default(0);
            $table->date('publish_date')->nullable();
            $table->time('publish_time')->nullable();
            $table->string('status')->default(BlogStatus::PUBLISHED);
            $table->foreignIdFor(User::class, 'author_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
