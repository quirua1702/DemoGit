@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Sửa giá gói data</div>
        <div class="card-body">
            <form action="{{ route('admin.tengoidata.sua', ['id' => $tengoidata->id]) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="tengoi">Tên gói</label>
                    <input type="text" class="form-control @error('tengoi') is-invalid @enderror" id="tengoi" name="tengoi" value="{{ $tengoidata->tengoi }}" required />
                    @error('tengoi')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Cập nhật</button>
            </form>
        </div>
    </div>
@endsection
   