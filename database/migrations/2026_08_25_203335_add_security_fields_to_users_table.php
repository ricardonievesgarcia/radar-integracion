<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('estado', 20)
                ->default('ACTIVO')
                ->index();

            $table->timestamp('ultimo_login_at')
                ->nullable();

            $table->string('ultimo_login_ip', 45)
                ->nullable();

            $table->timestamp('password_changed_at')
                ->nullable();

            $table->boolean('must_change_password')
                ->default(false);

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['estado']);

            $table->dropColumn([
                'estado',
                'ultimo_login_at',
                'ultimo_login_ip',
                'password_changed_at',
                'must_change_password',
                'deleted_at',
            ]);
        });
    }
};
