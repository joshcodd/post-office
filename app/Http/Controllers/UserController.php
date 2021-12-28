<?php

namespace App\Http\Controllers;

use App\Models\Header;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function generateToken()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::User();
        $token = $user->createToken('api_token');
        return ['token' => $token->plainTextToken];
    }

    public function uploadHeader(Request $request, User $user)
    {
        $request->validate([
            'image' => 'mimes:jpeg,png',
        ]);

        $header = $user->header;
        if (!$header) {
            $header = new Header();
            $header->user_id = $user->id;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $resized = Image::make($file)->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('webp', 90);

            $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_path = "images/" . md5(time()) . '_' . $original_name . ".webp";
            Storage::disk('s3')->put($file_path, (string)$resized, 'public');

            $header->image_path = Storage::disk('s3')->url($file_path);
            $header->save();
        }

        return redirect()->route('users.show.me');
    }

    public function destroyHeader(User $user)
    {
        if ($user->header) {
            $user->header->delete();
        }
        return redirect()->route('users.show.me');
    }

    public function showMyProfile()
    {
        $user = User::findOrFail(Auth::User()->id);
        return view('users.show', ['user' => $user]);
    }

    public function notifications()
    {
        return view('notifications.index');
    }

    public function clearNotifications()
    {
        Auth::User()->notifications->markAsRead();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }
}