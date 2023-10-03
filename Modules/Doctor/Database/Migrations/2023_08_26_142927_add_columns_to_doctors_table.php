<?php

use App\Models\ESelectAvailableTime;
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
            ])->after('type');
            $table->enum('availability_type', [ESelectAvailableTime::FULL_TIME, ESelectAvailableTime::PART_TIME])
            ->nullable()->after('competence_type');
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
            $table->dropColumn('availability_type');
        });
    }
};
