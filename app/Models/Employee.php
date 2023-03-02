<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
   
    protected $table = 'employee';
    protected $fillable = ['first_name','phone','last_name','company_id', 'email'];
}
