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
        //
        Schema::create('orders', function(Blueprint $table)
        {
            $table->id();
            $table->string('firstname', length: 30);
            $table->string('lastname', length: 30);
            $table->text('address');
            $table->string('contact', length: 30);
            $table->string('email', length: 30);
            $table->text('notes');
            $table->double('total');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    // Rollback Migration
    public function down(): void
    {
        //
        Schema::dropIfExists('orders');
    }
};
