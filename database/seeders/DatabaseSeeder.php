<?php

namespace Database\Seeders;

use App\Models\Atom;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //        User::truncate();
        DB::table('tasks')->insert(['name'=>'ear',]);
        DB::table('tasks')->insert(['name'=>'eye',]);
        DB::table('tasks')->insert(['name'=>'mouth',]);

        DB::table('users')->insert([
            'name'=>'hralamin',
            'email'=>'hralamin2020@gmail.com',
            'email_verified_at' => now(),
            'password'=>Hash::make('Qqqqqqqq1@')
        ]);

        // \App\Models\User::factory(10)->create();
//        \App\Models\Quiz::factory(10)->create()->each(function ($quiz) {
//            Question::factory(20)->create([
//                'user_id' => 1,
//                'quiz_id' => $quiz->id
//            ])->each(function ($question) {
//                $option = Option::factory(4)->create([
//                    'question_id' => $question->id
//                ])->each(function ($option) {
//                    $option->question->update(['answer' => $option->id]);
//                });
//            });
//        });
    }
}
