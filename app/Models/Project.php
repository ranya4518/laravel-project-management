<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
public function User(){
    return $this->belongsTo(User::class);
}
public function Tasks(){
    return $this->hasMany(Task::class);
}
protected $fillable=[
'title','description','user_id'
];
}
