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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // SEO-friendly slug
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('location')->nullable();
            $table->string('category_id');
            $table->string('tags')->nullable();
            $table->float('rating', 2, 1)->default(0);

            // 🔹 Additional useful columns
            $table->string('thumbnail')->nullable(); // main image
            $table->integer('duration_days')->nullable(); // how many days
            $table->integer('duration_nights')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('available_seats')->default(0);
            $table->enum('status', ['active', 'inactive', 'draft'])->default('active');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
