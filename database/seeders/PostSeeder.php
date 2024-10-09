<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post= new Post();
        
        $post->image = 'https://picsum.photos/200/300';
        $post->title = 'My First Post';
        $post->description = 'This is my first post';
        $post->save();


        $post2= new Post();

        $post2->image = 'https://picsum.photos/200/300';
        $post2->title = 'My First Post';
        $post2->description = 'This is my first post';
        $post2->save();
        
    }
}
