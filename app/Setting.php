<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['id'];

    function building(){
        return $this->belongsTo(Building::class, 'building_id');
    }
    
    public function primaryId(): string
    {
        return (string)$this->getAttribute($this->primaryKey);
    }
}
