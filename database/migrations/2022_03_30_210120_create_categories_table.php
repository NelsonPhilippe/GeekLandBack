<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });


        DB::table('categories')->insert(['name' => 'games']);
        DB::table('categories')->insert(['name' => 'console']);
        DB::table('categories')->insert(['name' => 'e-material']);
        DB::table('categories')->insert(['name' => 'figurine']);
        DB::table('categories')->insert(['name' => 'goodies']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
