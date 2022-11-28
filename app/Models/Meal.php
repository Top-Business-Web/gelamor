<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [

        'name_ar',
        'name_en',
        'img',
        'protein',
        'calories',
        'Fats',
        'carbohydrates',
        'meal_type_id'


    ];


    public function meal_type(){


        return $this->belongsTo(MealType::class,'meal_type_id','id');

    }

    //relation many to many

    public function component(){

        return $this->belongsToMany(Component::class,'meal_components','meal_id','component_id','id','id');
    }



    public function user(){

        return $this->belongsToMany(User::class,'orders','meal_id','user_id','id','id');
    }

    public function comments()
    {
        $this->hasMany(Comment::class);
    }

}
