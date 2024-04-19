<?php

namespace App\Http\Controllers;

use App\Models\LoaiGoiData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoaiGoiDataController extends Controller
{
    public function getDanhSach()
    {
        $loaigoidata = LoaiGoiData::orderBY('Created_at','DESC')->search()->paginate(10);
        return view('admin.loaigoidata.danhsach', compact('loaigoidata'));
    }

    public function getThem()
    {
        return view('admin.loaigoidata.them');
    }

    public function postThem(Request $request)
    {
       
        $request->validate([
            'tenloai' => ['required', 'max:255', 'unique:loaigoidata'],
        ]);
       
        $orm = new LoaiGoiData();
        $orm->tenloai = $request->tenloai;
        $orm->tenloai_slug = Str::slug($request->tenloai, '-');
        $orm->save();

        return redirect()->route('admin.loaigoidata');

      
    }

    public function getSua($id)
    {
        $loaigoidata = LoaiGoiData::find($id);
        return view('admin.loaigoidata.sua', compact('loaigoidata'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenloai' => ['required', 'max:255', 'unique:loaigoidata,tenloai,' . $id],
        ]);

        $orm = LoaiGoiData::find($id);
        $orm->tenloai = $request->tenloai;
        $orm->tenloai_slug = Str::slug($request->tenloai, '-');
        $orm->save();
        return redirect()->route('admin.loaigoidata');
    }

    public function getXoa($id)
    {
        $orm = LoaiGoiData::find($id);
        $orm->delete();


        return redirect()->route('admin.loaigoidata');
    }
}