<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

	public function project()
	{
		return $this->belongsToMany('App\Projct', 'language_project','language_id', 'project_id');
		/* Now, with such declaration of relationships Laravel “assumes” that pivot table name obeys the rules
		 and is language_project. But, if it’s actually different (for example, it’s plural), you can provide 
		 it as a second parameter: */
		// first, the current model field, and then the field of the model being joined:
	}
}
