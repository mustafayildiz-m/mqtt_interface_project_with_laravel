<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserAndWorkspaces;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\WorkSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{
    public function account($workspace)
    {
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $workspace_detail = WorkSpace::find($workspace);

        config(['seo.page_title' => 'Profil | Superlog']);
        $pageTitle = config('seo.page_title');
        $user_info = DB::table('users as u')
            ->leftJoin('user_infos as ui', 'u.id', '=', 'ui.user_id')
            ->select('*')
            ->where('u.id', auth()->user()->id)
            ->first();

        return view('account.profile', compact('pageTitle', 'workspace_detail', 'user_info'));
    }

    public function editProfile(Request $request, $workspace)
    {
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);

        if ($request->name !== auth()->user()->name) {
            User::where('name', auth()->user()->name)->update(['name' => $request->name]);
        }

        $user_info = UserInfo::where('user_id', auth()->user()->id);
        if (count($request->file()) !== 0) {
            $filename = '/images/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
            $user_img = $filename;
        } elseif (isset($request->old_image)) {
            $user_img = $request->old_image;
        }
        $user_info->update([
            'user_phone' => $request->user_phone,
            'user_img' => $user_img
        ]);

        if ($request->email !== auth()->user()->email) {
            User::where('email', auth()->user()->email)->update(['email' => $request->email]);
            AllowedUserAndWorkspaces::where('allowed_email', auth()->user()->email)->update(['allowed_email' => $request->email]);
            Alert::warning('Mail adresiniz güncellendi lütfen tekrar giriş yapınız.');
            Auth::logout();
            return redirect('/login');

        }


        Alert::success('Bilgileriniz Güncellendi,');
        return redirect()->back();

    }


    public function changePassword(Request $request)
    {
        $validator = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            Alert::error('Geçerli şifre yanlış.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        Alert::success('Şifre başarıyla değiştirildi');
        return redirect()->back()->withErrors($validator)->withInput();
    }


    public function plan($workspace)
    {
        $workspace_detail = WorkSpace::find($workspace);

        config(['seo.page_title' => 'Plan | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('account.plan', compact('pageTitle', 'workspace_detail'));
    }
}
