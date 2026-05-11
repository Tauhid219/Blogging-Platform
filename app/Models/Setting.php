<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'autoload',
    ];

    protected function casts(): array
    {
        return [
            'autoload' => 'boolean',
            'value' => 'array',
        ];
    }
}
