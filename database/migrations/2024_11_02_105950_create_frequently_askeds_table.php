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
        Schema::create('frequently_askeds', function (Blueprint $table) {
            $table->id('frequently_id');
            $table->string('question')->nullable();
            $table->text('answer')->nullable();
            // add status field  
            $table->boolean('status')->default(0);
            // add created_at and updated_at fields
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequently_askeds');
    }
};
