<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    function sectionGroups(){
        return view('admin.section-groups');
    }
    
    function sections(){
        return view('admin.sections');
    }
    
    function section(){
        return view('admin.section');
    }
    
    function itemGroup(){
        return view('admin.item-group');
    }
    
    function items(){
        return view('admin.items');
    }
    
    function item(){
        return view('admin.item');
    }
    
    function users(){
        return view('admin.users');
    }
    
    function user(){
        return view('admin.user');
    }
    
    function settings(){
        return view('admin.settings');
    }
}
