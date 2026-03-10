<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'subject',
        'description',
        'github_link',
        'file_path',
        'start_date',
        'end_date',
        'hours_spent',
        'tz_status',
        'report_status',
        'diary_status',
        'share_token' // Добавил share_token в fillable
    ];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь со скриншотами
    public function screenshots()
    {
        return $this->hasMany(Screenshot::class);
    }

    // Boot метод для генерации токена при создании
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($project) {
            $project->share_token = Str::random(20);
        });
    }

    // Аксессор для получения полной ссылки
public function getShareUrlAttribute()
{
    if (!$this->share_token) {
        $this->share_token = \Illuminate\Support\Str::random(20);
        $this->save();
    }
    return route('projects.shared', $this->share_token);
}
}