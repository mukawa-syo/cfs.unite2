<?php
$f = __DIR__.'/app/Models/User.php';
$c = file_get_contents($f);
if ($c === false) { fwrite(STDERR,"read fail\n"); exit(1); }

/* 既にアクセサが無ければ、クラス終端の直前に追加 */
if (!preg_match('/function\s+getRoleAttribute\s*\(/', $c)) {
    $method = <<<'CODE'

    /**
     * Fix: users表の "role" カラムが Voyager の role() リレーションと衝突するため、
     * プロパティアクセス時は常にリレーションを返す。
     */
    public function getRoleAttribute($value)
    {
        if ($this->relationLoaded('role')) {
            return $this->getRelation('role');
        }
        try {
            return $this->role()->first();
        } catch (\Throwable $e) {
            return null;
        }
    }

CODE;
    $c = preg_replace('/}\s*$/', $method . "}\n", $c, 1);
    file_put_contents($f, $c);
    echo "User.php accessor inserted\n";
} else {
    echo "User.php accessor already exists\n";
}
