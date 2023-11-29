<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceIdToFichiers extends Migration
{
    public function up()
    {
        Schema::table('fichiers', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable();

            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    public function down()
    {
        Schema::table('fichiers', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
    }
}
