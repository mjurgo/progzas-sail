<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Grade;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function dashboard(): View
    {
        if (Auth::user()->isAdmin()) {
            $grades = Grade::all();
        } else if (Auth::user()->isTeacher()) {
            $grades = Auth::user()->gradesGiven->sortByDesc('created_at');
        } else {
            $grades = Auth::user()->grades;
        }

        return View('dashboard', [
            'user' => Auth::user(),
            'grades' => $grades,
        ]);
    }

    public function create(): Application|ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|View
    {
        if (!Auth::user()->isAdmin()) {
            return response('Brak uprawnień', 403);
        }

        return View('profile.create', [
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request): Application|ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|Redirect|RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return response('Brak uprawnień', 403);
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return Redirect::route('students.index');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
