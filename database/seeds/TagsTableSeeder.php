<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'name' => 'php',
                'description' => 'dgagtdhy adgthyag '
            ],
            [
                'name' => 'html',
                'description' => 'dd agdhgahdg ahdgha dgagtdhy adgthyag '
            ],
            [
                'name' => 'css',
                'description' => 'dd agggggggha dgagtdhy adgthyag '
            ],
            [
                'name' => 'python',
                'description' => 'dd agdhgahdg ahdgha dgagtdhy adgthyag '
            ],
            [
                'name' => 'c++',
                'description' => 'dd agdhgahdg ahdgha dgagtdhy adgthyag '
            ],
            [
                'name' => 'js',
                'description' => 'dd agdhgahdg ahdgha dgagtdhy adgthyag '
            ],
            [
                'name' => 'ruby',
                'description' => 'dd agdhgahdg ahdgha dgagtdhy adgthyag '
            ],
            [
                'name' => 'perl',
                'description' => 'dd agdhgahdg ahdgha dgagtdhy adgthyag '
            ],
            [
                'name' => 'c#',
                'description' => 'dd agdhgahdg ahdgha dgagtdhy adgthyag '
            ],
            [
                'name' => 'java',
                'description' => 'dd agdhgahdg ahdgha dgagtdhy adgthyag '
            ],
        ]);
    }
}
