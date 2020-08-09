<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'ViewController@index')->name('home');
    Route::post('/', 'HomeController@changePassword')->name('changePassword');

    Route::get('admin/section-groups', 'AdminViewController@sectionGroups')
        ->name('admin.sectionGroups'); // admin view 
    Route::get('admin/sections', 'AdminViewController@sections')
        ->name('admin.sections'); // admin view 
    Route::get('admin/section/{section}', 'AdminViewController@section')
        ->name('admin.section'); // admin view 
    Route::get('admin/item-groups', 'AdminViewController@itemGroup')
        ->name('admin.itemGroup'); // admin view 
    Route::get('admin/items', 'AdminViewController@items')
        ->name('admin.items'); // admin view 
    Route::get('admin/item/{item}', 'AdminViewController@item')
        ->name('section.item'); // admin view an item in his home
    Route::get('admin/users', 'AdminViewController@users')
        ->name('admin.users'); // admin view list of home users
    Route::get('admin/user/{username}', 'AdminViewController@user')
        ->name('admin.user'); // admin view a home user
    Route::get('admin/settings', 'AdminViewController@settings')
        ->name('admin.setting'); // admin view a home setting

    Route::get('sections', 'ViewController@mySections')
        ->name('user.sections'); // user sections 
    Route::get('items', 'ViewController@myItems')
        ->name('user.items'); // user sections
        
    Route::get('section-groups', 'ViewController@sectionGroups')
        ->name('section.groups');//view list of section group

    Route::get('{group}/sections', 'ViewController@sections')
        ->name('sections');//view list of sections in a group
    Route::get('{group}/{section}/item-groups', 'ViewController@section')
        ->name('section');//view list of item groups
    Route::get('{group}/{section}/{itemGroup}/items', 'ViewController@itemGroups')
        ->name('items');//view list of items in an item group

    Route::get('profile', 'ViewController@profile')
        ->name('profile');//view current user profile

    Route::get('/get-data', 'HomeController@index');
    Route::get('/get-all-data', 'HomeController@adminIndex');
    Route::get('/get-sections/{group}', 'HomeController@getSections');
    Route::get('/get-section/{group}/{section}', 'HomeController@getSection');
    Route::get('/get-items/{group}/{section}/{itemGroup}', 'HomeController@getItems');
    Route::get('/change-item-state/{item}', 'HomeController@changeItemState');
    Route::post('/update-profile', 'HomeController@updateProfile');
    
    Route::post('/add-user', 'HomeController@addUser');
    Route::post('/update-user', 'HomeController@updateUser');
    Route::post('/delete-user', 'HomeController@deleteUser');
    Route::post('/grant-user-access', 'HomeController@grantUserAccess');
    
    Route::post('/add-section', 'HomeController@addSection');
    Route::post('/update-section', 'HomeController@updateSection');
    Route::post('/delete-section', 'HomeController@deleteSection');

    Route::post('/add-section-group', 'HomeController@addSectionGroup');
    Route::post('/update-section-group', 'HomeController@updateSectionGroup');
    Route::post('/delete-section-group', 'HomeController@deleteSectionGroup');
    
    Route::post('/add-item', 'HomeController@addItem');
    Route::post('/update-item', 'HomeController@updateItem');
    Route::post('/delete-item', 'HomeController@deleteItem');

    Route::post('/add-item-group', 'HomeController@addItemGroup');
    Route::post('/update-item-group', 'HomeController@updateItemGroup');
    Route::post('/delete-item-group', 'HomeController@deleteItemGroup');


}); 

Auth::routes();
