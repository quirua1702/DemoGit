<?php

namespace App\Http\Controllers;


use App\Models\TenGoiData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\TenGoiDataImport;
use App\Exports\TenGoiDataExport;
use Excel;

class TenGoiDataController extends Controller
{
    //nhap tu excel
    public function postNhap(Request $request)
    {
        Excel::import(new TenGoiDataImport, $request->file('file_excel'));
        return redirect()->route('admin.tengoidata');
    }

    // Xuất ra Excel
    public function getXuat()
    {
        return Excel::download(new TenGoiDataExport, 'ten-goi-data.xlsx');
    }
    public function getDanhSach()
    {
        $tengoidata = TenGoiData::orderBY('Created_at','DESC')->search()->paginate(10);
        return view('admin.tengoidata.danhsach', compact('tengoidata'));
    }

    public function getThem()
    {
        return view('admin.tengoidata.them');
    }

    public function postThem(Request $request)
    {
       
        $request->validate([
            'tengoi' => ['required', 'max:255', 'unique:tengoidata'],
            //'hinhanh' => ['nullable', 'image', 'max:1024']

        ]);
         // Upload hình ảnh 
         //$path = ''; 
         //if($request->hasFile('hinhanh')) 
         //{ 
            // $extension = $request->file('hinhanh')->extension(); 
            // $filename = Str::slug($request->tengoi, '-') . '.' . $extension; 
           //  $path = Storage::putFileAs('gia-goi-cuoc', $request->file('hinhanh'), $filename); 
         //}
       
        $orm = new TenGoiData();
        $orm->tengoi = $request->tengoi;
        $orm->tengoi_slug = Str::slug($request->tengoi, '-');
        //if(!empty($path)) $orm->hinhanh = $path;
        $orm->save();

        return redirect()->route('admin.tengoidata');

      
    }

    public function getSua($id)
    {
        $tengoidata = TenGoiData::find($id);
        return view('admin.tengoidata.sua', compact('tengoidata'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tengoi' => ['required', 'max:255', 'unique:tengoidata,tengoi,' . $id],
            //'hinhanh' => ['nullable', 'image', 'max:1024']

        ]);
          // Upload hình ảnh 
          //$path = ''; 
          //if($request->hasFile('hinhanh')) 
          //{ 
              // Xóa file cũ 
             // $orm = GiaGoiCuoc::find($id); 
             // if(!empty($orm->hinhanh)) Storage::delete($orm->hinhanh); 
              
              // Upload file mới 
             // $extension = $request->file('hinhanh')->extension(); 
             // $filename = Str::slug($request->tengoi, '-') . '.' . $extension;
            //  $path = Storage::putFileAs('gia-goi-cuoc', $request->file('hinhanh'), $filename); 
            //}



        $orm = TenGoiData::find($id);
        $orm->tengoi = $request->tengoi;
        $orm->tengoi_slug = Str::slug($request->tengoi, '-');
        //if(!empty($path)) $orm->hinhanh = $path;
        $orm->save();

        // Sau khi sửa thành công thì tự động chuyển về trang danh sách
        return redirect()->route('admin.tengoidata');
    }

    public function getXoa($id)
    {
        $orm = TenGoiData::find($id);
        $orm->delete();

        // Xoá hình ảnh khi xóa dữ liệu 
        //if(!empty($orm->hinhanh)) Storage::delete($orm->hinhanh); 
        
        // Sau khi xóa thành công thì tự động chuyển về trang danh sách 
        return redirect()->route('tengoidata');
    }
}    