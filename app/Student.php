<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Student
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Course[] $courses
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUserId($value)
 */
class Student extends Model
{
    // asignacion de datos en masa
    protected $fillable = ['user_id', 'title'];

    // se usa para añadir datos que no estan en la base de datos pero se los añadimos al modelo
    protected $appends = ['courses_formatted'];

    public function courses(){
        return $this->belongsToMany(Course::class);
    }
    public function user(){
        return $this->belongsTo(User::class)->select('id','role_id','name','email');
    }


    // al igual que lo hice en la valoracion media de los cursos, con este metodo formateo el curso para que quede mas legible
    public function getCoursesFormattedAttribute(){
          return $this->courses->pluck('name')->implode('<br>' );
    }
}
