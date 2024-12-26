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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->longText('description');
            $table->string('image')->nullable();
            $table->json('keywords')->nullable();
            $table->json('seo_metadata')->nullable();
            $table->timestamp('publish_date')->nullable();
            $table->boolean('is_published')->default(false);
            $table->foreignIdFor(\App\Models\User::class,'author_id')->constrained();
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
