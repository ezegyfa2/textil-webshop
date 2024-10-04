<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $preventsLazyLoading = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_name',
        'address',
        'postal_code',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
        ];
    }

    public function updateProfileByCheckout(Checkout $checkout): void
    {
        if (!$this->phone && $checkout->phone) {
            $this->phone = $checkout->phone;
        }
        if (!$this->company_name && $checkout->company_name) {
            $this->company_name = $checkout->company_name;
        }
        if (!$this->address && $checkout->address) {
            $this->address = $checkout->address;
        }
        if (!$this->postal_code && $checkout->postal_code) {
            $this->postal_code = $checkout->postal_code;
        }
        $this->save();
    }

    public function getName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
