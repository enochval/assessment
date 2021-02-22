<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsletterSubscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['email'];

    public function isSubscribed($email)
    {
        return $this->where('email', $email)->exists();
    }

    public function subscribe($email): Model
    {
        return $this->firstOrCreate(['email' => $email]);
    }

    public function unsubscribe($email): bool
    {
        $sub = $this->where('email', $email)->first();

        if ($sub) {
            return $sub->delete();
        }

        return false;
    }
}
