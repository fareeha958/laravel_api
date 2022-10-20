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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->timestamps();// created_at and updated_at
            $table->string('model_type');
            $table->string('name');
            $table->string('file_name');
            $table->string('disk');
            $table->string('size');
            $table->string('manipulations');
            $table->string('custom_properties');
            $table->string('responsive_images');
            $table->string('order_column');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');

    }
};
