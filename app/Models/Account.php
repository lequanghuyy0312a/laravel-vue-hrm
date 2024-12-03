<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Sử dụng lớp Authenticatable
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Account extends Authenticatable
{
    use Notifiable, HasApiTokens;

    // Chỉ định bảng
    protected $table = 'accounts';

    // Các trường được phép gán giá trị
   protected $fillable = [
        'mail',
        'full_name',
        'user_name',
        'phone',
        'password',
        'role_id',
        'job_created_at',
        'job_position_id',

    ];
    // Ẩn trường password khi trả về JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
