<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL2ppOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l2pp_organizations', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('type_id', 10);
            $table->string('slug', 100);
            $table->string('name', 100);
            $table->string('name_genitive', 100)->default('');
            $table->string('name_prepositional', 100)->default('');
            $table->json('media');
            $table->json('extra_attributes');
            $table->tinyInteger('priority', false, true)->default(50);

            $table->unique(['type_id', 'slug']);
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
        Schema::dropIfExists('l2pp_organizations');
    }
}
