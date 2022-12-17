<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:role list', ['only' => ['index', 'show']]);
        $this->middleware('can:role create', ['only' => ['create', 'store']]);
        $this->middleware('can:role edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:role delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = (new Role)->newQuery();
        $roles->latest();
        $roles = $roles->paginate(50)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Roles/Index', [
            'roles' => $roles,
            'can' => [
                'create' => Auth::user()->can('role create'),
                'edit' => Auth::user()->can('role edit'),
                'delete' => Auth::user()->can('role delete'),
            ]
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/Roles/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Role::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('roles.index')->with('message', 'The Role was created successfully.');
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
    public function edit(Role $role)
    {
        return inertia('Admin/Roles/Edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        return Redirect::route('roles.index')->with('message', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return Redirect::route('roles.index')->with('message', 'Role deleted successfully');
    }
}