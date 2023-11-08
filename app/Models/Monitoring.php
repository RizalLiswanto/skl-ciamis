<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monitoring extends Model
{
    protected $table = 'monitoring';

    public function Titik(): BelongsTo
    {
        return $this->belongsTo(Titik::class, 'titik','id');
    }

    public function Petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_petugas','id');
    }
}
