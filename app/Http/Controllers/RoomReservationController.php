<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\RoomOrApartmet;
use App\Models\RoomReservation;
use App\Models\RoomReservationDetails;
use App\Models\RoomReservationOtherPersonDetails;
use App\Models\RoomCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomReservationController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['rr'] = RoomReservation::orderBy('check_in', 'desc')->paginate();
        return view('room-reservation.index', $data);
    }
    public function create()
    {
        $data = [];
        $data['room_type'] = RoomCategory::get();
        return view('room-reservation.create', $data);
    }
    public function store(Request $request)
    {
        // dd($request->all());

        if (
            $request->rRoomOrApartmentType == null ||
            $request->rRoomOrApartmentNumber == null ||
            $request->rcName == null
        ) {
            return response()->json([
                'status' => false,
                'message' => 'Please select your room or customer info.'
            ]);
        }
        DB::beginTransaction();
        try {
            $latest_bill = DB::table('room_reservations')->orderBy('id', 'desc')->first();

            if (isset($latest_bill)) {
                $invoice_number = date("y") . str_pad((int) $latest_bill->invoice + 1, 5, "0", STR_PAD_LEFT);
                $invoice        = 1 + $latest_bill->invoice;
            } else {
                $invoice_number = date("y") . str_pad((int) 1, 5, "0", STR_PAD_LEFT);
                $invoice        = 1;
            }

            $customer = Customer::create([
                'name' => $request->rcName,
                'email' => $request->rcEmail,
                'phone' => $request->rcPhone,
                'country' => $request->rcCountry,
                'state' => $request->rcState,
                'city' => $request->rcCity,
                'address' => $request->rcAddress,
                'gender' => $request->rcGender,
                'age' => $request->rcAge,
                'identity_type' => $request->rcTypeID,
                'identity_number' => $request->rcIDNumber,
            ]);

            $reservation = RoomReservation::create([
                'invoice_number' => $invoice_number,
                'invoice' => $invoice,
                'check_in' => $request->rCheckIn,
                'check_out' => $request->rCheckOut,
                'arival_from' => $request->rArivalFrom,
                'booking_type' => $request->rBookingType,
                'booking_reference' => $request->rBookingReference,
                'booking_reference_number' => $request->rBookingReferenceNumber,
                'purpose_of_visite' => $request->rPurposeOfVisit,
                'remarks' => $request->rRemarks,
                'total' => $request->total,
                'vat' => $request->vat,
                'vat_amount' => $request->vat_amount,
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
                'discount_amount' => $request->discount_amount,
                'subtotal' => $request->subtotal,
                'paid_amount' => $request->paid_amount,
                'due' => $request->due,
                'customer_id' => $customer->id
            ]);

            if ($request->rRoomOrApartmentType && $request->rRoomOrApartmentNumber) {
                foreach ($request->rRoomOrApartmentType as $key => $type) {
                    if ($type && $request->rRoomOrApartmentNumber[$key]) {
                        RoomReservationDetails::create([
                            'room_reservation_id' => $reservation->id,
                            'room_type' => $type,
                            'room_or_apartment_id' => $request->rRoomOrApartmentNumber[$key],
                            'adult' => $request->rAdult[$key],
                            'child' => $request->rChild[$key],
                            'price' => $request->rPrice[$key],
                        ]);
                    }
                }
            }

            if ($request->rOPName && $request->rOPGender) {
                foreach ($request->rOPName as $o_key => $name) {
                    if ($name && $request->rOPGender[$o_key]) {
                        RoomReservationOtherPersonDetails::create([
                            'room_reservation_id' => $reservation->id,
                            'name' => $name,
                            'gender' => $request->rOPGender[$o_key],
                            'age' => $request->rOPAge[$o_key],
                            'address' => $request->rOPAddress[$o_key],
                            'type_id' => $request->rOPTypeID[$o_key],
                            'id_number' => $request->rOPIDNumber[$o_key],
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Reservation completed successfully'
            ]);
        } catch (Exception $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $data = [];
        $data['room_type'] = RoomCategory::get();
        $data['rr'] = RoomReservation::where('id', $id)->first();
        if (!$data['rr']) {
            return redirect()->back()->withToastError('No data found!');
        }
        return view('room-reservation.edit', $data);
    }

    public function update(Request $request)
    {

        dd($request->all());
        if (
            $request->rRoomOrApartmentType == null ||
            $request->rRoomOrApartmentNumber == null ||
            $request->rcName == null
        ) {
            return response()->json([
                'status' => false,
                'message' => 'Please select your room or customer info.'
            ]);
        }
        DB::beginTransaction();
        try {
            $reservation = RoomReservation::where('id', $request->rr_id)->first();
            $customer = Customer::where('id', $request->customer_id)->first();

            $customer->update([
                'name' => $request->rcName,
                'email' => $request->rcEmail,
                'phone' => $request->rcPhone,
                'country' => $request->rcCountry,
                'state' => $request->rcState,
                'city' => $request->rcCity,
                'address' => $request->rcAddress,
                'gender' => $request->rcGender,
                'age' => $request->rcAge,
                'identity_type' => $request->rcTypeID,
                'identity_number' => $request->rcIDNumber,
            ]);

            $reservation = RoomReservation::create([
                'check_in' => $request->rCheckIn,
                'check_out' => $request->rCheckOut,
                'arival_from' => $request->rArivalFrom,
                'booking_type' => $request->rBookingType,
                'booking_reference' => $request->rBookingReference,
                'booking_reference_number' => $request->rBookingReferenceNumber,
                'purpose_of_visite' => $request->rPurposeOfVisit,
                'remarks' => $request->rRemarks,
                'total' => $request->total,
                'vat' => $request->vat,
                'vat_amount' => $request->vat_amount,
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
                'discount_amount' => $request->discount_amount,
                'subtotal' => $request->subtotal,
                'paid_amount' => $request->paid_amount,
                'due' => $request->due,
                'customer_id' => $customer->id
            ]);

            if ($request->rRoomOrApartmentType && $request->rRoomOrApartmentNumber) {
                foreach ($request->rRoomOrApartmentType as $key => $type) {
                    if ($type && $request->rRoomOrApartmentNumber[$key]) {
                        RoomReservationDetails::create([
                            'room_reservation_id' => $reservation->id,
                            'room_type' => $type,
                            'room_or_apartment_id' => $request->rRoomOrApartmentNumber[$key],
                            'adult' => $request->rAdult[$key],
                            'child' => $request->rChild[$key],
                            'price' => $request->rPrice[$key],
                        ]);
                    }
                }
            }

            if ($request->rOPName && $request->rOPGender) {
                foreach ($request->rOPName as $o_key => $name) {
                    if ($name && $request->rOPGender[$o_key]) {
                        RoomReservationOtherPersonDetails::create([
                            'room_reservation_id' => $reservation->id,
                            'name' => $name,
                            'gender' => $request->rOPGender[$o_key],
                            'age' => $request->rOPAge[$o_key],
                            'address' => $request->rOPAddress[$o_key],
                            'type_id' => $request->rOPTypeID[$o_key],
                            'id_number' => $request->rOPIDNumber[$o_key],
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Reservation completed successfully'
            ]);
        } catch (Exception $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function getROAByType(Request $request)
    {
        $data = RoomOrApartmet::where('type', $request->type)->with('roomCategory')->get();
        return $data;
    }
    public function getSingleRoomDetails(Request $request)
    {
        $data = RoomOrApartmet::where('id', $request->roomId)->first();
        return $data;
    }
}
