<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportFile;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class StatisticController extends Controller {

    public function index() {
        return view('admin.statistical.index');
    }

    public function getStatistic($type) {
        if ($type == 'order') {
            $filename = Str::random(5);
            return Excel::download(new ExportFile, 'order_' . $filename . '.xlsx');
        } else {
            return view('admin.statistical.index');
        }
    }

}
