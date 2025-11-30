<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\Permission;
use App\Models\User;

$email = 'uknight.hc@gmail.com';
if (!Schema::hasTable('users') || !Schema::hasTable('roles') || !Schema::hasTable('permissions')) {
  echo "ERROR: required tables missing\n"; exit(1);
}

$u = User::where('email',$email)->first();
if(!$u){ echo "NO USER\n"; exit(1); }

echo "USER id={$u->id} role_id=".($u->role_id ?? 'NULL')."\n";
echo "users.columns=".implode(',', Schema::getColumnListing('users'))."\n";

# 役割の存在を確認 or 生成
$role = Role::firstOrCreate(['id'=>1], ['name'=>'admin','slug'=>'admin']);
echo "ROLE id=1 name={$role->name} slug={$role->slug}\n";

# ユーザーの role_id を 1 に補正（必要なら）
if ((int)($u->role_id ?? 0) !== 1) {
  DB::table('users')->where('id',$u->id)->update(['role_id'=>1]);
  echo "FIXED: users.role_id=1\n";
}

# browse_admin 権限を作成→ role(1) に紐付け
$perm = Permission::firstOrCreate(['key'=>'browse_admin'], ['table_name'=>null]);
if(!DB::table('permission_role')->where(['permission_id'=>$perm->id,'role_id'=>1])->exists()){
  DB::table('permission_role')->insert(['permission_id'=>$perm->id,'role_id'=>1]);
  echo "LINKED: role_id=1 -> permission_id={$perm->id}\n";
}

# 直接 user にも付与できる場合は付与（permission_user があれば）
if (Schema::hasTable('permission_user')) {
  if(!DB::table('permission_user')->where(['user_id'=>$u->id,'permission_id'=>$perm->id])->exists()){
    DB::table('permission_user')->insert(['user_id'=>$u->id,'permission_id'=>$perm->id]);
    echo "LINKED: user_id={$u->id} -> permission_id={$perm->id}\n";
  }
} else {
  echo "NOTE: table permission_user not found (skip direct user permission)\n";
}

# 再読込して最終判定
$u = User::find($u->id);
auth()->login($u);
$a = auth()->user();
$roleName = optional($a->role)->name ?? 'null';
echo "AFTER: user.role_id=".($a->role_id ?? 'NULL')." role={$roleName}\n";
$keys = optional($a->role)->permissions ? $a->role->permissions->pluck('key')->implode(',') : '';
echo "AFTER: role.perms={$keys}\n";
echo "AFTER: has(browse_admin)=".((method_exists($a,'hasPermission') && $a->hasPermission('browse_admin'))?'YES':'NO')."\n";
