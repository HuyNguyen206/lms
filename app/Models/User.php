<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\ApproveStatus;
use App\Enums\Gender;
use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        'document',
        'approve_instructor_status'
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
            'role' => Role::class,
            'approve_instructor_status' => ApproveStatus::class,
            'gender' => Gender::class
        ];
    }

    public function isInstructor(): bool
    {
        return $this->role === Role::INSTRUCTOR;
    }

    public function getRoleName(): string
    {
        if ($this instanceof Admin) {
            return 'admin';
        }

       return Str::lower($this->role->name);
    }

    public function getAvatar()
    {
        return Storage::disk('public')->url($this->image);
    }
}
