<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function Project(){
        return $this->belongsTo(Project::class);
    }
   public function Tags(){
    return $this->belongsToMany(Tag::class,'task-tag');
   }
    protected $fillable=[
   'name','completed','project_id'
    ];
}
