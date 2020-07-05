<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataTablesController extends Controller
{
    /**
     * users
     *
     * @return void
     */
    public function users()
    {
        $users = User::with(['role','media'])
        ->get();

        return Datatables::of($users)
        ->editColumn('avatar', function ($var)
        {
            return "<img class='avatar_user shadow' src='$var->avatar'/>";
        })
        ->editColumn('last_login_at', function ($var) {
            return datetime($var->last_login_at);
        })
        ->editColumn('role', function ($var) {
            return '<span class="badge badge-success">'.$var->role->name.'</span>';
        })
        ->addColumn('action', function ($var) {
            return '
            <a href="'.route("backend.users.show",$var->id).'" class="btn btn-success btn-sm"> <i class="ik ik-eye"></i> Show</a>

            <a href="'.route("backend.users.edit",$var->id).'" class="btn btn-danger btn-sm"><i class="ik ik-edit"></i> Edit</a>';
        })
        ->makeHidden([
            'role_id',
            'is_blocked',
            'location',
            'bio',
            'website',
            'last_seen_at',
            'deleted_at',
            'created_at',
            'last_login_ip',
            'email_verified_at',
            'status',
            'updated_at',
        ])
        ->escapeColumns(['action'])
		->make();
    }


    /**
     * roles
     *
     * @return void
     */
    public function roles()
    {
        $roles = Role::withCount(['users','permissions'])
        ->get();

        return Datatables::of($roles)
        ->editColumn('permissions_count', function ($var) {
            if ($var->permissions_count > 0) {
                return '<span class="badge badge-success">'.$var->permissions_count.' Premissions</span>';
            }
            return '<span class="badge badge-danger">No Premissions 😢</span>';
        })
        ->editColumn('users_count', function ($var) {
            if ($var->users_count > 0) {
                return '<span class="badge badge-success">'.$var->users_count.' Users</span>';
            }
            return '<span class="badge badge-danger">No Users 😢</span>';
        })
        ->addColumn('action', function ($var) {
            return '
            <a href="'.route("backend.roles.show",$var->id).'" class="btn btn-success btn-sm"> <i class="ik ik-eye"></i> Show</a>

            <a href="'.route("backend.roles.edit",$var->id).'" class="btn btn-danger btn-sm"><i class="ik ik-edit"></i> Edit</a>';
        })
        ->makeHidden([
            'created_at',
            'updated_at',
            'deletable'
        ])
        ->escapeColumns(['action'])
		->make();
    }
}
