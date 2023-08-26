<?php

use App\Models\EWeekDayType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Doctor\Models\ECompetenceType;

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
            $table->enum('competence_type',[ECompetenceType::GENERAL_DENTISTRY,
            ECompetenceType::ORTHODONTICS,
            ECompetenceType::PERIODONTOLOGY_AND_ORAL_SURGERY,
            ECompetenceType::COSMETIC_DENTISTRY,
            ECompetenceType::CHILDRENS_DENTISTRY,
            ECompetenceType::NEUROLOGY_IN_DENTISTRY,
            ])->before('type');
            $table->enum('start_day',[EWeekDayType::SATURDAY,
            EWeekDayType::SUNDAY,
            EWeekDayType::MONDAY,
            EWeekDayType::TUESDAY,
            EWeekDayType::WEDNESDAY,
            EWeekDayType::THURSDAY,
            EWeekDayType::FRIDAY,
            ])->after('competence_type');
            $table->enum('end_day',[EWeekDayType::FRIDAY,
            EWeekDayType::THURSDAY,
            EWeekDayType::WEDNESDAY,
            EWeekDayType::TUESDAY,
            EWeekDayType::MONDAY,
            EWeekDayType::SUNDAY,
            EWeekDayType::SATURDAY,
            ])->after('start_day');
            $table->time('start_time')->after('end_day');
            $table->time('end_time')->after('start_time');
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
            $table->dropColumn('competence_type');
            $table->dropColumn('start_day');
            $table->dropColumn('end_day');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
};
