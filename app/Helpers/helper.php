<?php


function uploadImage($folder, $file)
{

    if ($file) {

        $img_gen   = hexdec(uniqid());
        $image_url = 'images/' . $folder . '/';
        $image_ext = strtolower($file->getClientOriginalExtension());

        $img_name    = $img_gen . '.' . $image_ext;
        $file->move($image_url, $img_name);
        return $image_url . $img_gen . '.' . $image_ext;
    }


    return null;
}

function menuList()
{
    return [

        [
            'sideIcon'   => 'home',
            'title'      => 'Dashboard',
            'link'       => route('dashboard'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'dash_board',

        ],
        [
            'sideIcon'   => 'thermometer',
            'title'      => 'Demo',
            'link'       => '',
            'hasSub'     => true,
            'permission' => 'OT',
            'subMenu'    => [
                [
                    'sideIcon'   => '',
                    'title'      => 'Operation',
                    'link'       => '',
                    'permission' => 'Operation',
                ],
            ],

        ],
    ];
}

function findMenu($targetArray)
{
    if (session('owner_id') == session('auth_id')) {
        return true;
    }
    if (array_key_exists($targetArray, session('single_permission'))) {
        if (is_array(session('single_permission')[$targetArray])) {
            return true;
        }
        return false;
    }
    return false;
}
function findSub($menu, $sub)
{
    if (session('owner_id') == session('auth_id')) {
        return true;
    }

    if (array_key_exists($menu, session('single_permission'))) {
        if (is_array(session('single_permission')[$menu])) {
            $result = session('single_permission')[$menu];
            if (array_key_exists($sub, $result)) {
                return true;
            }
        }
        return false;
    }
    return false;
}
