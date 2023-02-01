<?php

namespace App\Models;

// use App\Support\Authorization\AuthorizationRoleTrait;
use Config;
use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
  // use AuthorizationRoleTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table;

  protected $casts = [
    'removable' => 'boolean',
  ];

  /**
   * Creates a new instance of the model.
   *
   * @param array $attributes
   */
  // public function __construct(array $attributes = [])
  // {
  //   parent::__construct($attributes);
  //   $this->table = Config::get('entrust.roles_table');
  // }

  protected $fillable = ['name', 'guard_name'];

  // public static function jsonMe($removable)
  // {
  //   $role_register = Role::where('removable', true)->select('id', 'name', 'description')->get()->toarray();
  //   return json_encode($role_register);
  // }

  
}