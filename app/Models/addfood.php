<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addfood extends Model
{
    use HasFactory;

    public function getLogin(){
        return $this->belongsTo(login::class,"login_id","id");
    }
}
