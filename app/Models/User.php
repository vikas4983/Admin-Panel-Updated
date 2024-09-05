<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'name',
        'email',
        'password',
        'status'
    ];
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
    public function successStories()
    {
        return $this->hasMany(SuccessStory::class);
    }
    public function profileId()
    {
        return $this->hasMany(ProfileId::class);
    }
    public function spotelights()
    {
        return $this->hasMany(SpoteLight::class,'user_id');
    }
    public function razorpays()
    {
        return $this->hasMany(RazorPay::class,'user_id');
    }

    public function getPaidUsersAttribute()
    {
        $payments = Payment::with('user.spotelights', 'plan')
            ->orderBy('created_at', 'desc')
            ->get();

        $paidUsers = [];
        $userIds = []; // To keep track of processed user IDs

        foreach ($payments as $payment) {
            $paidPaymentDate = Carbon::parse($payment->expiry_date);
            $currentDate = Carbon::now('Asia/Kolkata');
            // Check if the payment is still valid
            if ($paidPaymentDate >= $currentDate) {
                // Check if the user has already been added
                if (!in_array($payment->user_id, $userIds)) {
                    $paidUsers[] = $payment; // Add the payment (with user)
                    $userIds[] = $payment->user_id; // Mark this user as processed
                }
            } else {
                // Update expired payments
                $payment->update([
                    'contact' => null,
                    'is_paid' => 0
                ]);
            }
        }

        return $paidUsers;
    }
}
