<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('snapshots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_type');
            $table->string('model_id');
            $table->string('label')->unique();
            $table->string('event_type');
            $table->json('data');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['model_type', 'model_id'], 'idx_model');
            $table->index('event_type', 'idx_event_type');
            $table->index('created_at', 'idx_created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('snapshots');
    }
};
