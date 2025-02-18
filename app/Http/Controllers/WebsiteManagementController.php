<?php

namespace App\Http\Controllers;

use App\Models\WsAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WebsiteManagementController extends Controller
{
    public function indexAbout(Request $request)
    {
        $data = [];
        $data['items'] = WsAbout::get();
        return view('ws.about.index', $data);
    }
    public function storeOrUpdateAbout(Request $request, $id = null)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $file_name = $request->file('image');
            $image = uploadImage('ws_about', $file_name);
        }

        if ($id) {
            $data = WsAbout::find($id);
            if (!$data) {
                return back()->withToastError('No data found.');
            }
            if ($image) {
                $image_path = public_path($data->image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $data->update(['image' => $image]);
            }
            $data->update([
                'name' => $request->name,
                'details' => $request->details,
            ]);
            return back()->withToastSuccess('Data updated successfully');
        } else {
            WsAbout::create([
                'name' => $request->name,
                'details' => $request->details,
                'image' => $image
            ]);
            return back()->withToastSuccess('Data created successfully');
        }
    }
    public function statusAbout(Request $request, $id)
    {
        $item = WsAbout::where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }

        $item->status = $item->status == 1 ? 0 : 1;
        $item->save();
        return back()->withToastSuccess('Status updated successfully');
    }
    public function deleteAbout(Request $request, $id)
    {
        $item = WsAbout::where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }
        $image_path = public_path($item->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $item->delete();
        return back()->withToastSuccess('Data deleted successfully');
    }

    public function indexTestimonial(Request $request) {}
    public function storeOrUpdateTestimonial(Request $request, $id = null) {}
    public function statusTestimonial(Request $request, $id) {}

    public function indexContact(Request $request) {}
    public function responsceContact(Request $request, $id) {}

    public function indexSetup(Request $request) {}
    public function responsceSetup(Request $request, $id) {}
}
