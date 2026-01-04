<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone');
        $table->text('address')->nullable();
        $table->unsignedBigInteger('user_id'); // stores the logged-in user ID
        $table->timestamps();

        // Optional but recommended: enforce foreign key
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
