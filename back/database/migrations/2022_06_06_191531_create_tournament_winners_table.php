<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_winners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained();
            $table->foreignId('idea_id')->constrained();
            $table->enum('phase', ['first', 'second', 'final'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournament_winners');
    }
};
