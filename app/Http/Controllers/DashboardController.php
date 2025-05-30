<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Room;
use App\Models\BedType;
use App\Models\User;
use App\Models\Reservation;
use App\Models\RoomOrApartmet;
use App\Models\RoomReservation;

class DashboardController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function dashboard()
    {
        $data = [];
        $data['total_customers'] = Customer::count();
        $data['total_rooms'] = RoomOrApartmet::count();
        $data['bed_types'] = BedType::get();
        $data['total_system_users'] = User::count();
        $data['todays_reservations'] = RoomReservation::whereDate('created_at', now()->toDateString())->count();
        $data['todays_checkouts'] = RoomReservation::whereDate('check_out', now()->toDateString())->count();

        return view('dashboard', $data);
    }
}
