<?php namespace Zizaco\Entrust;

/**
 * This class is the main entry point of entrust. Usually this the interaction
 * with this class will be done through the Entrust Facade
 *
 * @license MIT
 * @package Zizaco\Entrust
 */

class Entrust
{

  public $app;

  public function __construct($app) 
  {
    $this->app = $app;
  }

  public function user() 
  {
    return $this->app->auth->user();
  }


  public function hasRole($roles, $requireAll = true)
  {
    if( $user = $this->user()) {
      return $userh->hasRole($roles, $requireAll);
    }
    return false;
  }


  public function can($permission, $requireAll = true)
  {
    if ( $user = $this->user()) {
      return $user->can($permission, $requireAll);
    }

    return false;
  }


  public function ability($roles, $permission, $options = [])
  {
    if ( $user =  $this->user()) {
      return $user->ability($roles, $permission, $options);
    }

    return false;
  }


  public function routesNeedsRoles( $route, $roles, $result = null, $requiredAll = true) 
  {
    $filterName =  is_array($roles) ? implode('_', $roles) : $roles;
    $filterName .= '_' . substr(md5($route), 0, 6);

    $closure = function() use ($roles, $result, $requiredAll) {
        $hasRole = $this->hasRole($roles, $requiredAll);
        if (!$hasRole) {
          return empty($result) ? $this->app->abort(403) : $result;
          }
    };

    $this->app->route->filter($filterName, $closure);
    $this->app->route->when($route, $filterName);
  }

   public function routeNeedsPermission($route, $permissions, $result = null, $requireAll = true)
    {
        $filterName  = is_array($permissions) ? implode('_', $permissions) : $permissions;
        $filterName .= '_'.substr(md5($route), 0, 6);
        $closure = function () use ($permissions, $result, $requireAll) {
            $hasPerm = $this->can($permissions, $requireAll);
            if (!$hasPerm) {
                return empty($result) ? $this->app->abort(403) : $result;
            }
        };
        // Same as Route::filter, registers a new filter
        $this->app->router->filter($filterName, $closure);
        // Same as Route::when, assigns a route pattern to the
        // previously created filter.
        $this->app->router->when($route, $filterName);
    }

    public function routeNeedsRoleOrPermission($route, $roles, $permissions, $result = null, $requireAll = false)
    {
        $filterName  =      is_array($roles)       ? implode('_', $roles)       : $roles;
        $filterName .= '_'.(is_array($permissions) ? implode('_', $permissions) : $permissions);
        $filterName .= '_'.substr(md5($route), 0, 6);
        $closure = function () use ($roles, $permissions, $result, $requireAll) {
            $hasRole  = $this->hasRole($roles, $requireAll);
            $hasPerms = $this->can($permissions, $requireAll);
            if ($requireAll) {
                $hasRolePerm = $hasRole && $hasPerms;
            } else {
                $hasRolePerm = $hasRole || $hasPerms;
            }
            if (!$hasRolePerm) {
                return empty($result) ? $this->app->abort(403) : $result;
            }
        };
        // Same as Route::filter, registers a new filter
        $this->app->router->filter($filterName, $closure);
        // Same as Route::when, assigns a route pattern to the
        // previously created filter.
        $this->app->router->when($route, $filterName);
    }
}