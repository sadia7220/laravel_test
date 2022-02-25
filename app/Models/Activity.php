<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $connection = 'mysql2';
    protected $fillable = [ 'causer', 'causer_type','causer_info', 'path', 'method', 'parameters', 'previous_data'];

}
 
