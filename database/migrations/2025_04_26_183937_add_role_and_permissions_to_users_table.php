<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('email');
            $table->json('permissions')->nullable()->after('role');
            $table->timestamp('last_login_at')->nullable()->after('permissions');
            $table->string('last_login_ip')->nullable()->after('last_login_at');
            $table->boolean('is_active')->default(true)->after('last_login_ip');
            $table->timestamp('banned_until')->nullable()->after('is_active');
            $table->text('ban_reason')->nullable()->after('banned_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'permissions',
                'last_login_at',
                'last_login_ip',
                'is_active',
                'banned_until',
                'ban_reason'
            ]);
        });
    }
};
