<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $comment= new Comment();

            $comment->post_id = 1;
            $comment->comment_text = 'This is my first comment';
            $comment->author_name = 'John Doe';
            $comment->save();
        }



        for ($i = 0; $i < 10; $i++) {
            $comment= new Comment();

            $comment->post_id = 2;
            $comment->comment_text = 'This is my first comment';
            $comment->author_name = 'John Doe';
            $comment->save();
        }
      
    }
}
