<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeUser extends Model
{
    use HasFactory;

    public $timestamps = false;
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function income(){
        return $this->belongsTo('App\Models\Income');
    }
}
