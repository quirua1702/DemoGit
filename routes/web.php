<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoaiGoiDataController;
use App\Http\Controllers\TenGoiDataController;
use App\Http\Controllers\GoiDataController;
use App\Http\Controllers\TinhTrangController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\DonHangChiTietController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChuDeController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BinhLuanBaiVietController;
use App\Models\GoiData;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Đăng ký, đăng nhập, Quên mật khẩu
Auth::routes();
// Google OAuth
Route::get('/login/google', [HomeController::class, 'getGoogleLogin'])->name('google.login');
Route::get('/login/google/callback', [HomeController::class, 'getGoogleCallback'])->name('google.callback');

// Các trang dành cho khách chưa đăng nhập
Route::name('frontend.')->group(function() {
    // Trang chủ
    Route::get('/', [HomeController::class, 'getHome'])->name('home');
    Route::get('/home', [HomeController::class, 'getHome'])->name('home');
    Route::get('/search',[HomeController::class,'getSearch'])->name('search');
    // Trang sản phẩm
    Route::get('/goi-data', [HomeController::class, 'getGoiData'])->name('goidata');
    Route::get('/goi-data/{tenloai_slug}', [HomeController::class, 'getGoiData'])->name('goidata.phanloai');
    Route::get('/goi-data/{tenloai_slug}/{tengoicuoc_slug}', [HomeController::class, 'getGoiData_ChiTiet'])->name('goidata.chitiet');
    Route::get('/chi-tiet/{tengoicuoc_slug}',[HomeController::class,'detail'])->name('goidata.chitiet');
    // Tin tức
    Route::get('/bai-viet', [HomeController::class, 'getBaiViet'])->name('baiviet');
    Route::get('/bai-viet/{tenchude_slug}', [HomeController::class, 'getBaiViet'])->name('baiviet.chude');
    Route::get('/bai-viet/{tenchude_slug}/{tieude_slug}', [HomeController::class, 'getBaiViet_ChiTiet'])->name('baiviet.chitiet');
    Route::post('/comment/{baiviet_id}', [HomeController::class, 'postComment'])->name('baiviet.comment');

   
    Route::get('/gio-hang', [HomeController::class, 'getGioHang'])->name('giohang');
    Route::get('/gio-hang/them/{tengoicuoc_slug}', [HomeController::class, 'getGioHang_Them'])->name('giohang.them');
    Route::get('/gio-hang/xoa/{row_id}', [HomeController::class, 'getGioHang_Xoa'])->name('giohang.xoa');
    Route::get('/gio-hang/giam/{row_id}', [HomeController::class, 'getGioHang_Giam'])->name('giohang.giam');
    Route::get('/gio-hang/tang/{row_id}', [HomeController::class, 'getGioHang_Tang'])->name('giohang.tang');
    Route::post('/gio-hang/cap-nhat', [HomeController::class, 'postGioHang_CapNhat'])->name('giohang.capnhat');
    // Tuyển dụng
    Route::get('/tuyen-dung', [HomeController::class, 'getTuyenDung'])->name('tuyendung');
    // Liên hệ
    Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('lienhe');
    });
/* Demo gui email dat hang
Route::get('/dathangemail', [HomeController::class, 'getDatHangDemo'])->name('frontend.dathangemail');
*/

// Trang khách hàng
Route::get('/khach-hang/dang-ky', [HomeController::class, 'getDangKy'])->name('user.dangky');
Route::get('/khach-hang/dang-nhap', [HomeController::class, 'getDangNhap'])->name('user.dangnhap');

Route::get('/khach-hang/dang-nhap/quen-mat-khau', [HomeController::class, 'quen_mat_khau'])->name('user.quenmatkhau');
Route::get('/update-new-pass', [HomeController::class, 'update_new_pass'])->name('update-new-pass');
Route::post('/khach-hang/dang-nhap/recover-pass', [HomeController::class, 'recover_pass'])->name('recover-pass');
Route::post('/reset-new-pass', [HomeController::class, 'reset_new_pass'])->name('reset-new-pass');

