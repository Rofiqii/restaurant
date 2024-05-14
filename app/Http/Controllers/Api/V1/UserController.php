<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
// use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    //
    public function Index(){
        $users = User::all();

        return view("admin.allusers", compact('users'));
    }

    public function AddUsers(){
        $users = User::latest()->get();
        return view('admin.addusers', compact('users'));
    }

    public function StoreUsers(Request $request){

        $request->validate([
            'f_name' =>'required',
            'email' =>'required|unique:users,email',
            'phone' => 'required',
            'password' => 'required',
        ]);

        // $category_id = $request->category_id;

        // $category_name = Category::where('id', $category_id)->value('category_name');

        $user = User::create([
            'f_name' => $request->f_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        // $token = $user->createToken('RestaurantCustomerAuth')->accessToken;


        // return response()->json(['token' => $token,'is_phone_verified' => 0, 'phone_verify_end_url'=>"api/v1/auth/verify-phone" ], 200);
        // Category::where('id', $category_id)->increment('subcategory_count', 1);

        return redirect()->route('allusers')->with('message', 'Pengguna telah berhasil ditambah!');

    }

    public function EditUsers($id){
        $users_info = User::findOrFail($id);

        return view('admin.editusers', compact('users_info'));
    }

    public function UpdateUsers(Request $request){
        $request->validate([
            'f_name' =>'required',
            'email' =>'required|unique:users,email',
            'phone' => 'required',
            'password' => 'required',
        ]);


        $userid = $request->id;
        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        User::findOrFail($userid)->update([
            'f_name' => $request->f_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'updated_at' => $mytime,
        ]);

        return redirect()->route('allusers')->with('message', 'Pengguna berhasil diupdate!');
    }

    public function DeleteUsers(User $id)
    {
        // $user_id= User::where('id', $id)->value('id');
        User::findOrFail($id)->delete();

        // Category::where('id', $cat_id)->decrement('subcategory_count', 1);
        $subcategory->delete();
        return redirect()->route('allsubcategory')->with('message', 'Pengguna berhasil dihapus');
    }

}
