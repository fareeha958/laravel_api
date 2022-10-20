<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Like;
use App\Models\likes;
use App\Models\Post;
use App\Models\replay;
use App\Models\subscription;
use App\Models\thread;

class DatabaseSeeder extends Seeder
{
  /**
    * Seed the application's database.
    *
    * @return void
    */
  public function run()
  {
    Comment::factory()
      ->times(3)
      ->create();

      Post::factory()
      ->times(3)
      ->create();

      Like::factory()
      ->times(3)
      ->create();

      Subscription::factory()
      ->times(3)
      ->create();

      Replay::factory()
      ->times(3)
      ->create();

      Thread::factory()
      ->times(3)
      ->create();

 }
}
