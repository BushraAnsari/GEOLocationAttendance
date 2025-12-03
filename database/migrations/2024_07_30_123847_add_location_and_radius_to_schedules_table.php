<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationAndRadiusToSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Adding columns for location and radius
            $table->decimal('latitude', 10, 7)->nullable()->after('time_in');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->decimal('radius', 8, 2)->default(1.00)->after('longitude'); // Radius in kilometers
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Dropping columns if rollback is needed
            $table->dropColumn(['latitude', 'longitude', 'radius']);
        });
    }
}
