<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $connection = "mysql";

    const VIEWER = "Viewer";
    const AUTHOR = "Author";
    const ADMIN = "Admin";
    const SUPER_ADMIN = "Super Admin";
}
