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
        Schema::create('journal_marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')
                ->constrained('journals')
                ->onDelete('cascade');

            // SECTION 2
            $table->integer('section_2a')->nullable();
            $table->integer('section_2b')->nullable();
            $table->integer('section_2c')->nullable();
            $table->integer('section_2d')->nullable();
            $table->integer('section_2e')->nullable();

            // SECTION 3
            $table->integer('section_3a')->nullable();
            $table->integer('section_3b')->nullable();
            $table->integer('section_3c')->nullable();
            $table->integer('section_3d')->nullable();

            // SECTION 4
            $table->integer('section_4a')->nullable();
            $table->integer('section_4b')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_marks');
    }
};
