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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('number')->index();
            $table->string('link')->nullable();
            $table->string('engine')->nullable();
            $table->string('year')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('source_id')->constrained();
            $table->foreignId('status_id')->constrained();
            $table->foreignId('product_id')->nullable()->constrained();
            $table->foreignId('car_id')->nullable()->constrained();
            $table->foreignId('car_model_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
