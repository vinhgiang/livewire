<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Comment extends Model
{
    use HasFactory;

    // Use this empty array instead of putting each field in $fillable array to allow modifying every column in DB
    // or giving a list of columns that do not allow to modify in this $guarded
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
