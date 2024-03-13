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
        Schema::create('project_technology', function (Blueprint $table) {
            // FK
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')
                    ->references('id')
                    ->on('technologies')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            // PK
            $table->primary(['project_id', 'technology_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
