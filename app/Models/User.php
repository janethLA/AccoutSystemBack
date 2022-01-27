<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
       
        'remember_token',
    ];

    public $timestamps = false;


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
         return $this->belongsTo('App\Models\Role');
    }

    public function income(){
        return $this->hasMany('App\Models\Income');
    }

    public function expense(){
        return $this->hasMany('App\Models\Expense');
    }

    public function income_user(){
        return $this->hasMany('App\Models\IncomeUser');
    }

    public function expense_user(){
        return $this->hasMany('App\Models\ExpenseUser');
    }

    // public function limit(){
    //     return $this->hasMany('App\Models\Limit');
    // }

    
} 