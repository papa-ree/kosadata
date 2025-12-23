<?php

namespace Nawasara\Kosadata\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Nawasara\Wago\Services\WagoService;

class ActiveWhatsapp implements ValidationRule
{
    public function __construct(
        protected bool $enabled = true
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->enabled) {
            return;
        }

        $phone = preg_replace('/\D/', '', $value);

        if (str_starts_with($phone, '08')) {
            $phone = '62' . substr($phone, 1);
        } elseif (str_starts_with($phone, '8')) {
            $phone = '62' . $phone;
        }

        $response = (new WagoService())->userCheck($phone);

        if (!$response->successful() || !data_get($response, 'results.is_on_whatsapp')) {
            $fail('Nomor WhatsApp tidak aktif atau tidak terdaftar. Mohon periksa kembali');
        }
    }
}
