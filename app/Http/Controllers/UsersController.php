<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
    	$user = User::find($id);
        if($user->ppshow == false && auth()->user()->id != $user->id)
        {
            $user->profile_picture = 'no-image.png';
        }
        if($user->pnshow == false && auth()->user()->id != $user->id)
        {
            $user->name = 'No name information found';
        }
        if($user->peshow == false && auth()->user()->id != $user->id)
        {
            $user->email = 'No email information found';
        }
        return view('account.index')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
    	        $this ->validate($request, [
        		'email' => 'email',
        		'profile_picture' => 'image|nullable|max:1999'
        ]);
        $user = User::find($id);

        //Handle file upload
        if($request->hasFile('profile_picture')){
            //Get filename with extenstion
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            //Upload
            $path = $request->file('profile_picture')->storeAs('public/profile_pictures', $fileNameToStore);
        }
        else{
        	$fileNameToStore = 'wat zka ni slike';
        }
        $user->name = $request->input('name');
        $user->bio = $request->input('bio');
        if($request->hasFile('profile_picture'))
        {
            $user->profile_picture = $fileNameToStore;
        }
        $user->email = $request->input('email');
        $user->ppshow = ($request->input('ppshow') == 'checkbox') ? true : false;
    
        $user->pnshow = ($request->input('pnshow') == 'checkbox') ? true : false;
    
        $user->peshow = ($request->input('peshow') == 'checkbox') ? true : false;
        $user->save();
        return redirect('users/'.$user->id)->with('success', 'User information updated successfully.');
    }
}
