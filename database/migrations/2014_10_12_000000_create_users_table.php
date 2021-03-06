<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->comment('名称');
            $table->string('email', 50)->unique()->comment('邮箱');
            $table->string('password',64)->comment('密码');
            $table->tinyInteger('is_admin')->default(0)->comment('是否是管理员； 1:是；0：不是');
            $table->ipAddress('login_ip')->nullable()->comment('登录ip');
            $table->integer('login_time')->nullable()->comment('登录时间');
            $table->rememberToken();
            $table->integer('created_at')->comment('创建时间');
            $table->integer('updated_at')->comment('更新时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
