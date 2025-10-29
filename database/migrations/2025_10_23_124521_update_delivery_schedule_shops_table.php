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
        Schema::table('delivery_schedule_shops', function (Blueprint $table) {
            $table->string('deliver_lat')->after('delivered_at')->nullable();
            $table->string('deliver_long')->after('deliver_lat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_schedule_shops', function (Blueprint $table) {
            $table->dropColumn(['deliver_lat','deliver_long']);
        });
    }
};
