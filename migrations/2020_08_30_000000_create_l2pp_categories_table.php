<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL2ppCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l2pp_categories', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->primary();
            $table->string('service_id', 50);
            $table->unsignedSmallInteger('group_id')->default(0);
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('name_full', 255)->default('');
            $table->boolean('dynamic')->default(false);
            $table->json('dynamic_conditions')->default('[]');

            $table->unique(['service_id', 'slug']);
            $table->index('slug');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l2pp_categories');
    }
}
