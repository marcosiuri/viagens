<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCaminhoImagemToDestinosTable extends Migration
{
    public function up()
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->string('caminho_imagem')->nullable()->after('imagem');
        });
    }

    public function down()
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->dropColumn('caminho_imagem');
        });
    }
}

