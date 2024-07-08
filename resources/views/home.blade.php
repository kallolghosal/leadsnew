@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card mt-4">
                <div class="card-header">{{ __('WV Leads') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Total no of WV leads {{ $leads->count() }}</h4>
                    <a href="{{ route('wv-leads') }}" class="btn btn-primary btn-sm">View Leads</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card">
                <div class="card-header">{{ __('WV Market Leads') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Total no of WV Market leads {{ $mrktleads->count() }}</h4>
                    <a href="{{ route('wvmarket-leads') }}" class="btn btn-primary btn-sm">View Leads</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card">
                <div class="card-header">{{ __('CAC Leads') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Total no of CAC leads {{ $cacleads->count() }}</h4>
                    <a href="{{ route('cac-leads') }}" class="btn btn-primary btn-sm">View Leads</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
