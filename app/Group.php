<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    
    protected $guarded = ['id'];

    function building(){
        return $this->belongsTo(Building::class, 'building_id');
    }

    function sections(){
        return $this->hasMany(Section::class, 'section_group_id');
    }

    function itemGroups(){
        return $this->hasMany(ItemGroup::class, 'section_group_id');
    }

    function items(){
        return $this->hasMany(Item::class, 'section_group_id');
    }
    
    public function totalSectionCount(): int
    {
        return $this->sections()->count();
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
