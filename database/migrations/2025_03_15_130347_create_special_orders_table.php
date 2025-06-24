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
        Schema::create('special_orders', function (Blueprint $table) {
            $table->id();
            $table->string('so_number'); // Special Order Number (S.O)
            $table->string('name'); // Name of the person/department
            $table->text('title_description'); // Title or description of the order
            $table->date('date_of_so'); // Date the special order was issued
            $table->date('date_received'); // Date the special order was received
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_orders');
    }
};
