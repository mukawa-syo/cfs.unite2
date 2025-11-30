<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

$affected = DB::table('roles')->whereNull('slug')->orWhere('slug','')->update(['slug'=>'admin']);
echo "slug_fixed_rows={$affected}\n";
