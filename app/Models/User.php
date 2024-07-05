<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
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
        'email',
        'password',
        'dni'
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

    public function createModel(Request $request)
    {
        $user = $this;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dni = $request->dni;
        $user->password = Hash::make($request->dni);
        $user->save();
    }

    public function updateModel(Request $request)
    {
        $user = $this;
        $user->update($request->only(['name', 'email']));
    }

    public function deleteModel()
    {
        $user = $this;
        return $user->delete();
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
