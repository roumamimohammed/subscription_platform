<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\PostDelivery;
use Illuminate\Support\Facades\Mail;

class SendNewPostsEmails extends Command
{
    protected $signature = 'send:emails';
    protected $description = 'Send new posts to all subscribers';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $subscriptions = Subscription::all();

        foreach ($subscriptions as $subscription) {
            $website = $subscription->website;

            $newPosts = Post::where('website_id', $website->id)
                ->whereDoesntHave('postDeliveries', function ($query) use ($subscription) {
                    $query->where('subscription_id', $subscription->id);
                })
                ->get();

            foreach ($newPosts as $post) {
                Mail::to($subscription->email)->queue(new \App\Mail\SendPostEmail($post, $subscription));

                PostDelivery::create([
                    'post_id' => $post->id,
                    'subscription_id' => $subscription->id,
                ]);
            }
        }
    }
}
