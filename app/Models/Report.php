<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'approval_status', 'report_status', 'user_id', 'thumbnail', 'slug', 'category'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($report) {
            $report->slug = Str::slug($report->title);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
