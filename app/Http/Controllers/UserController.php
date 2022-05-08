<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{

    public function show(User $user)
    {
        $backgroundColor = $user->background_color;
        $textColor = $user->text_color;

        $user->load('links');

        return view('users.show', [
            'user' => $user,
            'backgroundColor' => $backgroundColor,
            'textColor' => $textColor
        ]);
    }

    public function edit()
    {
        return view('users.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'background_color' => 'required|size:7|starts_with:#',
            'text_color' => 'required|size:7|starts_with:#'
        ]);

        $user = User::find(Auth::user()->id);
        $user->background_color = $request->background_color;
        $user->text_color = $request->text_color;
        $user->save();

        return redirect()->back()
            ->with(['success' => 'Changes saved successfully!']);
    }

}
?>
