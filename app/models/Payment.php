<?php

namespace bus\Project\models;

use bus\Project\core\Model;

class Payment extends Model
{
    protected static $table = 'rental_payments';
    protected static $guarded = ['id'];
}