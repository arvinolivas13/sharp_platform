<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->integer('sort_no');
            $table->unsignedBigInteger('app_type_id');
            $table->integer('status');
            $table->integer('module');
            $table->string('icon')->default('file');
            $table->integer('workstation_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('app_type_id')
                ->references('id')
                ->on('app_types');

            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            
            $table->foreign('updated_by')
                ->references('id')
                ->on('users');

        });

        DB::table('apps')->insert([
            [
                'name' => 'APP SETUP', 
                'code' => 'app_setup', 
                'status' => 0,
                'sort_no' => 1,
                'app_type_id' => 3,
                'icon' => 'rocket',
                'module' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'USER SETUP', 
                'code' => 'user_setup', 
                'status' => 0,
                'sort_no' => 2,
                'app_type_id' => 3,
                'icon' => 'user',
                'module' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'ACTIVITY LOGS', 
                'code' => 'activity_log', 
                'status' => 0,
                'sort_no' => 2,
                'app_type_id' => 3,
                'icon' => 'list',
                'module' => 0,
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
        Schema::dropIfExists('apps');
    }
}
