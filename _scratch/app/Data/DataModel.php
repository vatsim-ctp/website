<?php namespace CTP\Data;

use \Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

abstract class DataModel extends Model {
    use ValidatingTrait;
}