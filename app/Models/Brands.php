<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brands extends Model
{
     use SoftDeletes;
     protected $table='brands';
     protected $PrimaryKey=['id'];
     protected $guarded=['id'];
}
