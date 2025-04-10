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
        Schema::create('dtr_interns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assigned_intern_id');
            $table->time('time_in_am')->nullable();
            $table->time('time_out_am')->nullable();
            $table->time('time_in_pm')->nullable();
            $table->time('time_out_pm')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('assigned_intern_id')
                ->references('id')
                ->on('assigned_interns')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtr_interns');
    }
};