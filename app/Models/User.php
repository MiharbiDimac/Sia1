<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class User extends Model{
    protected $table = 'tblbooks';
    protected $primaryKey = 'BookID';
    public $timestamps = false;
    // column sa table
     protected $fillable = [
        'BookID', 'BookName', 'YearPublish', 'AuthorID'
    ];
}