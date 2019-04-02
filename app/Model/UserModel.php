<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    protected $table="p_users";
    public $update_at=false;
    protected $primaryKey = 'uid';
}
