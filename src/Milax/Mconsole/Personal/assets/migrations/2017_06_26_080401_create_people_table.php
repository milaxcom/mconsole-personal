<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->json('name')->nullable();
            $table->json('preview')->nullable();
            $table->json('biography')->nullable();
            $table->json('position')->nullable();
            $table->json('contacts')->nullable();
            $table->timestamp('hired_at')->nullable();
            $table->json('title')->nullable();
            $table->json('description')->nullable();
            $table->boolean('enabled')->default(true);
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
        Schema::drop('people');
    }
}
