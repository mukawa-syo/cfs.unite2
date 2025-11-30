<?php
$f = __DIR__.'/config/voyager.php';
$c = file_get_contents($f);
if ($c === false) { fwrite(STDERR,"read fail\n"); exit(1); }

$changed = false;

/* 1) models ブロックが無ければ新規作成して Role/Permission を定義 */
if (!preg_match("/'models'\\s*=>\\s*\\[/", $c)) {
  $c = preg_replace(
    "/return \\[/",
    "return [\n    'models' => [\n        'Role' => TCG\\\\Voyager\\\\Models\\\\Role::class,\n        'Permission' => TCG\\\\Voyager\\\\Models\\\\Permission::class,\n    ],",
    $c, 1, $cnt
  );
  if ($cnt) $changed = true;
} else {
  /* 2) models 配下に Role/Permission が無ければ追記 */
  if (!preg_match("/'Role'\\s*=>\\s*TCG\\\\\\\\Voyager\\\\\\\\Models\\\\\\\\Role::class/", $c)) {
    $c = preg_replace(
      "/'models'\\s*=>\\s*\\[/",
      "'models' => [\n        'Role' => TCG\\\\Voyager\\\\Models\\\\Role::class,",
      $c, 1, $cnt
    );
    if ($cnt) $changed = true;
  }
  if (!preg_match("/'Permission'\\s*=>\\s*TCG\\\\\\\\Voyager\\\\\\\\Models\\\\\\\\Permission::class/", $c)) {
    $c = preg_replace(
      "/('models'\\s*=>\\s*\\[[^\\]]*)\\]/s",
      "$1\n        'Permission' => TCG\\\\Voyager\\\\Models\\\\Permission::class,\n    ]",
      $c, 1, $cnt
    );
    if ($cnt) $changed = true;
  }
}

/* 3) user.namespace が App\Models\User か最終確認（無ければ差し込み）*/
if (!preg_match("/'user'\\s*=>\\s*\\[.*?'namespace'\\s*=>\\s*'App\\\\\\\\Models\\\\\\\\User'.*?\\]/s", $c)) {
  $c = preg_replace(
    "/'user'\\s*=>\\s*\\[/s",
    "'user' => [\n        'namespace' => 'App\\\\Models\\\\User',",
    $c, 1, $cnt
  );
  if ($cnt) $changed = true;
}

if ($changed) {
  file_put_contents($f, $c);
  echo "voyager.php patched\n";
} else {
  echo "voyager.php already OK\n";
}
