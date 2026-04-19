<?php

namespace App\Models;

use CodeIgniter\Model;

class LostItemModel extends Model
{
    protected $table         = 'lost_items';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'item_name',
        'description',
        'category',
        'found_location',
        'found_date',
        'status',
        'reported_by',
        'claimed_by',
    ];

    protected $useTimestamps = true;
}
