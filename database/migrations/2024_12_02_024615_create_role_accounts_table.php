<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('role_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('mail', 20)->unique();
            $table->string('full_name', 200)->nullable();
            $table->string('user_name', 200)->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('password', 200);
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('job_position_id');
            $table->date('job_created_at');
            $table->timestamps(); 
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('job_position_id')->references('id')->on('job_position')->onDelete('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_accounts');
    }
}
