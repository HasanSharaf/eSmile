<?php

use App\Models\ESelectAvailableTime;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            // $table->enum('availability_type', [ESelectAvailableTime::FULL_TIME, ESelectAvailableTime::PART_TIME])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            // $table->dropColumn('availability_type');
        });
    }
};
