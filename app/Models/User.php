<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tanggal_lahir',
        'phone',
        'school',
        'level',
        'kelas',
        'city',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }

    /**
     * Ringkasan di kartu profil, contoh: "Siswa Kelas 12 SMA • IPA".
     */
    public function getStudentInfoAttribute(): string
    {
        $parts = $this->kelas ? explode(' ', trim($this->kelas), 2) : [];
        $grade = $parts[0] ?? null;
        $program = $parts[1] ?? null;

        $text = 'Siswa';
        if ($grade) {
            $text .= ' Kelas '.$grade.($this->level ? ' '.$this->level : '');
        } elseif ($this->level) {
            $text .= ' '.$this->level;
        }
        if ($program) {
            $text .= ' • '.$program;
        }

        return $text;
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }
}