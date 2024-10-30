<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPostEmail;

class SendPostNotification
{
    /**
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $post = $event->post;
        $website = $post->website;

        $subscriptions = Subscription::where('website_id', $website->id)->get();

        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->email)->queue(new SendPostEmail($post, $subscription));
        }
    }
}
