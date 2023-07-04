<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->unsignedBigInteger('app_id');
            $table->integer('sort_no');
            $table->integer('status');
            $table->integer('workstation_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('app_id')
                ->references('id')
                ->on('apps');

            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            
            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
        });

        DB::table('app_modules')->insert([
            [
                'name' => 'APP', 
                'code' => 'app', 
                'app_id' => 1,
                'sort_no' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'APP TYPE', 
                'code' => 'app_type', 
                'app_id' => 1,
                'sort_no' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'APP MODULE', 
                'code' => 'app_module', 
                'app_id' => 1,
                'sort_no' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'USER', 
                'code' => 'user', 
                'app_id' => 2,
                'sort_no' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'ROLES', 
                'code' => 'roles', 
                'app_id' => 2,
                'sort_no' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'ACCESS', 
                'code' => 'access', 
                'app_id' => 2,
                'sort_no' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_modules');
    }
}
