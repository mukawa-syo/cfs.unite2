<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\Permission;

$email = 'uknight.hc@gmail.com';

/* 1) user を admin(role_id=1) に固定 */
$u = User::where('email',$email)->first();
if(!$u){ echo "NO USER\n"; exit(1); }
$u->role_id = 1;
$u->save();

/* 2) adminロール と browse_admin権限 を保証し、pivot(permission_role) を作成(冪等) */
$role = Role::firstOrCreate(['id'=>1], ['name'=>'admin','slug'=>'admin']);
$perm = Permission::firstOrCreate(['key'=>'browse_admin'], ['table_name'=>null]);
if(!DB::table('permission_role')->where(['permission_id'=>$perm->id,'role_id'=>1])->exists()){
  DB::table('permission_role')->insert(['permission_id'=>$perm->id,'role_id'=>1]);
  echo "linked role 1 -> perm {$perm->id}\n";
}

/* 3) 判定（実ユーザーで） */
auth()->login($u);
$a = auth()->user();
$roleName = optional($a->role)->name ?? 'null';
$keys = optional($a->role)->permissions ? $a->role->permissions->pluck('key')->toArray() : [];
echo "role={$roleName}\n";
echo "perms=".implode(',',$keys)."\n";
echo "has(browse_admin)=".((method_exists($a,'hasPermission') && $a->hasPermission('browse_admin'))?'YES':'NO')."\n";
