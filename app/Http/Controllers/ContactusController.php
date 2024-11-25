<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactusController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }

        return view('dashboard/contactus');
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
        return redirect()->route('contactus.index');
    }
}
