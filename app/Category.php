<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function project()
    {
        return $this->hasMany('App\Project', 'category_id', 'id');
    }
}
