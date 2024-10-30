<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPostEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $post;
    public $subscription;

    public function __construct(Post $post, Subscription $subscription)
    {
        $this->post = $post;
        $this->subscription = $subscription;
    }

    public function build()
    {
        return $this->subject("New post from {$this->post->website->name}")
                    ->markdown('emails.new_post', [
                        'post' => $this->post,
                        'subscription' => $this->subscription,
                    ]);
    }
}
