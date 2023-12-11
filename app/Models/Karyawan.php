<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Karyawan extends Model implements Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = "karyawans";

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    public function agenda()
    {
        return $this->hasMany(Agenda::class, 'karyawans_id');
    }

    // public function taskAssignedTo()
    // {
    //     return $this->hasMany(Agenda::class, 'untuk');
    // }

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'nama', 'email', 'password', 'username', 'nomer_telepon', 'userlevel', 'divisi_id'
    ];

    // Metode yang diperlukan oleh kontrak Authenticatable
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute('username');
    }

    public function getAuthPassword()
    {
        return $this->getAttribute('password');
    }

    public function getRememberToken()
    {
        return null; // Tidak mendukung fitur "remember me"
    }

    public function setRememberToken($value)
    {
        // Tidak mendukung fitur "remember me"
    }

    public function getRememberTokenName()
    {
        return null; // Tidak mendukung fitur "remember me"
    }

    public function hasRole($role)
    {
        if ($role == $this->divisi_id) {
          return true;
        }
        return false;
    }
}
