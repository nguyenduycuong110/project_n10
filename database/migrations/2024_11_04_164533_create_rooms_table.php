<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->string('code', 20);
            $table->string('name');
            $table->integer('total_bed');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->tinyInteger('publish')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
