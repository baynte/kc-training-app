<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'mname',
        'ext_name',
        'id_number',
        'email',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name', 'avatar'];

    public function getFullNameAttribute(){
        $m = $this->mname ? " ".ucfirst($this->mname[0])."." : "";
        $ext = $this->ext_name ? " ".strtoupper($this->ext_name): "";
        return ucfirst($this->lname) . ", " . ucfirst($this->fname) . $m . $ext;
    }

    public function getAvatarAttribute(){
        return "https://ui-avatars.com/api/?background=random&color=fff&name=". $this->lname.'+'.$this->fname;
    }
}
