<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaveFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->longText('label')->nullable(true);
            $table->longText('values')->nullable(true);
            $table->integer('submitted_count')->nullable(true);
            $table->integer('open_count')->nullable(true);
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
        Schema::dropIfExists('save_forms');
    }
}
