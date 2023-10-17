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
                                <td><button id="unsubscribe" type="button" class="btn btn-danger" data-name="{{$subscription->name}}">Unsubscribe</button></td>
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
            <div class="card">
                <div class="card-header">Last Invoices</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Stripe_id</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($invoices)
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->stripe_id}}</td>
                                    <td>{{$invoice->total}}</td>
                                    <td>{{$invoice->status}}</td>
                                    <td>{{$invoice->created_at}}</td>
                                </tr>
                            @endforeach
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
        let subscriptionName = $(this).data('name');
        $.ajax({
            url: 'subscription/cansel',
            data: {
                "_token": "{{ csrf_token() }}",
                'subscriptionName' : subscriptionName
            },
            type: 'POST',
            success: function (response)
            {
                console.log(response);
            },
            error: function (response)
            {
                console.log(response);
            }
        })
    });
</script>
@endsection
