<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class BackendUserController extends Controller
{
    protected $folder = 'backend.user.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all data
        $users = User::paginate(request('length') ? request('length') : 5);

        $viewdata = [
            'users' => $users
        ];

        return view($this->folder . 'index', $viewdata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->folder . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('alert', 'Thêm mới thành công');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $viewdata = [
            'user' => $user
        ];

        return view($this->folder . 'edit', $viewdata);
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
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ])->validate();

        $user = User::findOrFail($id);
        $user->name = $request->name;
        // $user->password =$request->password; 

        $user->save();

        return redirect()->route('backend_user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Detach all relationships
        $user->roles()->detach();
        $user->forceDelete();

        return redirect()->route('backend_user.index');
    }
    public function search(Request $request)
    {

            $search = $request->input('search_user');
            $users = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->paginate(request('length') ? request('length') : 5);
            $viewdata = [
                'users' => $users
            ];
    
            return view($this->folder . 'index', $viewdata);
    }
}
