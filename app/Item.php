<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
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

    function itemGroup(){
        return $this->belongsTo(ItemGroup::class, 'item_group_id');
    }
    
    public function primaryId(): string
    {
        return (string)$this->getAttribute($this->primaryKey);
    }

}
