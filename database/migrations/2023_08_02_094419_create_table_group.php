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
        Schema::create('group', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->unique()->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('group_leader_id')->nullable(false);
            $table->integer('group_floor_number')->nullable(false);
            $table->date('created_date')->nullable();
            $table->date('updated_date')->nullable();
            $table->date('deleted_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_group');
    }
};
