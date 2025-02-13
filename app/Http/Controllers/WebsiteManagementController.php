<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteManagementController extends Controller
{
    public function indexAbout(Request $request) {}
    public function storeOrUpdateAbout(Request $request, $id = null) {}
    public function statusAbout(Request $request, $id) {}

    public function indexTestimonial(Request $request) {}
    public function storeOrUpdateTestimonial(Request $request, $id = null) {}
    public function statusTestimonial(Request $request, $id) {}

    public function indexContact(Request $request) {}
    public function responsceContact(Request $request, $id) {}

    public function indexSetup(Request $request) {}
    public function responsceSetup(Request $request, $id) {}
}
