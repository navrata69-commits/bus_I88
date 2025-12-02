<?php

namespace bus\Project\models;

use bus\Project\core\Model;

class BusRental extends Model
{
    protected static $table = 'bus_rentals';
    protected static $guarded = ['id'];
}