<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // TODO: 後で orders テーブルの外部キー削除を正しく実装する。
        // いまはエラー回避のため何もしません。
    }

    public function down(): void
    {
        // no-op
    }
};
