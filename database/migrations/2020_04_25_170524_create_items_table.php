<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Item;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_code');
            $table->integer('building_id')->nullable();
            $table->integer('section_group_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->integer('item_group_id')->nullable();
            $table->string('name')->nullable();
            $table->string('icon')->nullable(); 
            $table->string('icon_color')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
