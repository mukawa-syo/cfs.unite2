<?php
$f = __DIR__ . '/app/Http/Middleware/TrustProxies.php';
$c = file_get_contents($f);
$orig = $c;

/* Request の use が無ければ追加 */
if (strpos($c, 'use Illuminate\\Http\\Request;') === false) {
    $c = preg_replace(
        '/^namespace\\s+App\\\\Http\\\\Middleware;\\s*$/m',
        "namespace App\\Http\\Middleware;\nuse Illuminate\\Http\\Request;",
        $c, 1
    );
}

/* $proxies を必ず '*' に */
if (preg_match('/protected\\s+\\$proxies\\s*;/', $c)) {
    $c = preg_replace('/protected\\s+\\$proxies\\s*;/', "protected \$proxies = '*';", $c, 1);
} elseif (preg_match('/protected\\s+\\$proxies\\s*=\\s*[^;]*;/', $c)) {
    $c = preg_replace('/protected\\s+\\$proxies\\s*=\\s*[^;]*;/', "protected \$proxies = '*';", $c, 1);
} else {
    $c = preg_replace('/class\\s+TrustProxies[^{]*\\{/', "$0\n    protected \$proxies = '*';", $c, 1);
}

/* $headers を AWS ELB 用に固定 */
if (preg_match('/protected\\s+\\$headers\\s*=.*;/', $c)) {
    $c = preg_replace('/protected\\s+\\$headers\\s*=.*;/', "protected \$headers = Request::HEADER_X_FORWARDED_AWS_ELB;", $c, 1);
} else {
    $c = preg_replace('/class\\s+TrustProxies[^{]*\\{/', "$0\n    protected \$headers = Request::HEADER_X_FORWARDED_AWS_ELB;", $c, 1);
}

/* 変更があれば保存 */
if ($c !== $orig) {
    file_put_contents($f, $c);
    echo "TrustProxies updated\n";
} else {
    echo "No change (already correct?)\n";
}
