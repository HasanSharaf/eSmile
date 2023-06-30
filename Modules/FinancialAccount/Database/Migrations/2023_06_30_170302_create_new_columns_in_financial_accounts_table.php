<?php

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
        Schema::table('financial_accounts', function (Blueprint $table) {
            $table->double('full_cost')->after('user_id');
            $table->double('paid')->after('full_cost');
            $table->double('remaining_cost')->after('paid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financial_accounts', function (Blueprint $table) {
            $table->dropColumn('paid');
            $table->dropColumn('full_cost');
            $table->dropColumn('remaining_cost');
        });
    }
};
