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
        Schema::create('log_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->text('reason_entry');
            $table->integer('quantity');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('production_id')->constrained('production', 'id');
            $table->datetime('date_entry');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_entry');
    }
};
