<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->makeRecords();
        $this->makeRelations();
    }


    /**
     * Make permission records
     */
    public function makeRecords()
    {
        DB::table('permissions')->insert([

            //Applicant
            [
                'name' => 'view-applicants',
            ],
            [
                'name' => 'view-applicant',
            ],
            [
                'name' => 'create-applicant',
            ],
            [
                'name' => 'edit-applicant',
            ],
            [
                'name' => 'delete-applicant',
            ],

            //User
            [
                'name' => 'view-users',
            ],
            [
                'name' => 'view-user',
            ],
            [
                'name' => 'create-user',
            ],
            [
                'name' => 'edit-user',
            ],
            [
                'name' => 'activate-user',
            ],
            [
                'name' => 'delete-user',
            ],

            //Role
            [
                'name' => 'view-roles',
            ],
            [
                'name' => 'view-role',
            ],
            [
                'name' => 'create-role',
            ],
            [
                'name' => 'edit-role',
            ],
            [
                'name' => 'delete-role',
            ],

            //Permission
            [
                'name' => 'view-permissions',
            ],
            [
                'name' => 'view-permission',
            ],
            [
                'name' => 'create-permission',
            ],
            [
                'name' => 'edit-permission',
            ],
            [
                'name' => 'delete-permission',
            ],

            //Demand
            [
                'name' => 'view-demands',
            ],
            [
                'name' => 'view-demand',
            ],
            [
                'name' => 'create-demand',
            ],
            [
                'name' => 'edit-demand',
            ],
            [
                'name' => 'delete-demand',
            ],

            //Developer Document
            [
                'name' => 'view-dashboard',
            ],
            [
                'name' => 'view-user-management',
            ],

            //Country
            [
                'name' => 'edit-country',
            ],
            [
                'name' => 'delete-country',
            ],
        ]);
        return $this;
    }

    /**
     * Make relations between roles and permissions
     */
    public function makeRelations()
    {
        Role::whereName('admin')
            ->first()
            ->attachPermissions(
                Permission::get()
            );

        Role::whereName('developer')
            ->first()
            ->attachPermissions(
                Permission::get()
            );
    }
}
