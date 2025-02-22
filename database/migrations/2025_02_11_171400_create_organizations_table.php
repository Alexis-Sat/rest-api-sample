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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('phone');
            $table->unsignedBigInteger('building_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('building_id')->on('buildings')->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->index('building_id', 'organisation_building_idx');
            $table->index('name', 'organization_name_idx');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
