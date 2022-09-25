<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create method taking long time
        // Comment::factory(3000)->create(); 

        // by using chunk method it is 20 times faster
        $comments = Comment::factory(10000)->make();
        $comments->chunk(800)->each(function($chunk) {
            Comment::insert($chunk->toArray());
        });
    }
}
