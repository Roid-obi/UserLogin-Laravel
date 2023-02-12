<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // public function list()
    // {
    //     return datatables()
    //         ->eloquent(User::query()->latest())
    //         ->addColumn('action', function() {
    //             return '
    //                 <button class="btn btn-sm btn-danger mr-2">
    //                     <i class="fa fa-trash"></i>
    //                 </button>
    //             ';
    //         })
    //         ->addIndexColumn()
    //         ->escapeColumns(['action'])
    //         ->toJson();

    // }

    // public function index()
    // {
    //     return view('user.index');
    // }
    public function list()
    {
        return datatables()
            ->eloquent(User::query()->latest())
            ->addColumn('action', function ($user) {
                return '
                <form action="'.route('destroy', $user->id) .'" method="POST">
                    <input type="hidden" name="_token" value="'. @csrf_token() .'">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-sm btn-danger mr-2 mt-2">
                    <i class="fa fa-trash"></i>
                    </button>
                </form>
                ';
            })
            ->addColumn ('gambar', function($user){
                if(Auth::user()->gambar){
                    return'<img  src= "'.asset('/storage/public/images/'. $user->gambar ).'"  class="img-circle" style="width: 50px" >';
                }else{
                    return'<img id="images-default" src="'. asset('gambar/guruguru-hololive.gif').'" class="img-circle" style="width: 50px">';
                }
            })


            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

    public function index()
    {
        return view('user.index');
    }

public function destroy(User $user)
{
   $user->delete();

   return redirect()->back();
}

}





