<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $lembaga = $user->lembaga;
        $pageTitle = "Profile";

        return view('profile.edit', [
            'user' => $user,
            'lembaga' => $lembaga,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            // Validasi input manual
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($request->user()->id)],
            ]);

            // Mengisi data user yang sedang login
            $user = $request->user();
            $user->fill($validatedData);

            // Reset email_verified_at jika email diubah
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            // Simpan perubahan
            $user->save();

            return redirect('/profile')->with('status', 'success')->with('message', 'Profil Berhasil Diubah.');
        } catch (\Exception $e) {
            // Tangkap pesan error dan kembalikan ke halaman dengan status error
            return redirect('/profile')->with('status', 'error')->with('message', 'Gagal Mengubah Profil: ' . $e->getMessage());
        }
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
