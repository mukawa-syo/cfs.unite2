<?php
$f = __DIR__.'/app/Models/User.php';
$c = file_get_contents($f);
if (strpos($c, 'function voyagerRole(') === false) {
    $method = <<<'CODE'

    /** VoyagerのRoleリレーション（属性名 "role" との衝突回避用） */
    public function voyagerRole(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\TCG\Voyager\Models\Role::class, 'role_id');
    }

CODE;
    $c = preg_replace('/}\s*$/', $method . "}\n", $c, 1);
    file_put_contents($f, $c);
    echo "voyagerRole added\n";
} else {
    echo "voyagerRole exists\n";
}
