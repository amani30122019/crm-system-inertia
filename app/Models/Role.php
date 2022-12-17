<?php

namespace App\Models;

use App\Models\User;
use Spatie\Permission\Models\Role as OriginalRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends OriginalRole
{
    use HasFactory;
    protected $fillable = ['name', 'guard_name'];
}