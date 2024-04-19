@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Loại gói data</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('admin.loaigoidata.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm mới</a></p>
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">#</th>
                        <th class="text-center" width="45%">Tên loại</th>
                        <th class="text-center" width="40%">Tên loại không dấu</th>
                        <th class="text-center" width="5%">Sửa</th>
                        <th class="text-center" width="5%">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loaigoidata as $value)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $value->tenloai }}</td>
                            <td class="text-center">{{ $value->tenloai_slug }}</td>
                            <td class="text-center"><a href="{{ route('admin.loaigoidata.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>sửa</a></td>
                            <td class="text-center"><a href="{{ route('admin.loaigoidata.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa loại gói data {{ $value->tenloai }}  không ?')"  ><i class="bi bi-trash text-danger"></i>xóa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection