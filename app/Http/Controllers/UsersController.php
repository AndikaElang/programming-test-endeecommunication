<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class UsersController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $users = User::join('roles', 'roles.id_role', '=', 'users.id_role')
                        ->whereNot('users.id_role', 1)
                        ->get();

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="'. route('user.editdata', ['user' => $row]) .'" class="btn btn-warning btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                            </a>';
                    $html .= '&nbsp;';
                    $html .= '<form action="#" method="post" class="d-inline" onsubmit="return confirm(\'Yakin akan menghapus data?\')">';
                    $html .= csrf_field();
                    $html .= method_field('DELETE');
                    $html .= '<button type="submit" class="btn btn-danger btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </button>';
                    $html .= '</form>';

                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.index');
    }

    public function editdata(User $user) {
        $roles = Role::whereNot('id_role', 1)->get();
        $user_role_name = User::join('roles', 'roles.id_role', '=', 'users.id_role')
                                ->select('roles.role_name')
                                ->whereNot('users.id_role', 1)
                                ->first();

        return view('users.edit', ['user' => $user, 'roles' => $roles, 'user_role_name' => $user_role_name]);
    }

    public function updatedata(User $user, Request $request) {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $user->name = $request->nama;
        $user->email = $request->email;
        $user->id_role = $request->role;
        $user->save();

        return redirect()->route('user.index');
    }
}
