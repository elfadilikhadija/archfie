<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropServiceIdColumnFromUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the service_id column
            $table->dropColumn('service_id');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // If needed, you can recreate the service_id column in the down method
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id')->references('id')->on('services');
        });
    }
}
