<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use BeyondCode\Comments\Traits\HasComments;
use App\Models\Admin;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasComments;

    protected $fillable = [
        'title',
        'description',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}