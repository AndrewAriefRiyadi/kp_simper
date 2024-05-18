<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(["name"=> "create pengajuan"]);
        Permission::create(["name"=> "read pengajuan"]);
        Permission::create(["name"=> "update pengajuan"]);
        Permission::create(["name"=> "delete pengajuan"]);

        Permission::create(["name"=> "create ujian"]);
        Permission::create(["name"=> "read ujian"]);
        Permission::create(["name"=> "update ujian"]);
        Permission::create(["name"=> "delete ujian"]);
        
        Permission::create(["name"=> "create soal"]);
        Permission::create(["name"=> "read soal"]);
        Permission::create(["name"=> "update soal"]);
        Permission::create(["name"=> "delete soal"]);

        Permission::create(["name"=> "create pembayaran"]);
        Permission::create(["name"=> "read pembayaran"]);
        Permission::create(["name"=> "update pembayaran"]);
        Permission::create(["name"=> "delete pembayaran"]);

        Permission::create(["name"=> "change to reject"]);
        Permission::create(["name"=> "change to revise"]);
        Permission::create(["name"=> "change to approve"]);




        $vp = Role::create(["name"=> "vp"]);
        $vp->givePermissionTo('create pengajuan');
        $vp->givePermissionTo('read pengajuan');
        $vp->givePermissionTo('update pengajuan');
        $vp->givePermissionTo('delete pengajuan');

        $vp->givePermissionTo('create ujian');
        $vp->givePermissionTo('read ujian');
        $vp->givePermissionTo('update ujian');
        $vp->givePermissionTo('delete ujian');

        $vp->givePermissionTo('create soal');
        $vp->givePermissionTo('read soal');
        $vp->givePermissionTo('update soal');
        $vp->givePermissionTo('delete soal');

        $vp->givePermissionTo('create pembayaran');
        $vp->givePermissionTo('read pembayaran');
        $vp->givePermissionTo('update pembayaran');
        $vp->givePermissionTo('delete pembayaran');

        $vp->givePermissionTo('change to reject');
        $vp->givePermissionTo('change to approve');

        $avp = Role::create(["name"=> "avp"]);
        $avp->givePermissionTo('create pengajuan');
        $avp->givePermissionTo('read pengajuan');
        $avp->givePermissionTo('update pengajuan');
        $avp->givePermissionTo('delete pengajuan');

        $avp->givePermissionTo('create ujian');
        $avp->givePermissionTo('read ujian');
        $avp->givePermissionTo('update ujian');
        $avp->givePermissionTo('delete ujian');

        $avp->givePermissionTo('create soal');
        $avp->givePermissionTo('read soal');
        $avp->givePermissionTo('update soal');
        $avp->givePermissionTo('delete soal');

        $avp->givePermissionTo('create pembayaran');
        $avp->givePermissionTo('read pembayaran');
        $avp->givePermissionTo('update pembayaran');
        $avp->givePermissionTo('delete pembayaran');

        $avp->givePermissionTo('change to reject');
        $avp->givePermissionTo('change to approve');
        $avp->givePermissionTo('change to revise');

        $user = Role::create(["name"=> "user"]);
        $user->givePermissionTo('create pengajuan');
        $user->givePermissionTo('read pengajuan');
        $user->givePermissionTo('update pengajuan');

        $user->givePermissionTo('read ujian');

        $user->givePermissionTo('read soal');

        $user->givePermissionTo('create pembayaran');
        $user->givePermissionTo('read pembayaran');
    }
}
