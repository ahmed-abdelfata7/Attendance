<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_id');
            $table->string('engineer_id');
            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->text("report")->nullable();
            $table->boolean("alert")->default(0);
            $table->string("editBy")->default(0);
            $table->boolean("manually")->default(0);
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
        Schema::dropIfExists('check_lists');
    }
}
