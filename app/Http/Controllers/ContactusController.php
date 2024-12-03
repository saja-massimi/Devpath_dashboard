<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contactus;

class ContactusController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $contactus = Contactus::all();
        // dd($contactus);
        return view('dashboard/contactUs', compact('contactus'));
    }

    public function edit($id)
    {
        return view('dashboard.contactus.edit');
    }

    public function update($id)
    {
        return redirect()->route('contactus.index');
    }

    public function destroy($id)
    {
        $contactus = Contactus::find($id);
        $contactus->delete();

        return redirect()->route('contactus.index');
    }
}
