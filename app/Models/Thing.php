<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    use HasFactory;
    public $fillable = ['schema_org_type', 'name'];

    /**
    * The softwares that this thing uses.
    */

    public function softwares()
    {
        return $this->belongsToMany(Software::class, 'software_thing');
    }

    
}