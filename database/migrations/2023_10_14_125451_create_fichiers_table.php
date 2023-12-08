<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fichiers', function (Blueprint $table) {
            $table->id();
            $table->string("objet");
            $table->integer("numero");
            $table->string("destinateurt");
            $table->string("destinataire");
            $table->date("date");
            $table->foreignId("division_id")->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
           
            $table->foreignId("categorie_id")->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichiers');
    }
};
