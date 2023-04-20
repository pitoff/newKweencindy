<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained();
            $table->string('location')->nullable();
            $table->string('state')->nullable();
            $table->string('town')->nullable();
            $table->string('address')->nullable();
            $table->string('payment_status')->default('pending payment')->nullable();
            $table->string('book_status')->default('pending booking')->nullable();
            $table->string('book_date')->nullable();
            $table->string('book_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
