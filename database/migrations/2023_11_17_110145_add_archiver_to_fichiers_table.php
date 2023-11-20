<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('fichiers', function (Blueprint $table) {
            $table->boolean('archiver')->default(false); 
        });
    }

    public function down()
    {
        Schema::table('fichiers', function (Blueprint $table) {
            $table->dropColumn('archiver');
        });
    }
};
