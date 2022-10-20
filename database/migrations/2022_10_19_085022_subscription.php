<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
// {
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     //
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
//     public function down()
{
    /**
      * Run the migrations.
      *
      * @return void
      */
    public function up()
    {
      Schema::create('subscription', function (Blueprint $table) {
          $table->id();
          $table->timestamps(); // created_at and updated_at
          $table->string('user_id');
          $table->string('subscriptionable_id');
      });
    }

    /**
      * Reverse the migrations.
      *
      * @return void
      */
    public function down()
    {
      Schema::dropIfExists('subscription');
    }
  };
