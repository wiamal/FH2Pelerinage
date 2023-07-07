<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdherentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adherent', function (Blueprint $table) {
            $table->bigIncrements('IdAdherent');
            $table->string('Affiliation')->unique();
            $table->string('Nom');
            $table->string('Prenom');
            $table->string('NomAr')->nullable();
            $table->string('PrenomAr')->nullable();
            $table->string('CIN')->unique();
            $table->date('DateNaissance');
            $table->string('Adresse');
            $table->string('AdresseAr')->nullable();
            $table->string('GSM');
            $table->string('Fixe')->nullable();
            $table->char('Genre',1);
            $table->timestamps();
            
           

            /* $table->enum('', ['celib', 'ma']); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adherent');
    }
}
