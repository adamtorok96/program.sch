@extends('admin.layouts.layout')
@section('title', 'Programok')
@section('subtitle', 'Új program felvétele')
@section('icon', 'calendar')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <form method="post" action="{{ route('admin.programs.store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label name="circle">Kör:</label>
                    <select name="circle" id="circle" class="form-control">
                        @foreach($resorts as $resort)
                            <optgroup label="{{ $resort->name }}">
                                @foreach($resort->circles as $circle)
                                    <option value="{{ $circle->id }}">{{ $circle->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </form>

        </div>
    </div>
@endsection