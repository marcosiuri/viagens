<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passagem extends Model
{
    protected $table = 'passagens';

    protected $fillable = [
        'destino_id',
        'user_id',
    ];

    public function destino()
    {
        return $this->belongsTo(Destino::class, 'destino_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
