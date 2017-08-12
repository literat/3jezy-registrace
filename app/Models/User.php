<?php namespace App\Models;

use App\Models\Role;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return Role
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    /**
     * @param  string  $name
     * @return boolean
     */
    public function hasRole(string $name)
    {
        $hasRole = false;

        foreach($this->roles as $role) {
            if($role->name == $name) {
                $hasRole = true;
            }
        }

        return $hasRole;
    }

    /**
     * @param  string $role
     * @return void
     */
    public function assignRole(Role $role)
    {
        return $this->roles()->attach($role);
    }

    /**
     * @param  string $role
     * @return void
     */
    public function removeRole(Role $role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * @return Social
     */
    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }

    /**
     * @return string
     */
    public function homeUrl(): string
    {
        if ($this->hasRole('user')) {
            $url = route('user.home');
        } else {
            $url = route('admin.home');
        }

        return $url;
    }
}