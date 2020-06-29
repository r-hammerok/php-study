<?php
namespace App\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Base;

class CreateTablesMagazine
{
    public function up()
    {
        Base::initConnection();

        Capsule::schema()->dropIfExists('products');
        Capsule::schema()->create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_category');
            $table->string('name');
            $table->string('description');
            $table->decimal('purchase_price', 10, 2);
            $table->string('specifications');
            $table->string('photo');
            $table->timestamps();
            $table->softDeletes();
        });

        Capsule::schema()->dropIfExists('categories');
        Capsule::schema()->create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_category');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
