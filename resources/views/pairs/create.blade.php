@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_style.css') }}">
@endsection
@section('content')
    <form action="{{ route('pairs.store') }}" method="post">
        @csrf
        <h4 class="e1 text-center">Add Pair    </h4>
        <span class="daimond"></span>
        <div class="row" style="height: 57px;">
            <div class="col">
            {{--<input type="text" class="form-control" placeholder="Name" name="name">--}}
                <select name="from_id" class="form-control">
                    <option selected disabled>
                        From:
                    </option>
                    @foreach($currencies as $currency)
                        @if($currency->id == old('from_id'))
                            <option value="{{ $currency->id }}" selected>
                                {{ $currency->currency_name }}
                            </option>
                        @else
                            <option value="{{ $currency->id }}">
                                {{ $currency->currency_name }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @if ( $errors->has('from_id'))
                    <span style="display: block;" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('from_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col">
                <select name="to_id" class="form-control">
                    <option selected disabled>
                        To:
                    </option>
                    @foreach($currencies as $currency)
                        @if($currency->id == old('to_id'))
                            <option value="{{ $currency->id }}" selected>
                                {{ $currency->currency_name }}
                            </option>
                        @else
                            <option value="{{ $currency->id }}">
                                {{ $currency->currency_name }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @if ( $errors->has('to_id'))
                    <span style="display: block;" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('to_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <br>
        <div class="row" style="height: 57px;">
            <div class="col">
                <input value="{{ old('duration') }}"  type="text" class="form-control" placeholder="Duration" name="duration">
                @if ( $errors->has('duration'))
                    <span style="display: block;" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col">
                <input value="{{ old('exchange_rate') }}"  type="text" class="form-control" placeholder="Exchange Ratio" name="exchange_rate">
                @if ( $errors->has('exchange_rate'))
                    <span style="display: block;" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('exchange_rate') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <br>
        <input type="hidden" value="addUser" name="submit">
        <button class="btn btn-dark submit" type="submit">
            <i class="fa fa-submit">
                Submit
            </i>
        </button>
    </form>


@endsection
@section('js')

@endsection
