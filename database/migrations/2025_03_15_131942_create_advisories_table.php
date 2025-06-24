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
        Schema::create('advisories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the issuing person/department
            $table->text('title_description'); // Title or description of the advisory
            $table->date('date_of_advisory'); // Date the advisory was issued
            $table->date('date_received'); // Date the advisory was received
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisories');
    }
};
