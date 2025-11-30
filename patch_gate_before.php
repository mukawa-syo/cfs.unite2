<?php
$f = __DIR__.'/app/Providers/AppServiceProvider.php';
$c = file_get_contents($f);
if ($c === false) { fwrite(STDERR,"read fail\n"); exit(1); }

if (strpos($c, 'use Illuminate\\Support\\Facades\\Gate;') === false) {
  $c = preg_replace('/^namespace\s+App\\\Providers;.*\R/m', "$0use Illuminate\\Support\\Facades\\Gate;\n", $c, 1);
}

if (!preg_match('/Gate::before\(/', $c)) {
  $c = preg_replace('/public function boot\(\)\s*\{\s*/',
    "public function boot()\n    {\n        Gate::before(function (\$user, \$ability) {\n            return ((int)(\$user->role_id ?? 0) === 1) ? true : null;\n        });\n        ",
    $c, 1);
}

file_put_contents($f, $c);
echo "AppServiceProvider patched\n";
