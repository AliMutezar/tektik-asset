<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Division;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // dd($request->user());
        return view('profile.edit-test', [
            'user' => $request->user(),
            'division' => Division::all()
        ]);
    }

    public function update_password(): View
    {
        return view('profile.partials.update-password-form');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')) {
            $path_photo = $request->file('image')->store('photo-profile', 'public');

            if ($request->oldImage && is_string($request->oldImage) && Storage::disk('public')->exists($request->oldImage)) {
                Storage::disk('public')->delete($request->oldImage);
            }

            $request->merge(['image' => $path_photo]);
        }

        $request->user()->fill($request->validated());

        // Kalo emailnya diganti, verisikasi ulang
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        if($request->hasFile('image')) {
            $request->user()->update(['image' => $path_photo, 'oldImage' => $request->oldImage]);
        }

        return Redirect::route('profile.edit')->with('success', 'Profile has been updated successfully');
    }

    /**
     * Delete the user's account.
     */
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
