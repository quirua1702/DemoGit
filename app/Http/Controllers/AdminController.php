<?php
namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Models\GoiData;
use App\Models\NguoiDung;

class AdminController extends Controller
{
public function getHome()
{
    $goidata_count = GoiData::count();
    $donhang_count = DonHang::count();
    $nguoidung_count = NguoiDung::count();
    $donhang = DonHang::where('tinhtrang_id',1)->get();
    if(request()->date_from && request()->date_to()){
        $donhang = DonHang::where('tinhtrang_id',1)->whereBetween('created_at',[request()->date_from && request()->date_to])->get();  
    }
    return view('admin.home', compact('goidata_count','donhang_count','nguoidung_count','donhang'));
}
}
