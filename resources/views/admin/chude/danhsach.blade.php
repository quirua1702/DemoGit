@extends('layouts.app') 
 
@section('content') 
    <div class="card"> 
        <div class="card-header">Chủ đề</div> 
        <div class="card-body table-responsive"> 
            <p><a href="{{ route('admin.chude.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a></p> 
            <table class="table table-bordered table-hover table-sm mb-0"> 
                <thead> 
                    <tr> 
                        <th class="text-center" width="5%">#</th> 
                        <th class="text-center" width="45%">Tên chủ đề</th> 
                        <th class="text-center" width="40%">Tên chủ đề không dấu</th> 
                        <th class="text-center" width="5%">Sửa</th> 
                        <th class="text-center" width="5%">Xóa</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    @foreach($chude as $value) 
                        <tr> 
                            <td class="text-center">{{ $loop->iteration }}</td> 
                            <td class="text-center">{{ $value->tenchude }}</td> 
                            <td class="text-center">{{ $value->tenchude_slug }}</td> 
                            <td class="text-center"><a href="{{ route('admin.chude.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i>sửa</a></td>
                            <td class="text-center"><a href="{{ route('admin.chude.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa chủ đề {{ $value->tenchude }} không?')"><i class="bi bi-trash text-danger"></i>xóa</a></td>
                        </tr> 
                    @endforeach 
                </tbody> 
            </table> 
        </div> 
    </div> 
@endsection 