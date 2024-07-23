@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h4>Uploaded files</h4>
        <table class="table table-success table-striped mt-4">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>File</td>
                    <td>Date</td>
                    <td>Download File</td>
                </tr>
            </thead>
            @foreach ($files as $file)
            <tr>
                <td>{{$file->id}}</td>
                <td>{{$file->name}}</td>
                <td>{{$file->created_at}}</td>
                <td><a href="{{ route('getfile', $file->id) }}">Download</a></td>
            </tr>
            @endforeach
        </table>
        {!! $files->withQueryString()->links('pagination::bootstrap-5') !!}
        
    </div>
</div>
@endsection