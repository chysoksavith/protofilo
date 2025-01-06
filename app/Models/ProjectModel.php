<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;

    protected $table = 'projects';
    public function images(){
        return $this->hasMany(ImageModel::class, 'project_id', 'id');
    }
}
