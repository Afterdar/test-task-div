<?php

declare(strict_types=1);

namespace App\Services\Application\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    public $fillable = [
        'status',
        'message',
        'comment',
    ];
}
