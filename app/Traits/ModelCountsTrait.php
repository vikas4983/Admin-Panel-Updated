<?php

namespace App\Traits;

use App\Models\AdminMenu;
use App\Models\ModelCount;

trait ModelCountsTrait
{
    protected function indexCount($modelClass, $urlName)
    {
        $modelInstance = new $modelClass;
        $adminMenus = AdminMenu::where('url', $urlName)->first();
        if ($adminMenus) {
            $adminMenus->update(
                [
                    'model_name' => $modelClass,
                    'count' => $modelInstance->count()
                ],
            );
        }
    }
    protected function createCount($modelClass, $routeName)
    {
        $relativeUrl = route($routeName, [], false);
        ModelCount::updateOrCreate(
            [
                'modal_name' => $modelClass,
                'route_name' => $routeName,
                'url' => $relativeUrl,
            ]
        );
    }

    protected function paidUsersCount($modelClass, $urlName, $premiumUsers)
    {
        $modelInstance = new $modelClass;
        $adminMenu = AdminMenu::where('url', $urlName)->first();
        if ($adminMenu) {
            $count = $premiumUsers
                ? $modelInstance->whereHas('payments', function ($query) {
                    $query->where('is_paid', 1);
                })->count()
                : $modelInstance->count();
            $adminMenu->update([
                'model_name' => $modelClass,
                'count' => $count,
            ]);
        }
    }
    protected function activeUsersCount($modelClass, $urlName, $active)
    { 
       
        $adminMenu = AdminMenu::where('url', $urlName)->first();
        if ($adminMenu) {
           $adminMenu->update([
                'model_name' => $modelClass,
                'count' => $active,
            ]);
        }
    }
    protected function inActiveUsersCount($modelClass, $urlName, $inActive)
    { 
       
        $adminMenu = AdminMenu::where('url', $urlName)->first();
        if ($adminMenu) {
           
           $adminMenu->update([
                'model_name' => $modelClass,
                'count' => $inActive,
            ]);
        }
    }
    protected function spoteLightCount($modelClass, $urlName, $count)
    { 
        $modelInstance = new $modelClass;
        $adminMenus = AdminMenu::where('url', $urlName)->first();
        if ($adminMenus) {
            $adminMenus->update(
                [
                    'model_name' => $modelClass,
                    'count' => $count
                ],
            );
        }
    }

     protected function spotelightStatus(){
       
     }


}
