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
        Schema::create('s_e_o_s', function (Blueprint $table) {
            $table->id('seo_id');
            $table->string('title');
            $table->text('description');
            $table->string('meta_robots');
            $table->string('canonical_tags');
            $table->string('og_title');
            $table->text('og_description');
            $table->string('og_image');
            $table->enum('type', ['landing', 'blog']); 
            $table->string('page_name')->nullable();
            $table->string('blog_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_e_o_s');
    }
};
