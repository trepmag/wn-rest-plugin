<?php namespace Trepmag\Rest\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateNodesTable extends Migration
{
    public function up()
    {
        Schema::create('trepmag_rest_nodes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('path')->unique();
            $table->string('owner');
            $table->boolean('is_disabled')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trepmag_rest_nodes');
    }
}
