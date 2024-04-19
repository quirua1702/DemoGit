@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Sửa gói data</div>
        <div class="card-body">
            <form action="{{ route('admin.goidata.sua', ['id' => $goidata->id]) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="loaigoidata_id">Loại gói data</label>
                    <select class="form-select @error('loaigoidata_id') is-invalid @enderror" id="loaigoidata_id" name="loaigoidata_id" required>
                        <option value="">-- Chọn loại --</option>
                        @foreach($loaigoidata as $value)
                            <option value="{{ $value->id }}" {{ ($goidata->loaigoidata_id == $value->id) ? 'selected' : '' }}>{{ $value->tenloai }}</option>
                        @endforeach
                    </select>
                    @error('loaigoidata_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="tengoidata_id">Giá gói data</label>
                    <select class="form-select @error('tengoidata_id') is-invalid @enderror" id="tengoidata_id" name="tengoidata_id" required>
                        <option value="">-- Chọn tên gói data --</option>
                        @foreach($tengoidata as $value)
                            <option value="{{ $value->id }}" {{ ($goidata->tengoidata_id == $value->id) ? 'selected' : '' }}>{{ $value->tengoi }}</option>
                        @endforeach
                    </select>
                    @error('tengoidata_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="tengoicuoc">Tên gói data</label>
                    <input type="text" class="form-control @error('tengoicuoc') is-invalid @enderror" id="tengoicuoc" name="tengoicuoc" value="{{ $goidata->tengoicuoc }}" required />
                    @error('tengoicuoc')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

              

                <div class="mb-3">
                    <label class="form-label" for="dongia">Đơn giá</label>
                    <input type="number" min="0" class="form-control @error('dongia') is-invalid @enderror" id="dongia" name="dongia" value="{{ $goidata->dongia }}" required />
                    @error('dongia')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="hinhanh">Hình ảnh sản phẩm</label>
                    @if(!empty($goidata->hinhanh))
                        <img class="d-block rounded" src="{{ env('APP_URL') . '/storage/app/' . $goidata->hinhanh }}" width="100" />
                        <span class="d-block small text-danger">Bỏ trống nếu muốn giữ nguyên ảnh cũ.</span>
                    @endif
                    <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" value="{{ $goidata->hinhanh }}" />
                    @error('hinhanh')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="thongtingoicuoc">Thông tin gói cước</label>
                    <textarea class="form-control" id="thongtingoicuoc" name="thongtingoicuoc">{{ $goidata->thongtingoicuoc }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Cập nhật</button>
            </form>
        </div>
    </div>
@endsection    
@section('javascript') 
    <script src="{{ asset('public/vendor/ckeditor5/ckeditor.js') }}"></script> 
    <script> 
        ClassicEditor.create(document.querySelector('#thongtingoicuoc'), { 
            licenseKey: '', 
        }).then(editor => { 
            window.editor = editor; 
        }).catch(error => { 
            console.error(error); 
        }); 
    </script> 
@endsection 