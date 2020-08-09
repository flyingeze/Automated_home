<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $guarded = ['id'];

    function sectionGroups(){
        return $this->hasMany(Group::class, 'building_id');
    }

    function sections(){
        return $this->hasMany(Section::class, 'building_id');
    }

    function itemGroups(){
        return $this->hasMany(ItemGroup::class, 'building_id');
    }

    function items(){
        return $this->hasMany(Item::class, 'building_id');
    }

    function users(){
        return $this->hasMany(User::class);
    }
    
    function settings(){
        return $this->hasMany(Setting::class, 'building_id');
    }

    public function totalSectionGroupCount(): int
    {
        return $this->sectionGroups()->count();
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
    
    public function totalUserCount(): int
    {
        return $this->users()->count();
    }
    
    public function primaryId(): string
    {
        return (string)$this->getAttribute($this->primaryKey);
    }
    
}
