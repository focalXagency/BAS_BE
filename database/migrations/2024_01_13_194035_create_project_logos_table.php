<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_logos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('latest_projects')->cascadeOnDelete()->cascadeOnUpdate();
            $table->binary('logo');
            $table->longText('path');
            $table->integer('order');
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
        Schema::dropIfExists('project_logos');
    }
};
