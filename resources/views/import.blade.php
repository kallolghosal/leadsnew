@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Import CSV</h2>
            <form action="{{route('show-csv')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="owner" value="wv" id="wv" checked>
                    <label class="form-check-label" for="wv">
                        WV
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="owner" value="cac" id="cac">
                    <label class="form-check-label" for="cac">
                        CAC
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="owner" id="markt" value="markt">
                    <label class="form-check-label" for="markt">
                        WV Market
                    </label>
                </div>
                <br /><br />
                <label for="csvfile">Select CSV file to upload</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="file" aria-describedby="inputGroupFileAddon04" name="file" aria-label="Upload">
                    @error('file')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <input class="btn btn-success" value="Upload" type="submit" id="inputGroupFileAddon04">
                </div>
            </form>
            @if (session('status'))
                <h4>{{ session('status') }}</h4>
            @endif
        </div>
        <div class="col-md-6">
        
        </div>
    </div>
    
</div>
@endsection