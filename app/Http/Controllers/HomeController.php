<?php

namespace App\Http\Controllers;

use App\Models\ChuDe;
use App\Models\BaiViet;
use App\Models\BinhLuanBaiViet;
use App\Models\NguoiDung;
use App\Models\GoiData;
use App\Models\LoaiGoiData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;
use Laravel\Socialite\Facades\Socialite;
use Exception;


class HomeController extends Controller
{




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getHome()
    {
        $loaigoidata = LoaiGoiData::all();
        return view('frontend.home', compact('loaigoidata'));
    }
    public function getSearch(Request $request)
    {
        $goidata = GoiData::orderBY('Created_at','DESC')->search()->paginate(10);
        return view('frontend.search', compact('goidata'));
    }

    public function getGoiData($tengoicuoc_slug = '')
    {
        $loaigoidata = LoaiGoiData::all();
        $goidata = GoiData::paginate(10);
        return view('frontend.goidata', compact('goidata','loaigoidata'));
    }

    public function getGoiData_ChiTiet($tenloai_slug = '', $tengoicuoc_slug = '')
    {
        // Bổ sung code tại đây
        
        $goidata = GoiData::where('tengoicuoc_slug',$tengoicuoc_slug)->first();
        return view('frontend.goidata_chitiet',compact('goidata'));
    }
    public function detail($tengoicuoc_slug)
    {
        $goidata = GoiData::where('tengoicuoc_slug',$tengoicuoc_slug)->first();
        return view('frontend.goidata_chitiet',compact('goidata'));
    }

    public function getBaiViet($tenchude_slug = '')
    {
        $chude = ChuDe::all();
        $baiviet = BaiViet::paginate(10);
        return view('frontend.baiviet', compact('baiviet','chude'));

    }
    public function getBaiViet_ChiTiet($tenchude_slug = '', $tieude_slug = '')
    {
        $binhluanbaiviet = BinhLuanBaiViet::paginate(10);
        // Bổ sung code tại đây
        $baiviet = BaiViet::where('tieude_slug',$tieude_slug)->first();
        return view('frontend.baiviet_chitiet',compact('baiviet','binhluanbaiviet'));
    }
    public function postComment($baiviet_id)
    {
        // Bổ sung code tại đây
        $data = request()->all('comment');
        $data['baiviet_id'] = $baiviet_id;
        $data['nguoidung_id'] = auth()->id();
        if(BinhLuanBaiViet::create($data)){
            return redirect()->back();
        }
        return redirect()->back();
        //return view('frontend.baiviet_chitiet',compact('baiviet'));
    }



    public function getGioHang()
    {
        // Bổ sung code tại đây
        if(Cart::count() > 0)
        return view('frontend.giohang');
        else
        return view('frontend.giohangrong');
    }

    public function getGioHang_Them($tengoicuoc_slug = '')
    {
        $goidata = GoiData::where('tengoicuoc_slug', $tengoicuoc_slug)->first();
        Cart::add([
        'id' => $goidata->id,
        'name' => $goidata->tengoicuoc,
        'price' => $goidata->dongia,
        'qty' => 1,
        'weight' => 0,
        'options' => [
        'image' => $goidata->hinhanh
        ]
        ]);
        return redirect()->route('frontend.home');
    }

    public function getGioHang_Xoa($row_id)
    {
        Cart::remove($row_id);
        return redirect()->route('frontend.giohang');
    }

    public function getGioHang_Giam($row_id)
    {
        $row = Cart::get($row_id);
        // Nếu số lượng là 1 thì không giảm được nữa
        if($row->qty > 1)
        {
        Cart::update($row_id, $row->qty - 1);
        }
        return redirect()->route('frontend.giohang');
    }

    public function getGioHang_Tang($row_id)
    {
        $row = Cart::get($row_id);
        // Không được tăng vượt quá 10 sản phẩm
        if($row->qty < 10)
        {
        Cart::update($row_id, $row->qty + 1);
        }
        return redirect()->route('frontend.giohang');
    }

    public function postGioHang_CapNhat(Request $request)
    {
        foreach($request->qty as $row_id => $quantity)
        {
        if($quantity <= 0)
        Cart::update($row_id, 1);
        else if($quantity > 10)
        Cart::update($row_id, 10);
        else
        Cart::update($row_id, $quantity);
        }
        
        return redirect()->route('frontend.giohang');
    }

    public function getTuyenDung()
    {
        return view('frontend.tuyendung');
    }

    public function getLienHe()
    {
        return view('frontend.lienhe');
    }

    // Trang đăng ký dành cho khách hàng
    public function getDangKy()
    {
        return view('user.dangky');
    }

    // Trang đăng nhập dành cho khách hàng
    public function getDangNhap()
        {
            return view('user.dangnhap');
        }

