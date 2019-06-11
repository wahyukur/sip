<?php

namespace App\Exports;

use App\Anak;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class anakExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.anak.viewExcel', [
            'anakData' => DB::table('anaks as A')
                        ->leftjoin('users as I', 'I.id', '=', 'A.id_ibu')
                        ->get()
        ]);
    }
}
