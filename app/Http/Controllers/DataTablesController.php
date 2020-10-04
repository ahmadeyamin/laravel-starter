<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
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
        $users = User::with(['role'])
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
            return '<span class="badge shadow badge-success">'.$var->role->name.'</span>';
        })
        ->addColumn('action', function ($var) {
            return '
            <a href="'.route("backend.users.show",$var->id).'" class="btn btn-success shadow btn-sm"> <i class="ik ik-eye"></i> Show</a>

            <a href="'.route("backend.users.edit",$var->id).'" class="btn btn-danger shadow btn-sm"><i class="ik ik-edit"></i> Edit</a>';
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
                return '<span class="badge badge-success shadow">'.$var->permissions_count.' Premissions</span>';
            }
            return '<span class="badge badge-danger shadow">No Premissions 😢</span>';
        })
        ->editColumn('users_count', function ($var) {
            if ($var->users_count > 0) {
                return '<span class="badge badge-success shadow">'.$var->users_count.' Users</span>';
            }
            return '<span class="badge badge-danger shadow">No Users 😢</span>';
        })
        ->addColumn('action', function ($var) {
            return '
            <a href="'.route("backend.roles.show",$var->id).'" class="btn btn-success shadow btn-sm"> <i class="ik ik-eye"></i> Show</a>

            <a href="'.route("backend.roles.edit",$var->id).'" class="btn btn-danger shadow btn-sm"><i class="ik ik-edit"></i> Edit</a>';
        })
        ->makeHidden([
            'created_at',
            'updated_at',
            'deletable'
        ])
        ->escapeColumns(['action'])
		->make();
    }

    /**
     * modules
     *
     * @return void
     */
    public function permissions()
    {
        $permissions = Permission::with(['module:id,name','roles:name'])
        ->latest('id')->get();

        return Datatables::of($permissions)
        ->addColumn('action', function ($var) {
            return '
            <a href="#" class="btn mb-1 btn-success shadow btn-sm"> <i class="ik ik-eye"></i> Show</a>
            <a onClick="openEditPermission('.$var->id.')" href="javascript:void(0)" class="btn btn-danger shadow btn-sm"><i class="ik ik-edit"></i> Edit</a>';
        })
        ->addColumn('rolesname', function ($var) {
            $html = '';
            foreach ($var->roles as $key => $value) {
                $html .= '<span class="badge badge-dark ml-1 mb-1 shadow-sm">'.$value->name.'</span><br>';
            }

            return $html;
        })
        ->editColumn('created_at', function ($var) {
            return $var->created_at->diffForHumans();
        })
        ->editColumn('module.name', function ($var) {
            return '<span class="badge badge-light shadow-sm">'.$var->module->name.'</span> <a href="javascript:void(0)" onClick="openEditModule('.$var->module->id.')" class="btn btn-icon btn-outline-success border-0 btn-xs"><i class="ik ik-edit-2 "></i></a>';
        })
        ->editColumn('slug', function ($var) {
            return '<code>'.$var->slug.'</code>';
        })
        ->makeHidden([
            'updated_at',
            'deletable',
            'roles'
        ])
        ->escapeColumns(['action'])
		->make();
    }

    /**
     * modules
     *
     * @return void
     */
    public function modules()
    {
        $modules = Module::withCount(['permissions'])
        ->get();

        return Datatables::of($modules)
        ->editColumn('permissions_count', function ($var) {
            if ($var->permissions_count > 0) {
                return '<span class="badge badge-success">'.$var->permissions_count.' Premissions</span>';
            }
            return '<span class="badge badge-danger shadow">No Premissions 😢</span>';
        })
        ->addColumn('action', function ($var) {
            return '
            <a href="'.route("backend.modules.show",$var->id).'" class="btn btn-success shadow btn-sm"> <i class="ik ik-eye"></i> Show</a>

            <a href="'.route("backend.modules.edit",$var->id).'" class="btn btn-danger shadow btn-sm"><i class="ik ik-edit"></i> Edit</a>';
        })
        ->editColumn('created_at', function ($var) {
            return datetime($var->created_at);
        })
        ->makeHidden([
            'updated_at',
            'deletable'
        ])
        ->escapeColumns(['action'])
		->make();
    }
}
