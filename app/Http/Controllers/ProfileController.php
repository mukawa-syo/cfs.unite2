<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;

class ProfileController extends Controller
{
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
        $user = $request->user();
        $oldEmail = $user->email;
        
        $user->fill($request->validated());

        // メールアドレスが変更された場合
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $message = 'プロフィールが更新されました。新しいメールアドレスの確認メールを送信しましたので、ご確認ください。';
        } else {
            $message = 'プロフィールが更新されました。';
        }

        $user->save();

        // メールアドレスが変更され、かつメール確認が必要な場合
        if ($oldEmail !== $user->email) {
            event(new Registered($user));
        }

        return Redirect::route('dashboard')->with('status', $message);
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
