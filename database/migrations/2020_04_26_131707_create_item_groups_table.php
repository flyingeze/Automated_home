<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\ItemGroup;

class CreateItemGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('item_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('building_id')->nullable();
            $table->integer('section_group_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('name')->nullable();
            $table->string('icon')->nullable(); 
            $table->string('icon_color')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('item_groups');
    }
}
