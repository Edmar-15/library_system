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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            // Reference to users table
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Profile settings
            $table->string('profile_picture')->nullable(); // ex: uploads/profile/user1.jpg
            $table->text('bio')->nullable();

            // Add more fields if needed
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
