<?php
namespace App\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Base;

class CreateTablesBlog
{
    public function up()
    {
        Base::initConnection();

        Capsule::schema()->dropIfExists('users');
        Capsule::schema()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('email', 30);
            $table->string('password', 255);
            $table->char('photo', 14);
            $table->timestamps();
            $table->softDeletes();
        });

        Capsule::schema()->dropIfExists('posts');
        Capsule::schema()->create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->text('text');
            $table->string('img_name', 15);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
