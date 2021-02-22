<?php

namespace App\Console\Commands;

use App\Jobs\SendNewsletterCampaign;
use App\Models\NewsletterSubscription;
use Illuminate\Console\Command;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule newsletters to subscribers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        NewsletterSubscription::chunk(100, function ($subs) {
            $subs->each(function ($sub) {
                SendNewsletterCampaign::dispatch($sub->email);
            });
        });
    }
}
