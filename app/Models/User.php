<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [  //yang diizinkan
        'nama',
        'email',
        'tanggal_lahir',
        'jenis_kelamin',
        'role',
        'alamat',
        'slug',
        'password',
        'gambar',
        'status'
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

    protected $attributes = [  //default value
        'gambar' => '',  //defaultnya kosong
        'role'=>'admin',
        'status'=>'active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function generateVerificationToken()
    // {
    //     $this->verification_token = Str::random(40);
    //     $this->save();

    //     return $this->verification_token;
    // }
    

    // relasi
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    public function SavePost()
    {
        return $this->hasMany(SavePost::class);
    }

    public function Like()
    {
        return $this->hasMany(Like::class);
    }
}
