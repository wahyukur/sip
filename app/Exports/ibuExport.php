<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ibuExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.ibu.viewExcel', [
            'ibuData' => DB::table('users as I')
            			// ->join('anaks as A', 'I.id', '=', 'A.id_ibu')
                		->where('jabatan', '=', 0)
                		->get()
        ]);
    }
}
