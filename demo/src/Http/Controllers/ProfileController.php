<?php

namespace A4fteam\Admpanel\Src\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use A4fteam\Admpanel\Src\Http\Models\User;
use DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'pagetitle' => 'Профиль',
            'profiles' => User::where('id','=',Auth::user()->id)->get()
        ];

        return view ('admpanel::layouts.client.profile.show', $data); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data = [
            'pagetitle' => 'Редактирование Профиля',
            'profile' => User::findOrfail($id)
        ];
        return view ('admpanel::layouts.client.profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = User::findOrfail($id);
        $all=$request->all();
        if($request->hasFile('avatar')) 
            {
            $file = $all['avatar'];    
            $path     = public_path('/vendor/admpanel/assets/upload/avatar');
            $filename = generate_filename($path, $file->getClientOriginalExtension());
            $file->move($path, $filename);
            $all['avatar'] = $filename; 
            }

        $profile->update($all);
                
       return redirect()->route('profile.show', $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
