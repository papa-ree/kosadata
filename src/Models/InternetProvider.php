<?php

namespace Nawasara\Kosadata\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class InternetProvider extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d M Y',
        'updated_at' => 'datetime:d M Y',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value
            ? Str::of($value)->title()
            : null,

            set: fn($value) => Str::of($value)->trim()->squish()->lower()
        );
    }
    public function ispDesas(): HasMany
    {
        return $this->hasMany(IspDesa::class);
    }

}