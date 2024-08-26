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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->enum(
                "event_type",
                ["غارة من حربي", "جدار صوت", "تحليق طيران حربي", "تحليق مسيرة", "غارة من مسيرة", "قصف مدفعي", "اغتيال", "حرائق"]
            );
            $table->foreignId("Region_id")->nullable()->constrained("regions");
            $table->foreignId("user_id")->nullable()->constrained("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
