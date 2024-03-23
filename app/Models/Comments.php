<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
    	'id',
    	'comment',
    	'id_blog',
    	'id_user',
    	'avatar',
    	'level',
    	 'name',
    	 
    ];
}
