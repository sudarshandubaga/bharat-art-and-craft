<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $site = Site::first();
        if (!$site) {
            $site = Site::create([
                'title' => 'Bharat Art & Craft',
                'tagline' => 'Handcrafted Excellence in Wood & Metal',
                'email' => 'info@bharatartandcraft.com',
                'domain' => 'bharatartandcraft.com',
            ]);
        }

        return redirect()->route('admin.site.edit', $site->id);
    }

    public function edit(Request $request, $id = 1)
    {
        $site = Site::find($id);
        if (!$site) {
            $site = Site::first();
        }
        if (!$site) {
            $site = Site::create([
                'title' => 'Bharat Art & Craft',
                'tagline' => 'Handcrafted Excellence in Wood & Metal',
                'email' => 'info@bharatartandcraft.com',
                'domain' => 'bharatartandcraft.com',
            ]);
        }

        return view('admin.pages.site', compact('site'));
    }

    public function update(Request $request, $id = 1)
    {
        $site = Site::find($id);
        if (!$site) {
            $site = Site::first();
        }
        if (!$site) {
            $site = new Site();
        }

        $site->title = $request->title;
        $site->tagline = $request->tagline;
        $site->footer_script = $request->footer_script;
        $site->email = $request->email;
        $site->phone = $request->phone;
        $site->whatsapp = $request->whatsapp;
        $site->address = $request->address;
        $site->google_map = $request->google_map;
        $site->social_links = $request->social_links;

        if ($request->hasFile('logo')) {
            $site->logo = $request->file('logo')->store('site/logo', 'public');
        }
        if ($request->hasFile('footer_logo')) {
            $site->footer_logo = $request->file('footer_logo')->store('site/footer_logo', 'public');
        }
        if ($request->hasFile('favicon')) {
            $site->favicon = $request->file('favicon')->store('site/favicon', 'public');
        }

        $site->save();

        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }
}

