<?php

namespace bus\Project\models;

use bus\Project\core\Model;

class User extends Model
{
    protected static $table = 'users';
    protected static $guarded = ['id'];
}