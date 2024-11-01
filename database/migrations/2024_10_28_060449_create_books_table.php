<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique(); // International Standard Book Number
            $table->string('cover')->nullable();
            $table->string('title');
            $table->string('author');
            $table->string('publisher')->nullable(); // Publisher information
            $table->year('publication_year')->nullable(); // Year of publication
            $table->string('genre')->nullable(); // Genre or category (e.g., Fiction, Science)
            $table->text('description')->nullable(); // Book summary/description
            $table->integer('total_copies'); // Total available copies
            $table->integer('available_copies'); // Track remaining available copies
            $table->string('location')->nullable(); // Physical location in the library
            $table->string('language')->default('English'); // Language of the book
            $table->boolean('is_reference_only')->default(false); // Cannot be borrowed if true
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
