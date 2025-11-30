<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$u = User::where('email','uknight.hc@gmail.com')->first();
auth()->login($u);
$a = auth()->user();
echo "class=".get_class($a)."\n";
echo "role_rel=".(optional($a->role)->name ?? 'null')."\n";
echo "has(browse_admin)=".((method_exists($a,'hasPermission') && $a->hasPermission('browse_admin'))?'YES':'NO')."\n";
