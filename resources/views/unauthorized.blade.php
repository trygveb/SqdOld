@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="card">

                <div class="card-body">
                    {{__("Sorry, something went wrong")}}.<br>
                    {{__("You are not supposed to arrive here from domain")}} {{$domain}}
                </div>
            </div>
    </div>
</div>
@endsection
