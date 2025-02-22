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
        Schema::create('business_organization', function (Blueprint $table) {
            $table->foreignId('organization_id')->nullable();
            $table->foreignId('business_id')->nullable();

            $table->foreign('business_id')->on('businesses')->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreign('organization_id')->on('organizations')->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_organisation');
    }
};
