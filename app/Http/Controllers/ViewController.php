<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Group;
use App\Section;
use App\ItemGroup;
use App\Item;
use App\User;

class ViewController extends Controller
{
    function index(){
        return view('user.index');
    }

    // view all section groups
    function sectionGroups(){
        return view('user.section-groups');
    }

    // view all section in a group
    function sections($group){
        $user = auth()->user();
        $sectionGroup = Group::where('building_id', $user->building_id)
                ->where('id', $group)->first();
        return view('user.sections')->with([
            'sectionGroup'=>$sectionGroup,
        ]);
    }

    // view a section in a group displaying group of items
    function section($group, $section){
        return view('user.section')->with([
            'sectionGroup'=>$group,
            'section'=>$section,
        ]);
    }

    // view list of items in an item group 
    function itemGroups($group, $section, $itemGroup){
        return view('user.items')->with([
            'sectionGroup'=>$group,
            'section'=>$section,
            'itemGroup'=>$itemGroup,
        ]);
    }

    //view an item
    function item($group, $section, $itemGroup, $item){
        return view('user.item');
    }

    // view current user profile
    function profile(){
        return view('user.profile');
    }

    // view current user accessible sections
    function mySections(){
        return view('user.my-sections');
    }

    // view current user accessible items
    function myItems(){
        return view('user.my-items');
    }
}
