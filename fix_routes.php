<?php
$f = __DIR__ . '/routes/web.php';
$c = file_get_contents($f);
if ($c === false) { fwrite(STDERR, "failed to read routes/web.php\n"); exit(1); }

/* 1) Voyagerのuse重複を掃除 */
$c = preg_replace('/^use\s+TCG\\\\Voyager\\\\(?:Facades\\\\)?Voyager;\s*$/m', '', $c);

/* 2) Route facade の直後に Facade を1行だけ挿入（なければ挿入） */
if (!preg_match('/^use\s+TCG\\\\Voyager\\\\Facades\\\\Voyager;/m', $c)) {
    $c = preg_replace(
        '/^use\s+Illuminate\\\\Support\\\\Facades\\\\Route;\s*$/m',
        "use Illuminate\\Support\\Facades\\Route;\nuse TCG\\Voyager\\Facades\\Voyager;",
        $c,
        1
    );
}

/* 3) 既存の admin→Voyager ブロックを全削除 */
$c = preg_replace(
    "~Route::prefix\\(\\s*'admin'\\s*\\)\\s*->group\\(function\\s*\\(\\)\\s*\\{.*?Voyager::routes\\(\\);\\s*\\}\\);\\s*~s",
    "",
    $c
);

/* 4) use 群の直後（最初の空行の直前）に正しい admin ブロックを挿入 */
if (preg_match('/^(<\?php\s.*?(?:\r?\n))(?:\s*use[^\n]*\n)*((?:\s*use[^\n]*\n)+)/s', $c, $m)) {
    // 探し方がややこしいので、Route facade行の直後に確実に入れる
    $c = preg_replace(
        '/(use\s+TCG\\\\Voyager\\\\Facades\\\\Voyager;\s*)\R/',
        "$0\nRoute::prefix('admin')->group(function () {\n    Voyager::routes();\n});\n\n",
        $c,
        1
    );
} else {
    // 念のため先頭に入れる
    $c = preg_replace(
        '/<\?php\s*/',
        "<?php\n\nRoute::prefix('admin')->group(function () {\n    Voyager::routes();\n});\n\n",
        $c,
        1
    );
}

/* 5) /{project} が /admin を奪わないよう where 付与（未付与時のみ） */
$c = preg_replace_callback(
    "/(Route::get\\('\\/\\{project\\}',[^;]*?\\))(?!->where\\('project','\\^\\(\\?!admin\\$\\)\\.\\*'\\))/",
    function ($m) {
        return $m[1] . "->where('project','^(?!admin$).*')";
    },
    $c
);

file_put_contents($f, $c);
echo "routes/web.php fixed\n";
