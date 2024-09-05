<?php

namespace Database\Seeders;

use App\Models\AdminMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the menu items with their respective submenus and child menus
        $menus = [
            // Admins Menu
            ['name' => 'Admins', 'parent_id' => null, 'model_name' => null, 'url' => '/admins', 'count' => 0, 'icon' => 'mdi mdi-shield-account', 'status' => 1],
            ['name' => 'List', 'parent_id' => 1, 'model_name' => null, 'url' => '/admins', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 1, 'model_name' => null, 'url' => '/admins/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Users Menu
            ['name' => 'Users', 'parent_id' => null, 'model_name' => null, 'url' => '/users', 'count' => 0, 'icon' => 'mdi mdi-account-multiple', 'status' => 1],
            ['name' => 'All Users', 'parent_id' => 4, 'model_name' => null, 'url' => '/users', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Active Users', 'parent_id' => 4, 'model_name' => null, 'url' => '/users?activeUsers=Users', 'count' => 0, 'icon' => 'mdi mdi-check-circle', 'status' => 1],
            ['name' => 'Inactive Users', 'parent_id' => 4, 'model_name' => null, 'url' => '/users?inactiveUsers=Users', 'count' => 0, 'icon' => 'mdi mdi-close-circle', 'status' => 1],
            ['name' => 'Paid Users', 'parent_id' => 4, 'model_name' => null, 'url' => '/users?paidUsers=users', 'count' => 0, 'icon' => 'mdi mdi-cash', 'status' => 1],
            ['name' => 'Spotlight Users', 'parent_id' => 4, 'model_name' => null, 'url' => '/spotlights', 'count' => 0, 'icon' => 'mdi mdi-star', 'status' => 1],
            ['name' => 'Orders', 'parent_id' => 4, 'model_name' => null, 'url' => '/user-orders', 'count' => 0, 'icon' => 'mdi mdi-shopping', 'status' => 1],

            // Geography Menu
            ['name' => 'Geography', 'parent_id' => null, 'model_name' => null, 'url' => '/geography', 'count' => 0, 'icon' => 'mdi mdi-earth', 'status' => 1],
            ['name' => 'Countries', 'parent_id' => 12, 'model_name' => null, 'url' => '/countries', 'count' => 0, 'icon' => 'mdi mdi-map', 'status' => 1],
            ['name' => 'List', 'parent_id' => 13, 'model_name' => null, 'url' => '/countries', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 13, 'model_name' => null, 'url' => '/countries/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],
            ['name' => 'States', 'parent_id' => 12, 'model_name' => null, 'url' => '/states', 'count' => 0, 'icon' => 'mdi mdi-map-marker', 'status' => 1],
            ['name' => 'List', 'parent_id' => 16, 'model_name' => null, 'url' => '/states', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 16, 'model_name' => null, 'url' => '/states/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],
            ['name' => 'Cities', 'parent_id' => 12, 'model_name' => null, 'url' => '/cities', 'count' => 0, 'icon' => 'mdi mdi-city', 'status' => 1],
            ['name' => 'List', 'parent_id' => 19, 'model_name' => null, 'url' => '/cities', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 19, 'model_name' => null, 'url' => '/cities/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Community Menu
            ['name' => 'Community', 'parent_id' => null, 'model_name' => null, 'url' => '/community', 'count' => 0, 'icon' => 'mdi mdi-account-group', 'status' => 1],
            ['name' => 'Religion', 'parent_id' => 22, 'model_name' => null, 'url' => '/religion', 'count' => 0, 'icon' => 'mdi mdi-religion', 'status' => 1],
            ['name' => 'List', 'parent_id' => 23, 'model_name' => null, 'url' => '/religion', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 23, 'model_name' => null, 'url' => '/religion/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],
            ['name' => 'Castes', 'parent_id' => 22, 'model_name' => null, 'url' => '/castes', 'count' => 0, 'icon' => 'mdi mdi-account-group', 'status' => 1],
            ['name' => 'List', 'parent_id' => 26, 'model_name' => null, 'url' => '/castes', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 26, 'model_name' => null, 'url' => '/castes/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Mother Tongues Menu
            ['name' => 'Mother Tongues', 'parent_id' => null, 'model_name' => null, 'url' => '/mother-tongues', 'count' => 0, 'icon' => 'mdi mdi-language', 'status' => 1],
            ['name' => 'List', 'parent_id' => 29, 'model_name' => null, 'url' => '/mother-tongues', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 29, 'model_name' => null, 'url' => '/mother-tongues/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Education Menu
            ['name' => 'Education', 'parent_id' => null, 'model_name' => null, 'url' => '/education', 'count' => 0, 'icon' => 'mdi mdi-school', 'status' => 1],
            ['name' => 'List', 'parent_id' => 32, 'model_name' => null, 'url' => '/education', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 32, 'model_name' => null, 'url' => '/education/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Employees Menu
            ['name' => 'Employees', 'parent_id' => null, 'model_name' => null, 'url' => '/employees', 'count' => 0, 'icon' => 'mdi mdi-account-tie', 'status' => 1],
            ['name' => 'List', 'parent_id' => 35, 'model_name' => null, 'url' => '/employees', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 35, 'model_name' => null, 'url' => '/employees/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Occupation Menu
            ['name' => 'Occupation', 'parent_id' => null, 'model_name' => null, 'url' => '/occupation', 'count' => 0, 'icon' => 'mdi mdi-briefcase', 'status' => 1],
            ['name' => 'List', 'parent_id' => 38, 'model_name' => null, 'url' => '/occupation', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 38, 'model_name' => null, 'url' => '/occupation/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Incomes Menu
            ['name' => 'Incomes', 'parent_id' => null, 'model_name' => null, 'url' => '/incomes', 'count' => 0, 'icon' => 'mdi mdi-cash', 'status' => 1],
            ['name' => 'List', 'parent_id' => 41, 'model_name' => null, 'url' => '/incomes', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 41, 'model_name' => null, 'url' => '/incomes/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Plans Menu
            ['name' => 'Plans', 'parent_id' => null, 'model_name' => null, 'url' => '/plans', 'count' => 0, 'icon' => 'mdi mdi-credit-card', 'status' => 1],
            ['name' => 'List', 'parent_id' => 44, 'model_name' => null, 'url' => '/plans', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 44, 'model_name' => null, 'url' => '/plans/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // CMS Pages Menu
            ['name' => 'CMS Pages', 'parent_id' => null, 'model_name' => null, 'url' => '/cms-pages', 'count' => 0, 'icon' => 'mdi mdi-file-document', 'status' => 1],
            ['name' => 'List', 'parent_id' => 47, 'model_name' => null, 'url' => '/cms-pages', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 47, 'model_name' => null, 'url' => '/cms-pages/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Success Stories Menu
            ['name' => 'Success Stories', 'parent_id' => null, 'model_name' => null, 'url' => '/success-stories', 'count' => 0, 'icon' => 'mdi mdi-star', 'status' => 1],
            ['name' => 'List', 'parent_id' => 50, 'model_name' => null, 'url' => '/success-stories', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 50, 'model_name' => null, 'url' => '/success-stories/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Profile Prefix Menu
            ['name' => 'Profile Prefix', 'parent_id' => null, 'model_name' => null, 'url' => '/profile-prefix', 'count' => 0, 'icon' => 'mdi mdi-tag', 'status' => 1],
            ['name' => 'List', 'parent_id' => 53, 'model_name' => null, 'url' => '/profile-prefix', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 53, 'model_name' => null, 'url' => '/profile-prefix/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Menus Menu
            ['name' => 'Menus', 'parent_id' => null, 'model_name' => null, 'url' => '/menus', 'count' => 0, 'icon' => 'mdi mdi-menu', 'status' => 1],
            ['name' => 'List', 'parent_id' => 56, 'model_name' => null, 'url' => '/menus', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 56, 'model_name' => null, 'url' => '/menus/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            // Action Menu
            ['name' => 'Action', 'parent_id' => null, 'model_name' => null, 'url' => '/action', 'count' => 0, 'icon' => 'mdi mdi-cogs', 'status' => 1],
            ['name' => 'Site Setting', 'parent_id' => 59, 'model_name' => null, 'url' => '/site-settings', 'count' => 0, 'icon' => 'mdi mdi-settings', 'status' => 1],
            ['name' => 'List', 'parent_id' => 60, 'model_name' => null, 'url' => '/site-settings', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 60, 'model_name' => null, 'url' => '/site-settings/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            ['name' => 'Approvals', 'parent_id' => 59, 'model_name' => null, 'url' => '/approvals', 'count' => 0, 'icon' => 'mdi mdi-check-circle', 'status' => 1],
            ['name' => 'List', 'parent_id' => 63, 'model_name' => null, 'url' => '/approvals', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 63, 'model_name' => null, 'url' => '/approvals/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            ['name' => 'Banners', 'parent_id' => 59, 'model_name' => null, 'url' => '/banners', 'count' => 0, 'icon' => 'mdi mdi-image', 'status' => 1],
            ['name' => 'List', 'parent_id' => 66, 'model_name' => null, 'url' => '/banners', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 66, 'model_name' => null, 'url' => '/banners/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            ['name' => 'Email Settings', 'parent_id' => 59, 'model_name' => null, 'url' => '/email-settings', 'count' => 0, 'icon' => 'mdi mdi-email', 'status' => 1],
            ['name' => 'List', 'parent_id' => 69, 'model_name' => null, 'url' => '/email-settings', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 69, 'model_name' => null, 'url' => '/email-settings/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            ['name' => 'Favicons', 'parent_id' => 59, 'model_name' => null, 'url' => '/favicons', 'count' => 0, 'icon' => 'mdi mdi-application', 'status' => 1],
            ['name' => 'List', 'parent_id' => 72, 'model_name' => null, 'url' => '/favicons', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 72, 'model_name' => null, 'url' => '/favicons/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            ['name' => 'Logos', 'parent_id' => 59, 'model_name' => null, 'url' => '/logos', 'count' => 0, 'icon' => 'mdi mdi-image', 'status' => 1],
            ['name' => 'List', 'parent_id' => 75, 'model_name' => null, 'url' => '/logos', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 75, 'model_name' => null, 'url' => '/logos/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            ['name' => 'Admin Menus', 'parent_id' => 59, 'model_name' => null, 'url' => '/admin-menus', 'count' => 0, 'icon' => 'mdi mdi-menu', 'status' => 1],
            ['name' => 'List', 'parent_id' => 78, 'model_name' => null, 'url' => '/admin-menus', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 78, 'model_name' => null, 'url' => '/admin-menus/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            ['name' => 'Site Configs', 'parent_id' => 59, 'model_name' => null, 'url' => '/site-configs', 'count' => 0, 'icon' => 'mdi mdi-cogs', 'status' => 1],
            ['name' => 'List', 'parent_id' => 81, 'model_name' => null, 'url' => '/site-configs', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 81, 'model_name' => null, 'url' => '/site-configs/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],

            ['name' => 'Payment Gateways', 'parent_id' => 59, 'model_name' => null, 'url' => '/payment-gateways', 'count' => 0, 'icon' => 'mdi mdi-credit-card', 'status' => 1],
            ['name' => 'List', 'parent_id' => 84, 'model_name' => null, 'url' => '/payment-gateways', 'count' => 0, 'icon' => 'mdi mdi-view-list', 'status' => 1],
            ['name' => 'Create', 'parent_id' => 84, 'model_name' => null, 'url' => '/payment-gateways/create', 'count' => 0, 'icon' => 'mdi mdi-plus', 'status' => 1],
        ];

        // Insert the menu items into the database
       foreach( $menus  as  $menu){
        AdminMenu::create($menu);
       }
    }
}

