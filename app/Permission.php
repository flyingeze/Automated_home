<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
    protected $guarded = ['id'];

    function permitted($permitted){
        return $this->belongsTo(get_class($permitted), 'permitted_id');
    }

    function permitable($permitable){
        return $this->belongsTo(get_class($permitable), 'permitable_id');
    }

    function itemizedOn($permitted){
        return $this->belongsTo($permitted, 'permitted_id');
    }

    function permittedBy($permitable){
        return $this->belongsTo($permitable, 'permitable_id');
    }
    
    public function primaryId(): string
    {
        return (string)$this->getAttribute($this->primaryKey);
    }
}
