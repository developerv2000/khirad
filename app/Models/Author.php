<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // Also delete model relations while deleting
        static::deleting(function ($author) {
            $author->books()->each(function ($book) {
                $book->delete();
            });
        });
    }
}