<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20);
            $table->string('name');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('wait_patient')->default(0);
            $table->integer('total_patient')->default(0);
            $table->tinyInteger('publish')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
