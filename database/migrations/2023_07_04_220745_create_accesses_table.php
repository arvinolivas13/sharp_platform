<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->string('permission_for');
            $table->integer('permission_for_id');
            $table->integer('enable');
            $table->integer('add');
            $table->integer('edit');
            $table->integer('delete');
            $table->integer('print');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')
                ->on('roles');

            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            
            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
        });

        
        DB::table('accesses')->insert([
            [
                'role_id' => 1, 
                'permission_for' => 'apps',
                'permission_for_id' => 1,
                'enable' => 1,
                'add' => 0,
                'edit' => 0,
                'delete' => 0,
                'print' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'role_id' => 1, 
                'permission_for' => 'apps',
                'permission_for_id' => 2,
                'enable' => 1,
                'add' => 0,
                'edit' => 0,
                'delete' => 0,
                'print' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'role_id' => 1, 
                'permission_for' => 'apps',
                'permission_for_id' => 3,
                'enable' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'print' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'role_id' => 1, 
                'permission_for' => 'app_module',
                'permission_for_id' => 1,
                'enable' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'print' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'role_id' => 1, 
                'permission_for' => 'app_module',
                'permission_for_id' => 2,
                'enable' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'print' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'role_id' => 1, 
                'permission_for' => 'app_module',
                'permission_for_id' => 3,
                'enable' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'print' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'role_id' => 1, 
                'permission_for' => 'app_module',
                'permission_for_id' => 4,
                'enable' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'print' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'role_id' => 1, 
                'permission_for' => 'app_module',
                'permission_for_id' => 5,
                'enable' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'print' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'role_id' => 1, 
                'permission_for' => 'app_module',
                'permission_for_id' => 6,
                'enable' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'print' => 1,
                'created_by' => 1,
                'updated_by' => 1
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
        Schema::dropIfExists('accesses');
    }
}
