<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\User\Models\EUserGender;
use Modules\User\Models\EUserStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender',[EUserGender::MALE, EUserGender::FEMALE]);
            $table->integer('phone_number');
            $table->string('location');
            $table->string('location_details');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            // $table->enum('status',[EUserStatus::ACTIVE, EUserStatus::DEACTIVE])->default(EUserStatus::DEACTIVE);
            // $table->timestamp('approved_at')->useCurrent();
            // $table->string('approved_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
