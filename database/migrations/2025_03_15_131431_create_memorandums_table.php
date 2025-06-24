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
        Schema::create('memorandums', function (Blueprint $table) {
            $table->id();
            $table->string('memo_number'); // Memo Number
            $table->string('name'); // Name of the person/department
            $table->text('title_description'); // Title or description of the memo
            $table->date('memo_date'); // Date the memo was issued
            $table->date('date_received'); // Date the memo was received
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memorandums');
    }
};
