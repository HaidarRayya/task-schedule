<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'user_id',
    ];
    protected $guarded = [
        'status',
    ];

    protected $attributes = [
        'status' => TaskStatus::PINDING->value,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::create($value)->format('Y-m-d');
    }
    public function getDueDateAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d');
    }
    /**
     *   get all tasks of worked by employee_id
     * @param  Builder $query  
     * @return Builder query  
     */
    public function scopeMyTask(Builder $query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    /**
     *   search  a tasks by status
     * @param  Builder $query  
     * @param  string $status  
     * @return Builder $query  
     */

    public function scopeByStatus(Builder $query, $status)
    {
        if ($status)
            return $query->where('status', '=', $status);
        else
            return $query;
    }
    /**
     *   search  a tasks by title
     * @param  Builder $query  
     * @param  string $title  
     * @return Builder $query  
     */
    public function scopeByTitle(Builder $query, $title)
    {
        if ($title)
            return $query->where('title', 'like', "%$title%");
        else
            return $query;
    }
    /**
     *   search  a tasks by due_date
     * @param  Builder $query  
     * @param  string $due_date  
     * @return Builder $query  
     */
    public function scopeByDueDate(Builder $query, $due_date)
    {
        if ($due_date)
            return $query->where('due_date', '=', $due_date);
        else
            return $query;
    }
    /**
     *   sort  a tasks 
     * @param  Builder $query  
     * @param  string $sort  
     * @return Builder $query  
     */

    public function scopeSortDueDate(Builder $query, $sort)
    {
        if ($sort)
            return $query->orderBy('due_date', $sort);
        else
            return $query->orderByDesc('due_date');
    }
}
