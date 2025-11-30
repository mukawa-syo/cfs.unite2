<?php
$f = __DIR__.'/app/Models/User.php';
$c = file_get_contents($f);
if ($c === false) { fwrite(STDERR,"read fail\n"); exit(1); }

function removeHasPermBlocks($src) {
    $out = $src;
    $removed = 0;
    $pos = 0;
    while (true) {
        $i = stripos($out, 'function haspermission', $pos);
        if ($i === false) break;

        // "{" を探す
        $brace = strpos($out, '{', $i);
        if ($brace === false) break;

        // ブレースカウントでブロック終端を検出
        $level = 0;
        $end = $brace;
        $len = strlen($out);
        for ($j = $brace; $j < $len; $j++) {
            $ch = $out[$j];
            if ($ch === '{') $level++;
            if ($ch === '}') $level--;
            if ($level === 0) { $end = $j + 1; break; }
        }
        // ブロック削除
        $out = substr($out, 0, $i) . substr($out, $end);
        $removed++;
        // 次探索は、今削除した位置から
        $pos = $i;
    }
    return [$out, $removed];
}

// 1) 既存の hasPermission ブロックを全て削除
list($c, $removed) = removeHasPermBlocks($c);

// 2) DB facade を use に追加（無ければ）
if (!preg_match('/^use\s+Illuminate\\\\Support\\\\Facades\\\\DB;/m', $c)) {
    $c = preg_replace('/^(namespace\s+App\\\\Models;.*\R)/m', "$1use Illuminate\\Support\\Facades\\DB;\n", $c, 1);
}

// 3) 末尾の "}" （クラス終端）の直前に正しい実装を1本挿入
$method = <<<'CODE'

    /**
     * Voyager permission override (robust):
     * - role_id==1 (admin) は常に許可
     * - それ以外は permission_role をDB直叩きで確認
     */
    public function hasPermission($name, $arguments = null)
    {
        if ((int)($this->role_id ?? 0) === 1) {
            return true;
        }
        try {
            return DB::table('permission_role')
                ->join('permissions','permissions.id','=','permission_role.permission_id')
                ->where('permission_role.role_id', (int)($this->role_id ?? 0))
                ->where('permissions.key', $name)
                ->exists();
        } catch (\Throwable $e) {
            return false;
        }
    }

CODE;

$c = preg_replace('/}\s*$/', $method . "}\n", $c, 1);

file_put_contents($f, $c);
echo "cleanup_done removed={$removed}\n";
