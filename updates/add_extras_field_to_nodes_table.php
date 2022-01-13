<?php namespace Trepmag\Rest\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AddExtrasFieldToNodesTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('trepmag_rest_nodes')) {
            Schema::table('trepmag_rest_nodes', function (Blueprint $table) {
                $table->string('extras')->after('is_disabled')->default('{}');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('trepmag_rest_nodes')) {
            Schema::table('trepmag_rest_nodes', function (Blueprint $table) {
                $table->dropColumn('extras');
            });
        }
    }
}
