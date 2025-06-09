<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\SessionMode;
use App\SessionStatus;

class Session extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coaching_sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'coach_id',
        'coachee_id',
        'date',
        'time',
        'mode',
        'status',
        'goals',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'time' => 'datetime:H:i',
            'mode' => SessionMode::class,
            'status' => SessionStatus::class,
        ];
    }

    /**
     * Get the coach for this session.
     */
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    /**
     * Get the coachee for this session.
     */
    public function coachee()
    {
        return $this->belongsTo(User::class, 'coachee_id');
    }

    /**
     * Get the commitments for this session.
     */
    public function commitments()
    {
        return $this->hasMany(Commitment::class);
    }
}
