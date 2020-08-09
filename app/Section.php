<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    
    protected $guarded = ['id'];
    
    function building(){
        return $this->belongsTo(Building::class, 'building_id');
    }

    function sectionGroup(){
        return $this->belongsTo(Group::class, 'section_group_id');
    }

    function itemGroups(){
        return $this->hasMany(ItemGroup::class, 'section_id');
    }

    function items(){
        return $this->hasMany(Item::class, 'section_id');
    }

    public function totalItemGroupCount(): int
    {
        return $this->itemGroups()->count();
    }
    
    public function totalItemCount(): int
    {
        return $this->items()->count();
    }
    
    public function primaryId(): string
    {
        return (string)$this->getAttribute($this->primaryKey);
    }
}
