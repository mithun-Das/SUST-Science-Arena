<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
 //    public function developer()
	// {
	// 	return $this->belongsToMany('App\User');
	// }

	// public function supervisor()
	// {
	// 	return $this->belongsToMany('App\User');
	// }

	// public function language()
	// {
	// 	return $this->belongsToMany('App\Language', 'language_project', 'project_id', 'language_id');
	// 	 Now, with such declaration of relationships Laravel “assumes” that pivot table name obeys the rules
	// 	 and is language_project. But, if it’s actually different (for example, it’s plural), you can provide 
	// 	 it as a second parameter: 
	// 	 // http://laraveldaily.com/pivot-tables-and-many-to-many-relationships/
	// 	// first, the current model field, and then the field of the model being joined:
	// }

	public function project()
	{
		return $this->belongsTo('App\Project', 'project_id', 'id');
	}
}
