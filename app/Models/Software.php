<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'softwares';
    use HasFactory;
    public $fillable = ['applicationcategory', 'description', 'license', 'maintainer', 'name', 'url'];

    /**
    * The things that uses the software.
    */
    public function things()
    {
        return $this->belongsToMany(Thing::class, 'software_thing')->withPivot(['function', 'number_of_branchs', 'number_of_records', 'software_version', 'url']);
    }
}