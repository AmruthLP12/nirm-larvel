<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SliderCreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sliders');
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->string('status', 60)->default('published');
            $table->string('description', 191)->nullable();
            $table->string('link', 300)->nullable();
            $table->string('title_button', 191)->nullable();
            $table->string('image', 300)->nullable();
            $table->tinyInteger('order')->default(0);
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
        Schema::dropIfExists('sliders');
    }
}
