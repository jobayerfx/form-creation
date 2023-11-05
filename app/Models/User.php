<?php

namespace App\Models;

use App\Models\Form;
use App\Mail\EmailVerificationMail;
//use Iatstuti\Database\Support\CascadeSoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use Notifiable, SoftDeletes, CascadeSoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function sendEmailVerificationNotification()
    {
        $message = new EmailVerificationMail($this);
        Mail::to($this)->send($message);
    }

    public function hasVerifiedEmail()
    {
        return is_null($this->email_token);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function collaboratedForms()
    {
        return $this->belongsToMany(Form::class, 'form_collaborators', 'user_id', 'form_id')
            ->withTimestamps();
    }

    public function isFormCollaborator($form)
    {
        return !is_null($this->collaboratedForms()->find($form));
    }
}
