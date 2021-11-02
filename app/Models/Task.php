<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    public const STATUS_TO_DO = 1;
    public const STATUS_IN_PROGRESS = 2;
    public const STATUS_DONE = 3;

    public const LEVEL_LOW = 1;
    public const LEVEL_MEDIUM = 2;
    public const LEVEL_URGENT = 3;

    protected $fillable = [
        'name', 'status', 'level'
    ];
}
