@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="card">

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{ __('Please select application') }} <a class="aMain" href="{{ route('sdCalls.guest',[]) }}"> SdCalls </a>
                    {{ __('or')}}
                    <a class="aMain" href="{{ route('sdSchema.guest',[]) }}"> SdSchema!</a>
                </div>
            </div>
    </div>
</div>
@endsection
