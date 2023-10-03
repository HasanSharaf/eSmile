<?php

use App\Models\ESelectAvailableTime;
use App\Models\EWeekDayType;
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
        Schema::create('doctor_work_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->enum('day_of_week',
            [
            EWeekDayType::SATURDAY,
            EWeekDayType::SUNDAY,
            EWeekDayType::MONDAY,
            EWeekDayType::TUESDAY,
            EWeekDayType::WEDNESDAY,
            EWeekDayType::THURSDAY,
            EWeekDayType::FRIDAY,
            ])->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_work_times');
    }
};
