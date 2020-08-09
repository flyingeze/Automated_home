<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    protected $guarded = ['id'];

    function building(){
        return $this->belongsTo(Building::class, 'building_id');
    }

    function sectionGroup(){
        return $this->belongsTo(Group::class, 'section_group_id');
    }
    
    function section(){
        return $this->belongsTo(Section::class, 'section_id');
    }

    function items(){
        return $this->hasMany(Item::class, 'item_group_id');
    }
    
    public function totalItemCount(): int
    {
        return $this->items()->count();
    }
}
