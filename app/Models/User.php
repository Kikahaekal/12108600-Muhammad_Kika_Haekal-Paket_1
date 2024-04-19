<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'role',
        'address',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('borrow_date', 'return_date', 'status');
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public static function getPeminjaman()
    {
        $users = self::with('books')->get();
        $data = [];

        foreach($users as $key => $user) {
            if(count($user->books) != 0) {
                foreach($user->books as $book) {
                    $data[] = [
                        'no' => ++$key,
                        'nama' => $user->name,
                        'buku yang dipinjam' => $book->title,
                        'tanggal peminjaman' => \Carbon\Carbon::parse($book->pivot->borrow_date)->format('j F Y'),
                        'tanggal pengembalian' => $book->pivot->return_date == null ? 'Belum dikembalikan' : \Carbon\Carbon::parse($book->pivot->return_date)->format('j F Y'),
                        'status' => $book->pivot->status == 1 ? 'Dipinjam' : 'Dikembalikan'
                    ];
                }
            } 
        }

        return collect($data);
    }
}
