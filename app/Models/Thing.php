<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    use HasFactory;
    public $fillable = ['id_lattes13', 'name', 'type', 'url'];

    /**
    * The softwares that this thing uses.
    */

    public function softwares()
    {
        return $this->belongsToMany(Software::class, 'software_thing')->withPivot(['function', 'software_version', 'number_of_branchs', 'url']);
    }

    public function works()
    {
        return $this->belongsToMany(Work::class, 'thing_work');
    }

    
}