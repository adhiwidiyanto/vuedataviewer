<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\DataViewer;

class Customers extends Model
{
    use DataViewer;

    public static $columns = [
      'id', 'name', 'email',
      'phone', 'created_at', 'updated_at'
    ];
}
