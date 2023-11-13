<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Passport\HasApiTokens;

class User extends Model
{
  
    protected $table = 'user';

    public function Bagian(): BelongsTo
    {
        return $this->belongsTo(Bagian::class, 'bagian','id');
    }
}
