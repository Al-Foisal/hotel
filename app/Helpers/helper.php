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
            'sideIcon'   => 'home',
            'title'      => 'System User',
            'link'       => route('systemUser.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'System_User',

        ],
        [
            'sideIcon'   => 'home',
            'title'      => 'Customer',
            'link'       => route('customer.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'Customer',

        ],
        [
            'sideIcon'   => 'thermometer',
            'title'      => 'Room Reservation',
            'link'       => '',
            'hasSub'     => true,
            'permission' => 'Room_Reservation',
            'subMenu'    => [
                [
                    'sideIcon'   => '',
                    'title'      => 'Reservation List',
                    'link'       => route('roomReservation.index'),
                    'permission' => 'Reservation_List',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Check In',
                    'link'       => route('roomReservation.create'),
                    'permission' => 'Check_In',
                ],
            ],

        ],
        [
            'sideIcon'   => 'thermometer',
            'title'      => 'Room Reservation Setting',
            'link'       => '',
            'hasSub'     => true,
            'permission' => 'Room_Reservation_Setting',
            'subMenu'    => [
                [
                    'sideIcon'   => '',
                    'title'      => 'Room Type',
                    'link'       => route('rrs.roomType.index'),
                    'permission' => 'Room_Type',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Bed Type',
                    'link'       => route('rrs.bedType.index'),
                    'permission' => 'Bed_Type',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Floor',
                    'link'       => route('rrs.floor.index'),
                    'permission' => 'Bed_Type',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Facility',
                    'link'       => route('rrs.facility.index'),
                    'permission' => 'Facility',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Room or Apartment',
                    'link'       => route('rrs.roa.index'),
                    'permission' => 'Room_or_Apartment',
                ],
            ],

        ],
        [
            'sideIcon'   => 'user',
            'title'      => 'Human Resource',
            'link'       => '',
            'hasSub'     => true,
            'permission' => 'Human_Resource',
            'subMenu'    => [
                [
                    'sideIcon'   => '',
                    'title'      => 'Designation',
                    'link'       => route('rrs.desg.index'),
                    'permission' => 'Designation',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Employee',
                    'link'       => route('rrs.emp.index'),
                    'permission' => 'Employee',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Payroll',
                    'link'       => route('rrs.payroll.index'),
                    'permission' => 'Payroll',
                ],
        
            ],

        ],

        [
            'sideIcon'   => 'thermometer',
            'title'      => 'Inventory Setting',
            'link'       => '',
            'hasSub'     => true,
            'permission' => 'Inventory_Setting',
            'subMenu'    => [
                [
                    'sideIcon'   => '',
                    'title'      => 'Supplier',
                    'link'       => route('rrs.supplier.index'),
                    'permission' => 'Room_Type',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Supplier Payment',
                    'link'       => route('rrs.supplier-payment.index'),
                    'permission' => 'Bed_Type',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Product Category',
                    'link'       => route('rrs.product-category.index'),
                    'permission' => 'Bed_Type',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Product',
                    'link'       => route('rrs.product.index'),
                    'permission' => 'Facility',
                ],
            ],

        ],

        [
            'sideIcon'   => 'thermometer',
            'title'      => 'Inventory Management',
            'link'       => '',
            'hasSub'     => true,
            'permission' => 'Inventory_Management',
            'subMenu'    => [
                [
                    'sideIcon'   => '',
                    'title'      => 'Purchase',
                    'link'       => route('rrs.purchase.index'),
                    'permission' => 'Room_Type',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Stock',
                    'link'       => route('rrs.stock.index'),
                    'permission' => 'Bed_Type',
                ],
            ],

        ],
        [
            'sideIcon'   => 'thermometer',
            'title'      => 'Website Management',
            'link'       => '',
            'hasSub'     => true,
            'permission' => 'Website_Management',
            'subMenu'    => [
                [
                    'sideIcon'   => '',
                    'title'      => 'Website About',
                    'link'       => route('ws.about.index'),
                    'permission' => 'Website_About',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Website Testimonial',
                    'link'       => route('ws.testimonial.index'),
                    'permission' => 'Website_Testimonial',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Website Contact',
                    'link'       => route('ws.contact.index'),
                    'permission' => 'Website_Contact',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Website Setup',
                    'link'       => route('ws.setup.index'),
                    'permission' => 'Website_Setup',
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

function isOperator()
{
    if (auth()->user()->responsibility === 'Operator') {
        return true;
    } else {
        return false;   
    }
}
