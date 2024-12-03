<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPosition extends Model
{
    use HasFactory;
    protected $table =  'job_position';
    protected $filltable = 'name';
    protected $primarykey = 'id';

    public $timestamps = true;
}