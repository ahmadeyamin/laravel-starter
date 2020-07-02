<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Http\Request;

class DataTablesController extends Controller
{
    /**
     * users
     *
     * @return void
     */
    public function users()
    {
        $users = User::select(['id','name','email','created_at'])->get();

        return Datatables::of($users)
        ->editColumn('avatar', function ($var)
        {
            return "<img class='avatar_user shadow' src='$var->avatar'/>";
        })
        ->editColumn('created_at', function ($var) {
            return datetime($var->created_at);
        })
        ->addColumn('action', function ($var) {
            return '

            <a href="#" class="btn btn-success btn-sm"> <i class="ik ik-eye"></i></a>

            <a href="#" class="btn btn-danger btn-sm"><i class="ik ik-edit"></i></a>

            ';
        })
        ->escapeColumns([])
		->toJson();
    }
}
