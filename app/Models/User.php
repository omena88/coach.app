<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\UserRole;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'coach_id',
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
            'role' => UserRole::class,
        ];
    }

    /**
     * Get the sessions where this user is the coach.
     */
    public function coachSessions()
    {
        return $this->hasMany(Session::class, 'coach_id');
    }

    /**
     * Get the sessions where this user is the coachee.
     */
    public function coacheeSessions()
    {
        return $this->hasMany(Session::class, 'coachee_id');
    }

    /**
     * Get all coachees for this coach.
     */
    public function coachees()
    {
        return $this->hasMany(User::class, 'coach_id');
    }

    /**
     * Get the coach for this coachee.
     */
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    /**
     * Check if user is coach.
     */
    public function isCoach(): bool
    {
        return $this->role === UserRole::COACH;
    }

    /**
     * Check if user is coachee.
     */
    public function isCoachee(): bool
    {
        return $this->role === UserRole::COACHEE;
    }
}
