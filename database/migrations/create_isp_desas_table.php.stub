<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('isp_desas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('internet_provider_id');
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('contact_phone_hash');
            $table->string('user_name');
            $table->string('user_job')->nullable();
            $table->uuid('kecamatan_id');
            $table->uuid('desa_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('isp_desas');
    }
};
