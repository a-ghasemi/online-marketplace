<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = "MyISAM";

            $table->bigIncrements('id');
            $table->unsignedInteger('cat_id');
            $table->string('title');
            $table->unsignedBigInteger('price');
            $table->text('description')->nullable()->default(NULL);
            $table->timestamps();
        });

        Schema::create('product_quantities', function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->bigIncrements('id');
            $table->bigInteger('product_id');
            $table->unsignedInteger('quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_quantities');
        Schema::dropIfExists('products');
    }
}
