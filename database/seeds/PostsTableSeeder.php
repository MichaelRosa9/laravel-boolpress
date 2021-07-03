<?php

use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            $new_post = new Post();
            $new_post->title = "Post title" . ($i + 1);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->content = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt fugit, officia ipsa magni culpa quidem iste quasi eos dignissimos nostrum. Eos quo veritatis voluptatem nihil, assumenda saepe cumque delectus ex.';
            $new_post->save();
        }
    }
}
