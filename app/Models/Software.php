<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;
    public $fillable = ['name'];

    /**
    * The things that uses the software.
    */
    public function things()
    {
        return $this->belongsToMany(Thing::class, 'software_thing');
    }
}