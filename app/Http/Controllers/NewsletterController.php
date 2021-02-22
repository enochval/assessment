<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\NewsletterSubscription;

class NewsletterController extends Controller
{
    /**
     * @var NewsletterSubscription
     */
    private NewsletterSubscription $subscription;

    public function __construct(NewsletterSubscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function subscribe(SubscriptionRequest $request)
    {
        if (!$this->subscription->isSubscribed($request->email)) {

            $this->subscription->subscribe($request->email);

            return response()->json([
                'success' => true,
                'message' => 'Thanks For Subscribing'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Sorry! You have already subscribed'
        ], 400);
    }

    public function unsubscribe(SubscriptionRequest $request)
    {
        if ($this->subscription->isSubscribed($request->email)) {

            $this->subscription->unsubscribe($request->email);

            return response()->json([
                'success' => true,
                'message' => 'Thanks For Unsubscribing'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Sorry! You have not subscribed'
        ], 400);
    }
}
