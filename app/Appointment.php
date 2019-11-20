<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Appointment
 *
 * @property int $id
 * @property string $description
 * @property int $course_id
 * @property int $teacher_id
 * @property int $student_id
 * @property string $scheduled_date
 * @property string $scheduled_time
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereScheduledDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereScheduledTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Appointment extends Model
{
    //
}
