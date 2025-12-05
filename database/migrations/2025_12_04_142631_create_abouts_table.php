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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            // Basic About Page Content
            $table->string('title')->default('About the Library System');
            $table->longText('description')->nullable();

            // Mission / Vision
            $table->longText('mission')->nullable();
            $table->longText('vision')->nullable();

            // System Features (can store JSON or text)
            $table->longText('features')->nullable(); 
            // Example content: "Borrowing System, Book Catalog, Inventory Management..."

            // Developer Info
            $table->longtext('developer_name')->nullable();
            $table->string('developer_role')->nullable();
            $table->string('developer_email')->nullable();

            // Optional Image (logo or banner)
            $table->string('image')->nullable(); // ex: uploads/about/about.jpg

            // Contact Info (optional)
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};