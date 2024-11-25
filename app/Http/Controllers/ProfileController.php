<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    public function view()
    {

        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find(Auth::id());

        return view('dashboard.profile', compact('user'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function updateProfile(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => 'required|email',
            'old_pass' => 'nullable|string|min:6',
            'new_pass' => 'nullable|string|min:6|different:old_pass',
            'address' => 'nullable|string|max:255',
        ]);

        $user = User::find(Auth::id());
        if ($request->filled('old_pass')) {
            if (!Hash::check($request->old_pass, $user->password)) {
                return back()->withErrors(['old_pass' => 'The old password is incorrect.']);
            }

            if ($request->filled('new_pass')) {
                $user->password = bcrypt($request->new_pass);
            }
        }

        $user->email = $request->email;
        $user->address = $request->address;

        $user->save();


        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
