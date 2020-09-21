<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';         // initialize table
    protected $primaryKey = 'id';
    protected $fillable = ['name','email'];
}
