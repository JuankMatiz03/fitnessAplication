<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class CaloriesLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_document',
        'food',
        'amount',
        'average_calories',
        'time_hour',
        'off_line',
    ];


    public function person()
    {
        return $this->belongsTo(User::class, 'number_document', 'number_document');
    }

    protected $table = 'CaloriesLog';
    protected $primaryKey = 'number_document';
}
