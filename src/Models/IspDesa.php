<?php

namespace Nawasara\Kosadata\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class IspDesa extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    protected function contactName(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value
            ? Str::of($value)->title()
            : null,

            set: fn($value) => Str::of($value)->trim()->squish()->lower()
        );
    }

    protected function contactPhone(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value
            ? Crypt::decryptString($value)
            : null,

            set: function (?string $value) {
                return [
                    'contact_phone' => $value
                        ? Crypt::encryptString($value)
                        : null,

                    'contact_phone_hash' => $value
                        ? hash('sha256', $value)
                        : null,
                ];
            }
        );
    }

    protected function userName(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value
            ? Str::of($value)->title()
            : null,

            set: fn($value) => Str::of($value)->trim()->squish()->lower()
        );
    }

    protected function userPhone(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value
            ? Crypt::decryptString($value)
            : null,

            set: function (?string $value) {
                return [
                    'user_phone' => $value
                        ? Crypt::encryptString($value)
                        : null,

                    'user_phone_hash' => $value
                        ? hash('sha256', $value)
                        : null,
                ];
            }
        );
    }

    protected function userJob(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value
            ? Str::of($value)->title()
            : null,

            set: fn($value) => Str::of($value)->trim()->squish()->lower()
        );
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(InternetProvider::class, 'internet_provider_id');
    }

    protected $casts = [
        'created_at' => 'datetime:d M Y',
        'updated_at' => 'datetime:d M Y',
    ];

    public function scopeSearch(Builder $query, ?string $key): Builder
    {
        if (blank($key)) {
            return $query;
        }

        $keyword = trim($key);

        return $query->where(function (Builder $q) use ($keyword) {

            // Field lokal isp_desas
            $q->where('contact_name', 'like', "%{$keyword}%")
                ->orWhere('user_name', 'like', "%{$keyword}%")
                ->orWhere('user_job', 'like', "%{$keyword}%");

            // Nomor telepon (hash)
            if (preg_match('/^\+?\d+$/', $keyword)) {
                $q->orWhere(
                    'contact_phone_hash',
                    hash('sha256', $keyword)
                );
            }

            // Provider (pengganti field name)
            $q->orWhereHas('provider', function (Builder $q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            });

            // Kecamatan
            $q->orWhereHas('kecamatan', function (Builder $q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            });

            // Desa
            $q->orWhereHas('desa', function (Builder $q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            });
        });
    }

    public function scopeOrderByKecamatanName(Builder $query, string $direction = 'asc'): Builder
    {
        return $query
            ->leftJoin('kecamatans', 'kecamatans.id', '=', 'isp_desas.kecamatan_id')
            ->orderBy('kecamatans.name', $direction)
            ->select('isp_desas.*');
    }
}