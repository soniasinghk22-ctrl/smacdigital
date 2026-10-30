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
        // Drop tables if they exist
        Schema::dropIfExists('collection_marble');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('marbles');
        Schema::dropIfExists('location_pages');
        
        // Drop legacy doctor/loan tables to clean up schema
        Schema::dropIfExists('treatments');
        Schema::dropIfExists('services');

        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('status')->default(true);
            $table->string('metatitle')->nullable();
            $table->text('metadescription')->nullable();
            $table->text('metakeywords')->nullable();
            $table->text('schema_markup')->nullable();
            $table->timestamps();
        });

        Schema::create('marbles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('gallery')->nullable(); // Commas-separated or JSON list of image paths
            $table->longText('description')->nullable();
            $table->string('origin')->nullable(); // Italy, Brazil, etc.
            $table->string('thickness')->nullable(); // 18mm, 20mm, etc.
            $table->string('finishes')->nullable(); // Polished, Honed, etc.
            $table->string('applications')->nullable(); // Flooring, Wall cladding, Countertop, etc.
            $table->boolean('status')->default(true);
            $table->string('metatitle')->nullable();
            $table->text('metadescription')->nullable();
            $table->text('metakeywords')->nullable();
            $table->text('schema_markup')->nullable();
            $table->timestamps();
        });

        Schema::create('collection_marble', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained('collections')->onDelete('cascade');
            $table->foreignId('marble_id')->constrained('marbles')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('location_pages', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('slug');
            $table->string('title');
            $table->text('meta_description')->nullable();
            $table->json('content')->nullable(); // JSON object for AI-generated blocks
            $table->boolean('status')->default(true);
            $table->text('schema_markup')->nullable();
            $table->unique(['city', 'slug']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_pages');
        Schema::dropIfExists('collection_marble');
        Schema::dropIfExists('marbles');
        Schema::dropIfExists('collections');
    }
};
