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
        Schema::table('notes', function (Blueprint $table) {
            if (!Schema::hasColumn('notes', 'title')) {
                $table->string('title')->nullable();
            }
    
            if (!Schema::hasColumn('notes', 'start')) {
                $table->date('start')->nullable();
            }
    
            if (!Schema::hasColumn('notes', 'type')) {
                $table->string('type')->nullable();
            }
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            //
        });
    }
};
