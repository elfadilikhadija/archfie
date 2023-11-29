<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDivisionIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the division_id column
            $table->unsignedBigInteger('division_id')->nullable();

            // Add foreign key constraint
            $table->foreign('division_id')->references('id')->on('divisions');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the division_id column and its foreign key constraint in the down method
            $table->dropForeign(['division_id']);
            $table->dropColumn('division_id');
        });
    }
}
