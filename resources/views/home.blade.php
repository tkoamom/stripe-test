@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Current subscription</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price ($ per month)</th>
                                <th scope="col">Start date</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($subscription)
                            <tr>
                                <td>{{$subscription->plan->name}}</td>
                                <td>{{$subscription->plan->price}}</td>
                                <td>{{$subscription->plan->created_at}}</td>
                                <td><button id="unsubscribe" type="button" class="btn btn-danger">Unsubscribe</button></td>
                            </tr>
                        @else
                            <tr>
                                <td>none</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#unsubscribe').click(function (){
        console.log('111')
    });
</script>
@endsection
