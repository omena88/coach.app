<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\CommitmentStatus;

class Commitment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'session_id',
        'description',
        'due_date',
        'status',
        'evaluation_coach',
        'evaluation_coachee',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'status' => CommitmentStatus::class,
        ];
    }

    /**
     * Get the session for this commitment.
     */
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
