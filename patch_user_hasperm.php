<?php
$f = __DIR__.'/app/Models/User.php';
$c = file_get_contents($f);
if ($c === false) { fwrite(STDERR,"read fail\n"); exit(1); }

if (!preg_match('/function\s+hasPermission\s*\(/', $c)) {
  $method = <<<'CODE'

    /**
     * Voyager permission override:
     * role_id==1 (admin) は常に許可。それ以外はロールのpermissionsを参照。
     */
    public function hasPermission($name, $arguments = null)
    {
        if ((int)($this->role_id ?? 0) === 1) {
            return true;
        }
        try {
            $role = $this->relationLoaded('role') ? $this->getRelation('role') : $this->role()->first();
            if ($role && method_exists($role, 'permissions')) {
                return $role->permissions()->where('key', $name)->exists();
            }
        } catch (\Throwable $e) {
            // fallthrough
        }
        return false;
    }

CODE;
  $c = preg_replace('/}\s*$/', $method . "}\n", $c, 1);
  file_put_contents($f, $c);
  echo "User.php hasPermission inserted\n";
} else {
  echo "User.php hasPermission already exists\n";
}
