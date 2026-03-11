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
        Schema::create('isbns', function (Blueprint $table) {
            $table->id();
            $table->string('isbn_code', 20)->unique();
            $table->unsignedBigInteger('book_id')->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('book_id')->on('books')->references('id')->onDelete('cascade');
            
            //$table->foreignId('book_id')->unique()->constrained('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isbns');
    }
};
