@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Thêm giá gói data</div>
        <div class="card-body">
            <form action="{{ route('admin.tengoidata.them') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="tengoi">Tên gói data</label>
                    <input type="text" class="form-control @error('tengoi') is-invalid @enderror" id="tengoi" name="tengoi" value="{{ old('tengoi') }}" required />
                    @error('tengoi')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

               

                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Thêm vào CSDL</button>
            </form>
        </div>
    </div>
@endsection