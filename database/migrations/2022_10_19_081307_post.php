<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
        //
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
        //
    // }
// };

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use varchar(255);

return new class extends Migration
{
    /**
      * Run the migrations.
      *
      * @return void
      */
    public function up()
    {
      Schema::create('post', function (Blueprint $table) {
        $table->id();
        $table->timestamps(); // created_at and updated_at
        $table->string('title');
        $table->string('slug');
        $table->string('posted_at');
      });
    }

//     /**
//       * Reverse the migrations.
//       *
//       * @return void
//       */
    public function down()
    {
      Schema::dropIfExists('post');
    }
};
