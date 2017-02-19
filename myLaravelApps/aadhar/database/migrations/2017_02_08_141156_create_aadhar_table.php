<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAadharTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aadhars', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid');
            $table->integer('address_id');
            $table->integer('poi_id'); 
            $table->string('mobile', 20); 
            $table->string('email', 30); 
            $table->string('pan', 15);
        });

        Schema::create('aadhars_revisions', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid');
            $table->integer('address_id');
            $table->integer('poi_id'); 
            $table->string('mobile', 20); 
            $table->string('email', 30); 
            $table->string('pan', 15);
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid');
            $table->integer('city_id');
            $table->integer('pincode');
            $table->integer('stage_id'); 
            $table->integer('address_type_id');
            $table->integer('poa_id');  
            $table->string('line_1'); 
            $table->string('line_2');
            $table->string('country',10)->default('India'); 
        });
        

        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->integer('states_id');
        });
        
        Schema::create('address_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('description', 50);
        });
        
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('mimetype', 10);
            $table->string('relative_url',100); 
            $table->integer('file_type_id'); 
        });

        Schema::create('file_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('description', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aadhars');
        Schema::dropIfExists('aadhars_revisions');
        Schema::dropIfExists('files');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('city');
        Schema::dropIfExists('state');
    }
}
