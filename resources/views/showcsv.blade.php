@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2>CSV file contains following Data</h2>

            @if ($owner === 'wv')
                <table class="table">
                @foreach ($csv as $v)
                @if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $v['phone']))
                <tr class="text-danger">
                @else
                <tr>
                @endif
                    <td>{{ $v['platform'] }}</td>
                    <td>{{ $v['business_name'] }}</td>
                    <td>{{ $v['full_name'] }}</td>
                    <td>{{ $v['business_sector'] }}</td>
                    <td>{{ $v['state'] }}</td>
                    <td>{{ $v['city'] }}</td>
                    <td>{{ $v['phone'] }}</td>
                    <td>{{ $v['email'] }}</td>
                </tr>
                @endforeach
                </table>
            @elseif ($owner === 'cac')
                <table class="table">
                @foreach ($csv as $v)
                @if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $v['phone']))
                <tr class="text-danger">
                @else
                <tr>
                @endif
                <td>{{ $v['form'] }}</td>
                <td>{{ $v['platform'] }}</td>
                <td>{{ $v['state'] }}</td>
                <td>{{ $v['city'] }}</td>
                <td>{{ $v['full_name'] }}</td>
                <td>{{ $v['company'] }}</td>
                <td>{{ $v['phone'] }}</td>
                <td>{{ $v['email'] }}</td>
                </tr>
                @endforeach
                </table>
            @else
                <table class="table">
                @foreach ($csv as $v)
                    @if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $v['phone']))
                    <tr class="text-danger">
                    @else
                    <tr>
                    @endif
                    <td>{{ $v['platform'] }}</td>
                    <td>{{ $v['exporting'] }}</td>
                    <td>{{ $v['state'] }}</td>
                    <td>{{ $v['city'] }}</td>
                    <td>{{ $v['full_name'] }}</td>
                    <td>{{ $v['experience'] }}</td>
                    <td>{{ $v['phone'] }}</td>
                    <td>{{ $v['email'] }}</td>
                    </tr>
                @endforeach
                </table>
            @endif
            <a href="{{ route('store-file', ['name' => $name, 'owner' => $owner]) }}" class="btn btn-primary">Save Data</a> &nbsp; 
            <a href="{{ route('import-csv') }}" class="btn btn-primary">Cancel</a>
            @if (session('status'))
                <h4>{{ session('status') }}</h4>
            @endif
        </div>
        <div class="col-md-2">
            
        </div>
    </div>
    
</div>
@endsection