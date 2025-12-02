<?php

namespace bus\Project\models;

use bus\Project\core\Model;

class TourPackage extends Model
{
    protected static $table = 'tour_packages';
    protected static $guarded = ['id'];

    public static function allWithDestination()
    {
        $db = (new \bus\Project\databases\Database())->getConnection();
        $stmt = $db->query("
            SELECT tp.*, d.name AS destination_name
            FROM tour_packages tp
            LEFT JOIN destinations d ON tp.destination_id = d.id
            ORDER BY tp.id DESC
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}