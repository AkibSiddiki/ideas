<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'image',
        'email',
        'password',
        'password_confirmation'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'password_confirmation',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function ideas()
    {
        return $this->hasMany(idea::class)->latest();
    }

    public function comments()
    {
        return $this->hasMany(comment::class);
    }

    public function getUserImage()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        } else return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={$this->image}";
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'following_id');
    }

    public function following()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function followersCount()
    {
        return $this->followers()->count();
    }

    public function followingCount()
    {
        return $this->following()->count();
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    // public function followingIdeas()
    // {
    //     return Idea::whereIn('user_id', $this->following()->pluck('following_id'))->latest();
    // }


    // public function notFollowingUsers($limit = 4)
    // {
    //     $followingUsersIds = $this->following()->pluck('following_id')->prepend($this->id);
    //     dd($followingUsersIds);

    //     return User::whereNotIn('id', $followingUsersIds)->limit($limit);
    // }
}