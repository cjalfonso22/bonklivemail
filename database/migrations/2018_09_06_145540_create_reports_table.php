<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('report_id');
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('sent')->default(0);
            $table->unsignedInteger('received')->default(0);
            $table->unsignedInteger('opened')->default(0);
            $table->unsignedInteger('subscribed')->default(0);
            $table->unsignedInteger('bounced')->default(0);
            $table->unsignedInteger('blocked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
