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
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $workspace_detail = WorkSpace::find($workspace);

        config(['seo.page_title' => 'Profil | superLOG']);
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
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
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



        Alert::success('Bilgileriniz güncellendi,')->showConfirmButton('Tamam', '#3085d6');
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
            Alert::error('Geçerli şifre yanlış.')->showConfirmButton('Tamam', '#3085d6');
            return redirect()->back();
        }
        Alert::error('Şifre değiştirme başarısız')->showConfirmButton('Tamam', '#3085d6');

        $user->password = Hash::make($request->new_password);
        $user->save();
        Alert::success('Şifre başarıyla değiştirildi')->showConfirmButton('Tamam', '#3085d6');
        return redirect()->back();
    }


    public function plan($workspace)
    {
        $workspace_detail = WorkSpace::find($workspace);

        config(['seo.page_title' => 'Plan | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('account.plan', compact('pageTitle', 'workspace_detail'));
    }
}