    public function recover_pass(Request $request){
        $data =$request->all();
        $title_mail = "MOBIFONE WEBSITE(lấy lại mật khẩu)";
        $nguoidung = NguoiDung::where('email','=',$data['email_account'])->get();

        foreach($nguoidung as $key =>$value){
            $nguoidung_id = $value->id;
        }

        if($nguoidung){
            $count_nguoidung =$nguoidung->count();
            if($count_nguoidung==0){
                return redirect()->back()->with('error','Email chưa được đăng kí để khôi phục mật khẩu');
            }else{
                $token_random = Str::random();
                $nguoidung = NguoiDung::find($nguoidung_id);
                $nguoidung-> remember_token = $token_random;
                $nguoidung->save();

                //gui mail
                $to_email = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,"email"=>$data['email_account']);//body of mail.blade.php
                
                Mail::send('user.forget_pass_notify',['data'=>$data] ,function($message) use ($title_mail,$data)
                {
                    $message->to($data['email'])->subject($title_mail);//send this mail with subject
                    $message->from($data['email'],$title_mail);//send from this mail
                });
                return redirect()->back()->with('massage','Gửi mail thành công vui lòng vào email để reset pass!');
            
                }
            }
        }
        public function reset_new_pass(Request $request)
        {
            $data = $request->all();
            $token_random = Str::random();
            $nguoidung = NguoiDung::where('email', $data['email'])->where('remember_token', $data['token'])->first();
        
            if($nguoidung){
                $nguoidung->password = bcrypt($data['password_pw']); // Sử dụng bcrypt() cho tính bảo mật tốt hơn
                $nguoidung->remember_token = $token_random;
                $nguoidung->save();
        
                return redirect('khach-hang/dang-nhap')->with('message', 'Mật khẩu đã được cập nhật!');
            } else {
                return redirect('quen-mat-khau')->with('error', 'Vui lòng nhập lại email vì link đã quá hạn');
            }
            return view('frontend.home');
        }
        
    
    public function update_new_pass(){
        return view('user.new_pass');
    }
        
    public function quen_mat_khau(Request $request){
        return view('user.quenmatkhau');
    }

    public function getGoogleLogin()
        {
            return Socialite::driver('google')->redirect();
        }

    public function getGoogleCallback()
        {
            try
            {
                $user = Socialite::driver('google')
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
                ->stateless()
                ->user();
            }
            catch(Exception $e)
            {
                return redirect()->route('user.dangnhap')->with('warning', 'Lỗi xác thực. Xin vui lòng thử lại!');
            }
                $existingUser = NguoiDung::where('email', $user->email)->first();
                if($existingUser)
            {
            // Nếu người dùng đã tồn tại thì đăng nhập
            Auth::login($existingUser, true);
            return redirect()->route('user.home');
            }
            else
            {
                // Nếu chưa tồn tại người dùng thì thêm mới
                $newUser = NguoiDung::create([
                'name' => $user->name,
                'email' => $user->email,
                'username' => Str::before($user->email, '@'),
                'password' => Hash::make('larashop@2023'), // Gán mật khẩu tự do
            ]);
            // Sau đó đăng nhập
            Auth::login($newUser, true);
            return redirect()->route('user.home');
            }
        }
}
      
    /*
    public function getDatHangDemo() 
    { 
        // Thêm Đơn hàng demo 
        $donhang = new DonHang(); 
        $donhang->user_id = Auth::user()->id; 
        $donhang->tinhtrang_id = 1; // Lưu ý: Bảng tinhtrang phải có dữ liệu có id = 1 
        $donhang->dienthoaigiaohang = '0939011900'; 
        $donhang->diachigiaohang = '18 Ung Văn Khiêm - TP. Long Xuyên - An Giang'; 
        $donhang->save(); 
        
        // Thêm Đơn hàng chi tiết demo 
        $donhang_chitiet = new DonHang_ChiTiet(); 
        $donhang_chitiet->donhang_id = $donhang->id;
        $donhang_chitiet->sanpham_id = 1; // Lưu ý: Bảng sanpham phải có dữ liệu có id = 1 
        $donhang_chitiet->soluongban = 1; 
        $donhang_chitiet->dongiaban = 5990000; 
        $donhang_chitiet->save();

        $donhang_chitiet = new DonHang_ChiTiet(); 
        $donhang_chitiet->donhang_id = $donhang->id; 
        $donhang_chitiet->sanpham_id = 2; // Lưu ý: Bảng sanpham phải có dữ liệu có id = 2 
        $donhang_chitiet->soluongban = 1; 
        $donhang_chitiet->dongiaban = 350000; 
        $donhang_chitiet->save(); 
        
        // Gởi email 
        Mail::to(Auth::user()->email)->send(new DatHangEmail($donhang)); 
        
        return redirect()->route('frontend.dathangthanhcong');
    }
    */