// Trang tài khoản khách hàng
Route::prefix('khach-hang')->name('user.')->group(function() {
    // Trang chủ
    Route::get('/', [KhachHangController::class, 'getHome'])->name('home');
    Route::get('/home', [KhachHangController::class, 'getHome'])->name('home');
    
    // Đặt hàng
    Route::get('/dat-hang', [KhachHangController::class, 'getDatHang'])->name('dathang');
    Route::post('/dat-hang', [KhachHangController::class, 'postDatHang'])->name('dathang');
    Route::get('/dat-hang-thanh-cong', [KhachHangController::class, 'getDatHangThanhCong'])->name('dathangthanhcong');
    
    // Xem và cập nhật trạng thái đơn hàng
    Route::get('/don-hang', [KhachHangController::class, 'getDonHang'])->name('donhang');
    Route::get('/don-hang/{id}', [KhachHangController::class, 'getDonHang'])->name('donhang.chitiet');
    Route::post('/don-hang/{id}', [KhachHangController::class, 'postDonHang'])->name('donhang.chitiet');
    
    // Cập nhật thông tin tài khoản
    Route::get('/ho-so-ca-nhan', [KhachHangController::class, 'getHoSoCaNhan'])->name('hosocanhan');
    Route::post('/ho-so-ca-nhan', [KhachHangController::class, 'postHoSoCaNhan'])->name('hosocanhan');

    
    // Đăng xuất
    Route::post('/dang-xuat', [KhachHangController::class, 'postDangXuat'])->name('dangxuat');
});

