@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Gói Data</div>
        <div class="card-body table-responsive">
            <p>
                <a href="{{ route('admin.goidata.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
                <a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fa-light fa-upload"></i> Nhập từ Excel</a>
                <a href="{{ route('admin.goidata.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất ra Excel</a>
            </p>          
            <table class="table table-bordered table-hover table-sm mb-3">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Hình ảnh</th>
                        <th >Loại gói data</th>
                        <th >Tên gói cước</th>
                        <th >Đơn giá</th>
                        <th >Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($goidata as $gd)
                        <tr>
                            <td>{{ $loop->index + $goidata->firstItem() }}</td>
                            <td class="text-center"><img src="{{ env('APP_URL') . '/storage/app/' . $gd->hinhanh }}" width="80" class="img-thumbnail" /></td>
                            <td>{{ $gd->LoaiGoiData->tenloai }}</td>
                            <td>{{ $gd->tengoicuoc }}</td>                
                            <td class="text-end">{{ number_format($gd->dongia) }}</td>
                            <td class="text-center"><a href="{{ route('admin.goidata.sua', ['id' => $gd->id]) }}"><i class="bi bi-pencil-square"></i>sửa</a></td>
                            <td class="text-center"><a href="{{ route('admin.goidata.xoa', ['id' => $gd->id]) }}"><i class="bi bi-trash text-danger"></i>xóa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $goidata->links()}}  
        </div>
    </div>

    <form action="{{ route('admin.goidata.nhap') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-0">
                            <label for="file_excel" class="form-label">Chọn tập tin Excel</label>
                            <input type="file" class="form-control" id="file_excel" name="file_excel" required />
                        </div>
                    </div>

                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-light fa-times"></i> Hủy bỏ</button>
                        <button type="submit" class="btn btn-danger"><i class="fa-light fa-upload"></i> Nhập dữ liệu</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection