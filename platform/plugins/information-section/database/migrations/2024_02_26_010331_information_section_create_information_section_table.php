<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class InformationSectionCreateInformationSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('type', 255);
            $table->string('link_readmore', 255)->nullable();
            $table->longText('options')->nullable();
            $table->string('status', 60)->default('published');
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
        Schema::dropIfExists('information_sections');
    }
}
