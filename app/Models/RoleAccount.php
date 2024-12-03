<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleAccount extends Model
{ 
        use HasFactory;
        protected $table =  'role_accounts';
        protected $filltable = ['mail,full_name, user_name. phone, password, role_id, job_created_at'];
        protected $primarykey = 'id';
    
        public $timestamps = true; 
}
