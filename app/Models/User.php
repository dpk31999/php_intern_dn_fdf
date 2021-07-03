<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'city',
        'address',
        'phone',
        'avatar_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorite_products');
    }

    public function ratings()
    {
        return $this->belongsToMany(Product::class, 'ratings', 'product_id', 'user_id')
                    ->withPivot('num_rated', 'content');
    }

    public function suggestProducts()
    {
        return $this->belongsToMany(Category::class, 'suggest_products', 'cate_id', 'user_id')
                    ->withPivot('name', 'status');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
