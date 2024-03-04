<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    protected $table = 'd_user';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_level_id','nama','email','username','password'];
    public $timestamps = false;

    public static function get_user()
    {
        return self::join('d_user_level', 'd_user.user_level_id', '=', 'd_user_level.user_level_id')->get();
    }

    public static function get_user_level()
    {
        return DB::table('d_user_level')->get();
    }
}
