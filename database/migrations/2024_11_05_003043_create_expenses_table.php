<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_catalogue_id');
            $table->foreign('expense_catalogue_id')->references('id')->on('expense_catalogues')->onDelete('cascade');
            $table->string('name');
            $table->float('price');
            $table->longText('description')->nullable();
            $table->tinyInteger('publish')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
