<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Lembaga;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $getData = Lembaga::get();
        return view('auth.register', compact('getData'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_lembaga' => ['required', 'string', 'max:255', 'unique:users,id_lembaga'],
        ], [
            'id_lembaga.unique' => 'Sudah Ada User Terdaftar Sebagai Lembaga Tersebut',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'id_lembaga' => $request->id_lembaga,
            'password' => Hash::make($request->email),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);

        if (Auth::guard('superadmin')->check()) {
            return redirect('/user')->with('status', 'success')->with('message', 'User Berhasil Ditambahkan');
        } elseif (Auth::guard('admin')->check()) {
            return redirect('/manageUser')->with('status', 'success')->with('message', 'User Berhasil Ditambahkan');
        }
    }
}
