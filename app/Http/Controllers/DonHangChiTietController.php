<?php

namespace App\Http\Controllers;

use App\Models\DonHang_ChiTiet;


class DonHangChiTietController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    public function getDanhSach()
    {
        
    $donhang_chitiet = DonHang_ChiTiet::all();
        dd($donhang_chitiet);
    //return view('donhang_chitiet.danhsach', compact('donhang_chitiet'));
    }
}
