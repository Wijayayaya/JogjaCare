<?php

namespace App\Models;

use App\Models\Presenters\UserPresenter;
use App\Models\Traits\HasHashedMediaTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasFactory;
    use HasHashedMediaTrait;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;
    use UserPresenter;
    use HasApiTokens;

    protected $guarded = [
        'id',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'google_id',
        'avatar',
        'last_login',
        'last_ip',
        'login_count',
        'expert_system_access',        // Tambahan untuk sistem pakar
        'expert_system_expires_at',    // Tambahan untuk sistem pakar
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
            'date_of_birth' => 'datetime',
            'last_login' => 'datetime',
            'deleted_at' => 'datetime',
            'social_profiles' => 'array',
            'expert_system_access' => 'boolean',           // Cast untuk sistem pakar
            'expert_system_expires_at' => 'datetime',      // Cast untuk sistem pakar
        ];
    }

    /**
     * Boot the model.
     *
     * Register the model's event listeners.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // create a event to happen on creating
        static::creating(function ($table) {
            $table->created_by = Auth::id();
        });

        // create a event to happen on updating
        static::updating(function ($table) {
            $table->updated_by = Auth::id();
        });

        // create a event to happen on saving
        static::saving(function ($table) {
            $table->updated_by = Auth::id();
        });

        // create a event to happen on deleting
        static::deleting(function ($table) {
            $table->deleted_by = Auth::id();
            $table->save();
        });
    }

    /**
     * Retrieve the providers associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers()
    {
        return $this->hasMany('App\Models\UserProvider');
    }

    /**
     * Get the list of users related to the current User.
     */
    public function getRolesListAttribute()
    {
        return array_map('intval', $this->roles->pluck('id')->toArray());
    }

    /**
     * Check if user has active expert system access
     *
     * @return bool
     */
    public function hasExpertSystemAccess()
    {
        return $this->expert_system_access && 
               ($this->expert_system_expires_at === null || $this->expert_system_expires_at > now());
    }

    /**
     * Relationship with payments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }

    /**
     * Get the latest successful payment for expert system
     *
     * @return \App\Models\Payment|null
     */
    public function getLatestExpertSystemPayment()
    {
        return $this->payments()
            ->where('transaction_status', 'settlement')
            ->whereNotNull('paid_at')
            ->latest('paid_at')
            ->first();
    }

    /**
     * Grant expert system access
     *
     * @param int $days
     * @return bool
     */
    public function grantExpertSystemAccess($days = 30)
    {
        return $this->update([
            'expert_system_access' => true,
            'expert_system_expires_at' => now()->addDays($days)
        ]);
    }

    /**
     * Revoke expert system access
     *
     * @return bool
     */
    public function revokeExpertSystemAccess()
    {
        return $this->update([
            'expert_system_access' => false,
            'expert_system_expires_at' => null
        ]);
    }

    /**
     * Check if expert system access is expired
     *
     * @return bool
     */
    public function isExpertSystemAccessExpired()
    {
        if (!$this->expert_system_access) {
            return true;
        }

        if ($this->expert_system_expires_at === null) {
            return false; // Never expires
        }

        return $this->expert_system_expires_at <= now();
    }

    /**
     * Get days remaining for expert system access
     *
     * @return int|null
     */
    public function getExpertSystemDaysRemaining()
    {
        if (!$this->hasExpertSystemAccess()) {
            return 0;
        }

        if ($this->expert_system_expires_at === null) {
            return null; // Never expires
        }

        return max(0, now()->diffInDays($this->expert_system_expires_at, false));
    }
}
