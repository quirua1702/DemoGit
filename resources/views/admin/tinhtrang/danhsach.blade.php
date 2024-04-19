@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Tình trạng</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('admin.tinhtrang.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm mới</a></p>
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">#</th>
                        <th class="text-center" width="85%">Tên tình trạng</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tinhtrang as $value)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $value->tinhtrang }}</td>
                            <td class="text-center"><a href="{{ route('admin.tinhtrang.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>sửa</a></td>
                            <td class="text-center"><a href="{{ route('admin.tinhtrang.xoa', ['id' => $value->id]) }}"><i class="bi bi-trash text-danger"></i>xóa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection