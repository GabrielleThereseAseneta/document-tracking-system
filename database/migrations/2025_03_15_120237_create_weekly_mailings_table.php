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
        Schema::create('weekly_mailings', function (Blueprint $table) {
            $table->id();
            $table->string('service_division_unit'); // Stores Service Division Unit as one field
            $table->date('date_records_received'); // Stores the date records were received
            $table->string('consignee'); // Stores the consignee name
            $table->text('content'); // Stores the mailing content
            $table->string('courier'); // Stores the courier service name
            $table->string('tracking_number')->unique(); // Stores tracking number (unique)
            $table->date('date_shipped'); // Stores the date shipped
            $table->string('code'); // Stores an identifying code
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_mailings');
    }
};
