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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('url', 255)->nullable();
            $table->json('contributions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('type_id')->constrained('portfolio_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
