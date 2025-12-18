<?php

namespace Nawasara\Kosadata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function desas(): HasMany
    {
        return $this->hasMany(Desa::class);
    }

    public function ispDesas(): HasMany
    {
        return $this->hasMany(IspDesa::class);
    }
}