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
        Schema::create('application_company', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('company_id')->unsigned();
            $table->unsignedBiginteger('application_id')->unsigned();

            $table->foreign('company_id')->references('id')
                ->on('companies')->onDelete('cascade');
            $table->foreign('application_id')->references('id')
                ->on('applications')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications_companies');
    }
};