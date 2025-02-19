<?php

namespace App\Http\Controllers;

use App\Models\WsAbout;
use App\Models\WsSetup;
use App\Models\WsTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WebsiteManagementController extends Controller
{
    public function indexAbout(Request $request)
    {
        $data = [];
        $data['items'] = WsAbout::orWhereAny([
            'name',
            'details'
        ], 'like', '%' . $request->q . '%')->get();
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

    public function indexTestimonial(Request $request)
    {
        $data = [];
        $data['items'] = WsTestimonial::orWhereAny([
            'person_name',
            'person_designation',
            'details'
        ], 'like', '%' . $request->q . '%')->get();
        return view('ws.testimonial.index', $data);
    }
    public function storeOrUpdateTestimonial(Request $request, $id = null)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $file_name = $request->file('image');
            $image = uploadImage('ws_testimonial', $file_name);
        }

        if ($id) {
            $data = WsTestimonial::find($id);
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
                'person_name' => $request->person_name,
                'person_designation' => $request->person_designation,
                'details' => $request->details,
            ]);
            return back()->withToastSuccess('Data updated successfully');
        } else {
            WsTestimonial::create([
                'person_name' => $request->person_name,
                'person_designation' => $request->person_designation,
                'details' => $request->details,
                'image' => $image
            ]);
            return back()->withToastSuccess('Data created successfully');
        }
    }
    public function statusTestimonial(Request $request, $id)
    {
        $item = WsTestimonial::where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }

        $item->status = $item->status == 1 ? 0 : 1;
        $item->save();
        return back()->withToastSuccess('Status updated successfully');
    }
    public function deleteTestimonial(Request $request, $id)
    {
        $item = WsTestimonial::where('id', $id)->first();
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

    public function indexContact(Request $request) {}
    public function responsceContact(Request $request, $id) {}

    public function indexSetup(Request $request)
    {
        $item = WsSetup::find(1);
        return view('ws.setup.index', compact('item'));
    }
    public function storeOrUpdateSetup(Request $request)
    {
        // dd($request->all());
        $item = WsSetup::find(1);

        $home_theme = null;
        if ($request->hasFile('home_theme')) {
            $file_name = $request->file('home_theme');
            $home_theme = uploadImage('ws_setup', $file_name);

            $home_theme_path = public_path($item->home_theme);
            if (File::exists($home_theme_path)) {
                File::delete($home_theme_path);
            }
            $item->update(['home_theme' => $home_theme]);
        }
        $logo = null;
        if ($request->hasFile('logo')) {
            $file_name = $request->file('logo');
            $logo = uploadImage('ws_setup', $file_name);

            $logo_path = public_path($item->logo);
            if (File::exists($logo_path)) {
                File::delete($logo_path);
            }
            $item->update(['logo' => $logo]);
        }
        $favicon = null;
        if ($request->hasFile('favicon')) {
            $file_name = $request->file('favicon');
            $favicon = uploadImage('ws_setup', $file_name);

            $favicon_path = public_path($item->favicon);
            if (File::exists($favicon_path)) {
                File::delete($favicon_path);
            }
            $item->update(['favicon' => $favicon]);
        }

        $item->update([
            'contact_breadcrumb' => $request->contact_breadcrumb,
            'contact_body' => $request->contact_body,
            'hotel_name' => $request->hotel_name,
            'slogan' => $request->slogan,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'forwarding_email' => $request->forwarding_email,
            'about_hotel' => $request->about_hotel,
            'facebook' => $request->facebook,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
        ]);
        return to_route('ws.setup.index')->withToastSuccess('Data updated successfully');
    }
}
