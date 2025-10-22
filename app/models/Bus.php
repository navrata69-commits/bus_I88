<?php

namespace bus\Project\models;

use bus\Project\core\Model;

class Bus extends Model
{
    protected static $table = 'buses';
    protected static $guarded = ['id'];
}