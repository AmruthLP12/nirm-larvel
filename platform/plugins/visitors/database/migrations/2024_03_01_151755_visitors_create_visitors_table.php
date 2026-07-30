<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class VisitorsCreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('visitors');
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->timestamp('visited_at');
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
        Schema::dropIfExists('visitors');
    }
}
