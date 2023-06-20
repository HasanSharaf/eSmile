<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\SubSession\Models\EPaymentType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->double('paid')->nullable();
            $table->enum('payment_type',[EPaymentType::CASH, EPaymentType::CARD]);
            $table->string('description')->nullable();
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
        Schema::dropIfExists('sub_sessions');
    }
};
