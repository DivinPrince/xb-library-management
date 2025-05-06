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
        // "bookid",
        // "userid",
        // "borrowdate",
        // "returndate"
        Schema::create('book_borrows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("bookid");
            $table->foreign("bookid")->references("bookid")->on("books");
            $table->unsignedBigInteger("userid");
            $table->foreign("userid")->references("id")->on("users");
            $table->date("borrowdate");
            $table->date("returndate");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_borrows');
    }
};
