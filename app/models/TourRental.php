<?php

namespace bus\Project\models;

use bus\Project\core\Model;

class TourRental extends Model
{
    protected static $table = 'tour_rentals';
    protected static $guarded = ['id'];
}