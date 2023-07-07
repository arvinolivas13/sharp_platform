<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->integer('status');
            $table->integer('sort_no');
            $table->integer('workstation_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            
            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
        });
        
        DB::table('app_types')->insert([
            [
                'name' => 'MAINTENANCE', 
                'code' => 'maintenance', 
                'status' => 1,
                'sort_no' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'TRANSACTION', 
                'code' => 'transaction', 
                'status' => 1,
                'sort_no' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'SETUP', 
                'code' => 'setup', 
                'status' => 1,
                'sort_no' => 3,
                'created_by' => 1,
                'updated_by' => 1,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_types');
    }
}
