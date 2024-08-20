<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'esra',
            'email' => 'a.aljieidi@andalusbank.com',
            'password' => bcrypt('anda@2024'),

        ]);

        $role = Role::create(['id' => 1, 'name' => 'مدير نظام']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        //  //1
        $role2 = Role::create(['id' => 2, 'name' => 'عرض الرسائل المرسلة']);
        $permissions2 = Permission::whereIn('id', [14])->pluck('id', 'id')->all();
        $role2->syncPermissions($permissions2);
        //

        $role3 = Role::create(['id' => 3, 'name' => 'إرسال رسالة']);
        $permissions3 = Permission::whereIn('id', [15])->pluck('id', 'id')->all();
        $role3->syncPermissions($permissions3);

        $role4 = Role::create(['id' => 4, 'name' => 'تحميل ملف excel لارسال رسائل']);
        $permissions4 = Permission::whereIn('id', [16])->pluck('id', 'id')->all();
        $role4->syncPermissions($permissions4);


        $role5 = Role::create(['id' => 5, 'name' => 'عرض  قوائم الحظر المحلية']);
        $permissions5 = Permission::whereIn('id', [17])->pluck('id', 'id')->all();
        $role5->syncPermissions($permissions5);


        
        $role6 = Role::create(['id' => 6, 'name' => 'تحميل  قوائم الحظر المحلية']);
        $permissions6 = Permission::whereIn('id', [18])->pluck('id', 'id')->all();
        $role6->syncPermissions($permissions6);

                 
        $role7 = Role::create(['id' => 7, 'name' => 'اضافة لقوائم الحظر المحلية']);
        $permissions7 = Permission::whereIn('id', [19])->pluck('id', 'id')->all();
        $role7->syncPermissions($permissions7);

        $role8 = Role::create(['id' => 8, 'name' => 'تعديل لقوائم الحظر المحلية']);
        $permissions8 = Permission::whereIn('id', [20])->pluck('id', 'id')->all();
        $role8->syncPermissions($permissions8);

        $role9 = Role::create(['id' => 9, 'name' => 'تصدير لقوائم الحظر المحلية']);
        $permissions9 = Permission::whereIn('id', [21])->pluck('id', 'id')->all();
        $role9->syncPermissions($permissions9);

        $role10 = Role::create(['id' => 10, 'name' => 'طباعة قوائم الحظر المحلية']);
        $permissions10 = Permission::whereIn('id', [22])->pluck('id', 'id')->all();
        $role10->syncPermissions($permissions10);

        $role11 = Role::create(['id' => 11, 'name' => 'بحت بالبيان في  قوائم الحظر المحلية']);
        $permissions11 = Permission::whereIn('id', [23])->pluck('id', 'id')->all();
        $role11->syncPermissions($permissions11);

        $role12 = Role::create(['id' => 12, 'name' => 'بحت بـالرقم الاشاري وتاريخ الرسالة الواردة  في  قوائم الحظر المحلية']);
        $permissions12 = Permission::whereIn('id', [24])->pluck('id', 'id')->all();
        $role12->syncPermissions($permissions12);
    }
}
