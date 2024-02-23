<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class adminC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $posisi = empty($request->posisi)?'':$request->posisi;

        $admin = User::where(function ($query) use ($keyword, $posisi){
            $query->where("name", "like" ,"%$keyword%")
            ->where('posisi', "like", "$posisi%");
        })
        ->orderBy('created_at', "desc")
        ->paginate(15);


        $admin->appends($request->only(['limit', 'keyword', 'posisi']));

        return view('pages.admin.admin', [
            "keyword" => $keyword,
            "posisi" => $posisi,
            "admin" => $admin,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request, $iduser)
    {
        try{
            $password = Hash::make(('admin'.date('Y')));
    
            User::where('iduser', $iduser)->first()->update(['password', $password]);
            return redirect()->back()->with('success', 'Success');
        
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'username'=>'required|unique:users,username',
            'password'=>'required',
            'posisi'=>'required'
        ]);

        try{
            $data = $request->all();
            $data['gambar'] = 'user.png';
            $data['password'] = Hash::make('admin'.date('Y'));
            User::create($data);

            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
