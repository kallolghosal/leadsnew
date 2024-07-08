@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col">
                Total Leads: {{ $count }}
            </div>
            <div class="col">
                <div class="input-group ms-auto">
                    <input type="text" class="form-control" placeholder="From" id="strt" aria-label="From">
                    <span class="input-group-text"><-></span>
                    <input type="text" class="form-control" placeholder="To" id="endt" aria-label="To">
                    <input type="hidden" name="token" value="markt" id="token">
                    <button type="button" class="btn btn-success" id="exprt">Export as CSV</button>
                </div>
                @if(session('error'))
                    <p class="text-danger">{{ session('error') }}</p>
                @endif
            </div>
        </div>
        <table class="table table-success table-striped mt-4">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Pl</td>
                    <td>Exporting</td>
                    <td>Ecomm exp</td>
                    <td>Enterprise</td>
                    <td>Business name</td>
                    <td>State</td>
                    <td>City</td>
                    <td>Date</td>
                </tr>
            </thead>
            @foreach ($leads as $lead)
            <tr>
                <td>{{$lead->id}}</td>
                <td>{{$lead->platform}}</td>
                <td>{{$lead->exporting}}</td>
                <td>{{$lead->ecommexp}}</td>
                <td>{{$lead->enterprise}}</td>
                <td>{{$lead->business_name}}</td>
                <td>{{$lead->state}}</td>
                <td>{{$lead->city}}</td>
                <td>{{$lead->created_at}}</td>
            </tr>
            @endforeach
        </table>
        {!! $leads->withQueryString()->links('pagination::bootstrap-5') !!}
        
    </div>
</div>
@endsection