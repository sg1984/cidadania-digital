<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjectsTagsToInsert = [
            1 => [1,2],
            2 => [2,3],
            3 => [2,4],
            4 => [2,5],
            5 => [2,6,7,8],
            6 => [2,9,10],
            7 => [2,11,12,13,14],
            8 => [2,15,16],
            9 => [2,17],
            10 => [2,18,19,20],
            11 => [2,21,22,23],
            12 => [2,24,25],
            13 => [2,25,26],
            14 => [2,27,28],
            15 => [2,29,30,31],
            16 => [2,32,33,34],
            17 => [2,35,36,37],
        ];

        foreach ($subjectsTagsToInsert as $subjectId => $tags){
            foreach ($tags as $tag) {
                DB::table('subject_tag')->insert([
                        'subject_id' => $subjectId,
                        'tag_id' => $tag,
                        'created_at' => new \DateTime(),
                        'updated_at' => new \DateTime(),
                    ]
                );
            }
        }
    }
}