// Trang tài khoản quản lý
Route::prefix('admin')->name('admin.')->middleware(['auth','manager'])->group(function() {
    // Trang chủ
    Route::get('/', [AdminController::class, 'getHome'])->name('home');
    Route::get('/home', [AdminController::class, 'getHome'])->name('home');
    
    // Quản lý Loại sản phẩm
    Route::get('/loaigoidata', [loaiGoiDataController::class, 'getDanhSach'])->name('loaigoidata');
    Route::get('/loaigoidata/them', [loaiGoiDataController::class, 'getThem'])->name('loaigoidata.them');
    Route::post('/loaigoidata/them', [loaiGoiDataController::class, 'postThem'])->name('loaigoidata.them');
    Route::get('/loaigoidata/sua/{id}', [loaiGoiDataController::class, 'getSua'])->name('loaigoidata.sua');
    Route::post('/loaigoidata/sua/{id}', [loaiGoiDataController::class, 'postSua'])->name('loaigoidata.sua');
    Route::get('/loaigoidata/xoa/{id}', [loaiGoiDataController::class, 'getXoa'])->name('loaigoidata.xoa');
   

    // Quản lý Hãng sản xuất
    Route::get('/tengoidata', [TenGoiDataController::class, 'getDanhSach'])->name('tengoidata');
    Route::get('/tengoidata/them', [TenGoiDataController::class, 'getThem'])->name('tengoidata.them');
    Route::post('/tengoidata/them', [TenGoiDataController::class, 'postThem'])->name('tengoidata.them');
    Route::get('/tengoidata/sua/{id}', [TenGoiDataController::class, 'getSua'])->name('tengoidata.sua');
    Route::post('/tengoidata/sua/{id}', [TenGoiDataController::class, 'postSua'])->name('tengoidata.sua');
    Route::get('/tengoidata/xoa/{id}', [TenGoiDataController::class, 'getXoa'])->name('tengoidata.xoa');
    Route::post('/tengoidata/nhap', [TenGoiDataController::class, 'postNhap'])->name('tengoidata.nhap');
    Route::get('/tengoidata/xuat', [TenGoiDataController::class, 'getXuat'])->name('tengoidata.xuat');


    // Quản lý Sản phẩm
    Route::get('/goidata', [GoiDataController::class, 'getDanhSach'])->name('goidata');
    Route::get('/goidata/them', [GoiDataController::class, 'getThem'])->name('goidata.them');
    Route::post('/goidata/them', [GoiDataController::class, 'postThem'])->name('goidata.them');
    Route::get('/goidata/sua/{id}', [GoiDataController::class, 'getSua'])->name('goidata.sua');
    Route::post('/goidata/sua/{id}', [GoiDataController::class, 'postSua'])->name('goidata.sua');
    Route::get('/goidata/xoa/{id}', [GoiDataController::class, 'getXoa'])->name('goidata.xoa');
    Route::post('/goidata/nhap', [GoiDataController::class, 'postNhap'])->name('goidata.nhap');
    Route::get('/goidata/xuat', [GoiDataController::class, 'getXuat'])->name('goidata.xuat');

    // Quản lý Tình trạng
    Route::get('/tinhtrang', [TinhTrangController::class, 'getDanhSach'])->name('tinhtrang');
    Route::get('/tinhtrang/them', [TinhTrangController::class, 'getThem'])->name('tinhtrang.them');
    Route::post('/tinhtrang/them', [TinhTrangController::class, 'postThem'])->name('tinhtrang.them');
    Route::get('/tinhtrang/sua/{id}', [TinhTrangController::class, 'getSua'])->name('tinhtrang.sua');
    Route::post('/tinhtrang/sua/{id}', [TinhTrangController::class, 'postSua'])->name('tinhtrang.sua');
    Route::get('/tinhtrang/xoa/{id}', [TinhTrangController::class, 'getXoa'])->name('tinhtrang.xoa');

    // Quản lý Đơn hàng
    Route::get('/donhang', [DonHangController::class, 'getDanhSach'])->name('donhang');
    Route::get('/donhang/them', [DonHangController::class, 'getThem'])->name('donhang.them');
    Route::post('/donhang/them', [DonHangController::class, 'postThem'])->name('donhang.them');
    Route::get('/donhang/sua/{id}', [DonHangController::class, 'getSua'])->name('donhang.sua');
    Route::post('/donhang/sua/{id}', [DonHangController::class, 'postSua'])->name('donhang.sua');
    Route::get('/donhang/xoa/{id}', [DonHangController::class, 'getXoa'])->name('donhang.xoa');

    // Quản lý Đơn hàng chi tiết
    Route::get('/donhang/chitiet', [DonHangChiTietController::class, 'getDanhSach'])->name('donhang.chitiet');
    Route::get('/donhang/chitiet/sua/{id}', [DonHangChiTietController::class, 'getSua'])->name('donhang.chitiet.sua');
    Route::post('/donhang/chitiet/sua/{id}', [DonHangChiTietController::class, 'postSua'])->name('donhang.chitiet.sua');
    Route::get('/donhang/chitiet/xoa/{id}', [DonHangChiTietController::class, 'getXoa'])->name('donhang.chitiet.xoa');

    // Quản lý Tài khoản người dùng
    Route::get('/nguoidung', [NguoiDungController::class, 'getDanhSach'])->name('nguoidung');
    Route::get('/nguoidung/them', [NguoiDungController::class, 'getThem'])->name('nguoidung.them');
    Route::post('/nguoidung/them', [NguoiDungController::class, 'postThem'])->name('nguoidung.them');
    Route::get('/nguoidung/sua/{id}', [NguoiDungController::class, 'getSua'])->name('nguoidung.sua');
    Route::post('/nguoidung/sua/{id}', [NguoiDungController::class, 'postSua'])->name('nguoidung.sua');
    Route::get('/nguoidung/xoa/{id}', [NguoiDungController::class, 'getXoa'])->name('nguoidung.xoa');

    // Quản lý Chủ đề
    Route::get('/chude', [ChuDeController::class, 'getDanhSach'])->name('chude');
    Route::get('/chude/them', [ChuDeController::class, 'getThem'])->name('chude.them');
    Route::post('/chude/them', [ChuDeController::class, 'postThem'])->name('chude.them');
    Route::get('/chude/sua/{id}', [ChuDeController::class, 'getSua'])->name('chude.sua');
    Route::post('/chude/sua/{id}', [ChuDeController::class, 'postSua'])->name('chude.sua');
    Route::get('/chude/xoa/{id}', [ChuDeController::class, 'getXoa'])->name('chude.xoa');
    // Quản lý Bài viết 
    Route::get('/baiviet', [BaiVietController::class, 'getDanhSach'])->name('baiviet'); 
    Route::get('/baiviet/them', [BaiVietController::class, 'getThem'])->name('baiviet.them'); 
    Route::post('/baiviet/them', [BaiVietController::class, 'postThem'])->name('baiviet.them'); 
    Route::get('/baiviet/sua/{id}', [BaiVietController::class, 'getSua'])->name('baiviet.sua'); 
    Route::post('/baiviet/sua/{id}', [BaiVietController::class, 'postSua'])->name('baiviet.sua'); 
    Route::get('/baiviet/xoa/{id}', [BaiVietController::class, 'getXoa'])->name('baiviet.xoa'); 

    // Quản lý Bình luận bài viết
    Route::get('/binhluanbaiviet', [BinhLuanBaiVietController::class, 'getDanhSach'])->name('binhluanbaiviet');
    Route::get('/binhluanbaiviet/them', [BinhLuanBaiVietController::class, 'getThem'])->name('binhluanbaiviet.them');
    Route::post('/binhluanbaiviet/them', [BinhLuanBaiVietController::class, 'postThem'])->name('binhluanbaiviet.them');
    Route::get('/binhluanbaiviet/sua/{id}', [BinhLuanBaiVietController::class, 'getSua'])->name('binhluanbaiviet.sua');
    Route::post('/binhluanbaiviet/sua/{id}', [BinhLuanBaiVietController::class, 'postSua'])->name('binhluanbaiviet.sua');
    Route::get('/binhluanbaiviet/xoa/{id}', [BinhLuanBaiVietController::class, 'getXoa'])->name('binhluanbaiviet.xoa');
    
});

/* laravel excel
Route::get('export', 'MyController@export')->name('export');
Route::get('importExportView', 'MyController@importExportView');
Route::post('import', 'MyController@import')->name('import');
*/