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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->text('content');
            $table->text('category');
            $table->text('tag');
            $table->string('status');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {


            Schema::dropIfExists('products');

    }
};
