<?php

namespace App\Http\Controllers;

use App\DataTables\AttencesDataTable;

class AttendencesController extends Controller
{
    public function index()
    {
//        return dd('d');
        $User = new AttencesDataTable();
        return $User->render('attendences.index', ['deleted' => false]);
    }


}
