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
        Schema::create('event_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("event_id")->constrained("events")->cascadeOnDelete();
            $table->foreignId("ExactLocation_id")->constrained("regions");
            $table->longText("description")->nullable();
            $table->enum("HumanCasualties"  ,["لا توجد إصابات بشرية" , "إصابات طفيفة" , "إصابات خطيرة" , "وفيات" , "غير معروف"]);
            $table->enum("DamageType"  ,["لا توجد أضرار" , "أضرار طفيفة بالمباني" , "أضرار جسيمة بالمباني" , "تدمير كامل" , "أضرار بالمركبات" , "حرائق" , "أضرار بالبنية التحتية" , "غير معروف"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_details');
    }
};


