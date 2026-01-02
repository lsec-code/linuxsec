<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Card;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // Settings
    public function settings()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->except('_token');
        
        // Debugging: Ensure data is received
        if (empty($data)) {
            return redirect()->back()->with('error', 'Tidak ada data yang dikirim.');
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Clear cache if you add caching later
        // Cache::forget('settings');

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function captcha()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.captcha', compact('settings'));
    }

    // Cards
    public function cards(Request $request)
    {
        $location = $request->get('location', 'home');
        $cards = Card::where('page_location', $location)->orderBy('order')->get();
        return view('admin.cards', compact('cards', 'location'));
    }

    public function storeCard(Request $request)
    {
        Card::create($request->all());
        return redirect()->back()->with('success', 'Kartu berhasil ditambahkan.');
    }

    public function updateCard(Request $request, Card $card)
    {
        $card->update($request->all());
        return redirect()->back()->with('success', 'Kartu berhasil diperbarui.');
    }
    
    public function deleteCard(Card $card)
    {
        $card->delete();
        return redirect()->back()->with('success', 'Kartu berhasil dihapus.');
    }
}
