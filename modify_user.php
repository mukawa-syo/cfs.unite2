<?php
$f = __DIR__.'/app/Models/User.php';
$c = file_get_contents($f);
if ($c === false) { fwrite(STDERR,"read fail\n"); exit(1); }

/* use TCG\Voyager\Traits\VoyagerUser; を namespace の後に挿入（未挿入時のみ） */
if (!preg_match('/^use\s+TCG\\\\Voyager\\\\Traits\\\\VoyagerUser;/m', $c)) {
  $c = preg_replace('/^(namespace\s+App\\\\Models;.*\R)/m',
      "$1use TCG\\Voyager\\Traits\\VoyagerUser;\n", $c, 1);
}

/* クラス先頭の { の直後に  use VoyagerUser; を挿入（未挿入時のみ） */
if (!preg_match('/\buse\s+VoyagerUser\b/', $c)) {
  $c = preg_replace('/(class\s+User\s+extends\s+[^{]+{)/',
      "$1\n    use VoyagerUser;\n", $c, 1);
}

file_put_contents($f, $c);
echo "User.php patched\n";
