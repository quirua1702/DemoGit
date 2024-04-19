<?php

namespace App\Http\Controllers;

use App\Models\GoiData;
use App\Models\LoaiGoiData;
use App\Models\TenGoiData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\File;
use App\Imports\GoiDataImport;
use App\Exports\GoiDataExport;
use Excel;


class GoiDataController extends Controller
{
    //nhap tu excel
    public function postNhap(Request $request)
    {
        Excel::import(new GoiDataImport, $request->file('file_excel'));
        return redirect()->route('admin.goidata');
    }

    // Xuất ra Excel
    public function getXuat()
    {
        return Excel::download(new GoiDataExport, 'danh-sach-goi-data.xlsx');
    }

    public function getDanhSach()
    {
        $goidata = GoiData::orderBY('Created_at','DESC')->search()->paginate(10);
        return view('admin.goidata.danhsach', compact('goidata'));
    }
    public function getThem()
    {
        $loaigoidata = LoaiGoiData::all();
        $tengoidata = TenGoiData::all();
        return view('admin.goidata.them', compact('loaigoidata', 'tengoidata'));
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'loaigoidata_id' => ['required'],
            'tengoidata_id' => ['required'],
            'tengoicuoc' => ['required', 'string', 'max:191', 'unique:goidata'],
            'thongtingoicuoc' => ['required', 'string'],
            'dongia' => ['required', 'numeric'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
        ]);

        // Upload hình ảnh 
        $path = ''; 
        if($request->hasFile('hinhanh')) 
        { 
            // Tạo thư mục nếu chưa có 
            $lgd = LoaiGoiData::find($request->loaigoidata_id); 
            File::isDirectory($lgd->tenloai_slug) or Storage::makeDirectory($lgd->tenloai_slug, 0775);

            // Xác định tên tập tin 
            $extension = $request->file('hinhanh')->extension(); 
            $filename = Str::slug($request->tengoicuoc, '-') . '.' . $extension; 
            
            // Upload vào thư mục và trả về đường dẫn 
            $path = Storage::putFileAs($lgd->tenloai_slug, $request->file('hinhanh'), $filename); 
        }

        $orm = new GoiData();
        $orm->loaigoidata_id = $request->loaigoidata_id;
        $orm->tengoidata_id = $request->tengoidata_id;
        $orm->tengoicuoc = $request->tengoicuoc;
        $orm->tengoicuoc_slug = Str::slug($request->tengoicuoc, '-');
        $orm->thongtingoicuoc = $request->thongtingoicuoc;
        $orm->dongia = $request->dongia;
        if(!empty($path)) $orm->hinhanh = $path;
        /*if($request->hasFile('hinhanh')) $orm->hinhanh = $request->hinhanh;*/
        $orm->thongtingoicuoc = $request->thongtingoicuoc;

        $orm->save();
        
        return redirect()->route('admin.goidata');
    }

    public function getSua($id)
    {
        $goidata = GoiData::find($id);
        $loaigoidata = LoaiGoiData::all();
        $tengoidata = TenGoiData::all();
        return view('admin.goidata.sua', compact('goidata', 'loaigoidata', 'tengoidata'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'loaigoidata_id' => ['required'],
            'tengoidata_id' => ['required'],
            'tengoicuoc' => ['required', 'string', 'max:191', 'unique:goidata,tengoicuoc,' . $id],
            'thongtingoicuoc' => ['required', 'string'],
            'dongia' => ['required', 'numeric'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
        ]);

        // Upload hình ảnh 
        $path = ''; 
        if($request->hasFile('hinhanh')) 
        { 
            // Xóa tập tin cũ 
            $gd = GoiData::find($id); 
            if(!empty($gd->hinhanh)) Storage::delete($gd->hinhanh); 
            
            // Xác định tên tập tin mới 
            $extension = $request->file('hinhanh')->extension(); 
            $filename = Str::slug($request->tengoidata, '-') . '.' . $extension; 
            
            // Upload vào thư mục và trả về đường dẫn 
            $lgd = LoaiGoiData::find($request->loaigoidata_id);
            $path = Storage::putFileAs($lgd->tenloai_slug, $request->file('hinhanh'), $filename); 
        }

        $orm = GoiData::find($id);
        $orm->loaigoidata_id = $request->loaigoidata_id;
        $orm->tengoidata_id = $request->tengoidata_id;
        $orm->tengoicuoc = $request->tengoicuoc;
        $orm->tengoicuoc_slug = Str::slug($request->tengoicuoc, '-');
        $orm->thongtingoicuoc = $request->thongtingoicuoc;
        $orm->dongia = $request->dongia;
        if(!empty($path)) $orm->hinhanh = $path;
        /*if($request->hasFile('hinhanh')) $orm->hinhanh = $request->hinhanh;*/
        //$orm->motasanpham = $request->motasanpham;
        $orm->save();

        return redirect()->route('admin.goidata');
    }

    public function getXoa($id)
    {
        $orm = GoiData::find($id);
        $orm->delete();

        // Xóa tập tin khi xóa sản phẩm 
        if(!empty($orm->hinhanh)) Storage::delete($orm->hinhanh);

        return redirect()->route('admin.goidata');
    }
}