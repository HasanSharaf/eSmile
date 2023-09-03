<?php

use App\Models\ESelectType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\User\Models\EUserClinicKnowledge;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('clinic_knowledge', [
                EUserClinicKnowledge::SOCIAL_MEDIA,
                EUserClinicKnowledge::THROUGH_SOMEONE,
                EUserClinicKnowledge::ROAD_SIGN,
                EUserClinicKnowledge::RECOMMENDATION,
                EUserClinicKnowledge::ETC,
            ]);
            $table->string('clinic_note')->nullable();
            $table->string('sickness')->nullable();
            $table->enum('sensitive', [
                ESelectType::NO,
                ESelectType::YES,
                ESelectType::DONT_KNOW,
                ESelectType::MAYBE,
            ]);
            $table->string('sensitive_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

        });
    }
};
