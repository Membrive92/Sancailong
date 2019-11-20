<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
/**
 * App\WorkDay
 *
 * @property int $id
 * @property int $day
 * @property int $active
 * @property string $morning_start
 * @property string $morning_end
 * @property string $afternoon_start
 * @property string $afternoon_end
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay whereAfternoonEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay whereAfternoonStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay whereMorningEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay whereMorningStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WorkDay whereUserId($value)
 * @mixin \Eloquent
 */
class WorkDay extends Model
{
    protected $fillable = [
        'day',
        'active',

        'morning_start',
        'morning_end',
        'afternoon_start',
        'afternoon_end',
        'user_id'
    ];
}