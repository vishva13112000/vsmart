<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTypeValue extends Model
{
     use SoftDeletes;
    protected $PrimaryKey=['id'];
    protected $guarded=['id'];
}
