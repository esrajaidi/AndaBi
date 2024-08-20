<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            'role-list',//1
           'role-create',//2
           'role-edit',//3
           'role-delete',//4

           'user-list',//5
           'user-create',//6
           'user-edit',//7
           'user-delete',//8
           'user-changestatus',//9

           'branche-list',//10
           'branche-create',//11
           'branche-edit',//12
           'branche-changestatus',//13

           'sms-messages',//14
           'send-sms-messages' ,//15
           'bulk-send-sms-messages', //16


         ];

         foreach ($permissions  as $index => $permission) {
              Permission::create(['id'=> $index+1  ,'name' => $permission]);


            }







}
}
