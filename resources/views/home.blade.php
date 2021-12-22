@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Please select application <a class="aMain" href="{{ route('calls.guest',[]) }}"> SdCalls </a>
                    or
                    <a class="aMain" href="{{ route('schema.guest',[]) }}"> SdSchema!</a>
                </div>
            </div>
    </div>
</div>
@endsection
