<?php
$f = __DIR__.'/app/Models/User.php';
$c = file_get_contents($f);
if ($c === false) { fwrite(STDERR,"read fail\n"); exit(1); }

/* 1) DBファサードの use を追加（無ければ） */
if (!preg_match('/^use\s+Illuminate\\\\Support\\\\Facades\\\\DB;/m', $c)) {
  $c = preg_replace('/^(namespace\s+App\\\\Models;.*\R)/m', "$1use Illuminate\\Support\\Facades\\DB;\n", $c, 1);
}

/* 2) hasPermission メソッドを置換（存在しなければ追加） */
$new = <<<'CODE'

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

if (preg_match('/public\s+function\s+hasPermission\s*\([^)]*\)\s*\{.*?\}\s*/s', $c)) {
  $c = preg_replace('/public\s+function\s+hasPermission\s*\([^)]*\)\s*\{.*?\}\s*/s', $new, $c, 1);
} else {
  $c = preg_replace('/}\s*$/', $new."}\n", $c, 1);
}

file_put_contents($f, $c);
echo "User.php hasPermission overridden\n";
