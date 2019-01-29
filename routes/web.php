<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
Route::get('/', function () {

    $user=User::find(1);
    $user->assignRole('writer');
    \Auth::login($user);
    return view('welcome');
});
Route::group(['middleware' => ['role:writer']], function () {
    Route::get('test',function (){
        $app = app();
        $routes = $app->routes->getRoutes();
        foreach ($routes as $k=>$value){
            $path[$k]['uri'] = $value->uri;
        }
        dd($path);
//    $role = Role::create(['name' => 'update']);
//    $permission = Permission::create(['name' => 'edit articles']);
        $role=Role::find(1);
        $role->givePermissionTo('edit articles');
        dd(122);
        $user=User::find(1);
        $user->givePermissionTo('edit articles');
        dd(123);
    });
    Route::get('t',function (){
       dd(111);
    })->middleware('permission:edit articles');
});

