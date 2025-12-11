
<?php

// database/migrations/YYYY_MM_DD_create_booklists_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['want_to_read', 'reading', 'finished'])->default('want_to_read');
            $table->text('notes')->nullable();
            $table->decimal('user_rating', 3, 2)->nullable();
            $table->timestamps();
            
            // Prevent duplicate entries
            $table->unique(['user_id', 'book_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booklists');
    }
};