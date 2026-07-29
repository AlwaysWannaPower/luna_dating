<?php
    
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'avatar', 'birth_date', 'gender', 'looking_for', 'city', 'bio'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
        ];
    }

    public function getAgeAttribute(): ?int
    {
        if (!$this->birth_date) {
            return null;
        }

        return $this->birth_date->diffInYears(now());
    }

    public function hasCompletedProfile(): bool
    {
        return !is_null($this->name)
            && !is_null($this->birth_date)
            && !is_null($this->gender)
            && !is_null($this->looking_for)
            && !is_null($this->city);
    }

    // Связи для лайков и матчей
    public function likesSent(): HasMany
    {
        return $this->hasMany(Like::class, 'from_user_id');
    }

    public function likesReceived(): HasMany
    {
        return $this->hasMany(Like::class, 'to_user_id');
    }

    public function matchesAsUserA(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'matches', 'user_a_id', 'user_b_id');
    }

    public function matchesAsUserB(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'matches', 'user_b_id', 'user_a_id');
    }

    public function matches(): BelongsToMany
    {
        return $this->matchesAsUserA()->merge(
            $this->matchesAsUserB()->withTimestamps()
        )->withTimestamps();
    }

    public function hasLiked(User $user): bool
    {
        return $this->likesSent()->where('to_user_id', $user->id)->exists();
    }

    public function hasMatched(User $user): bool
    {
        return $this->matches()->where('users.id', '!=', $this->id)->where('users.id', $user->id)->exists();
    }
}
