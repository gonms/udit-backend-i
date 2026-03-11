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
        Schema::table('books', function (Blueprint $table) {  
            $table->unsignedBigInteger('author_id')->after('title');
            $table->foreign('author_id')->on('authors')->references('id')->onDelete('cascade');

            //$table->foreignId('author_id')->after('title')->constrained('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Eliminar la foreign key y la columna author_id
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');            
        });
    }
};
