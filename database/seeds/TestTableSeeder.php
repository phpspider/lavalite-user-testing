<?php

use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tests')->insert([
            
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/test/test',
                'name'        => 'Tests',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 1,
                'status'      => 1,
            ],

            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/tests',
                'name'        => 'Tests',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 1,
                'status'      => 1,
            ],

            [
                'parent_id'   => 3,
                'key'         => null,
                'url'         => 'tests',
                'name'        => 'Tests',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 1,
                'status'      => 1,
            ],

        ]);


        DB::table('permissions')->insert([
            [
                'slug'      => 'test.test.view',
                'name'      => 'View Test',
            ],
            [
                'slug'      => 'test.test.create',
                'name'      => 'Create Test',
            ],
            [
                'slug'      => 'test.test.edit',
                'name'      => 'Update Test',
            ],
            [
                'slug'      => 'test.test.delete',
                'name'      => 'Delete Test',
            ],
        ]);

        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
            [
                'key'      => 'test.test.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ],
            */
        ]);
    }
}
