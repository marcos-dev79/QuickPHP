<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15/04/16
 * Time: 11:05
 */

namespace Models;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenericModel extends Model
{
    use SoftDeletes;

    protected static $_table;
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function setTable($table)
    {
        static::$_table = $table;
    }

    public function getTable()
    {
        return static::$_table;
    }

    public function __construct() {
        parent::__construct();
    }
}