<?php

namespace Database\Seeds;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Seeder;

class IdeasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Idea::create([
                'user_id' => $user->id,
                'idea' => 'This is idea ' . $user->id,
                'likes' => 0,
            ]);
        }
    }
}
