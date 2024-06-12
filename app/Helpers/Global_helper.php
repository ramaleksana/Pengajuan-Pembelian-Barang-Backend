<?php

if (!function_exists('generate_menu')) {
    function generate_menu($role = '')
    {
        $permission = [];
        $menu = [];

        if ($role == 'Officer') {
        } elseif ($role == 'Manager') {
        } elseif ($role == 'Finance') {
        }

        return [
            'permission' => $permission,
            'menu'       => $menu,
        ];
    }
}
