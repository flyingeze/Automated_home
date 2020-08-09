<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

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
            $table->id();
            $table->string('name');
            $table->integer('building_id')->default(1);
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('role')->default('member');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
        (new User)->create([
            'name'=>'Supper Admin', 
            'email'=>'supperadmin@test.com', 
            'phone'=>'08038831882',
            'building_id'=>'1',
            'role'=>'supper admin',
            'password'=>'$2y$10$yAJZelMsSlSdfq2VrDVQIOoFDj72LUcW1e5ZIAfOfX5Oh08sL5DKm',//password
            ]);
        (new User)->create([
            'name'=>'Admin', 
            'email'=>'admin1@test.com', 
            'phone'=>'08038831882',
            'building_id'=>'1',
            'role'=>'admin',
            'password'=>'$2y$10$yAJZelMsSlSdfq2VrDVQIOoFDj72LUcW1e5ZIAfOfX5Oh08sL5DKm',//password
            ]);
        (new User)->create([
            'name'=>'User', 
            'email'=>'user1@test.com', 
            'phone'=>'08038831882',
            'building_id'=>'1',
            'role'=>'member',
            'password'=>'$2y$10$yAJZelMsSlSdfq2VrDVQIOoFDj72LUcW1e5ZIAfOfX5Oh08sL5DKm',//password
            ]);


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
