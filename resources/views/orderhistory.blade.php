@extends('layouts.app')
@section('content')
@push('style_css')
<style>
.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.pagination {
    display: inline-block!important;
}
.pagination li a {
    height: 38px;
    line-height: 17px;
}
</style>
@endpush
@if(Session::has('success'))
    <div class="alert alert-primary mt-2">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    {{Session::get('success')}}
    </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger mt-2">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        {{Session::get('error')}}
        </div>
    @endif
    <div class="page section-header text-center mb-0">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Order History</h1></div>
        </div>
    </div>
        <br/>
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
        <!-- Account page navigation-->
        {{-- <hr class="mt-0 mb-4"> --}}
        <!-- Payment methods card-->
        {{-- <div class="card card-header-actions mb-4">
            <div class="card-header">
                Payment Methods
                <button class="btn btn-sm btn-primary" type="button">Add Payment Method</button>
            </div>
            <div class="card-body px-0">
                <!-- Payment method 1-->
                <div class="d-flex align-items-center justify-content-between px-4">
                    <div class="d-flex align-items-center">
                         <i class="fab fa-cc-visa fa-2x cc-color-visa"></i>
                        <div class="ms-4">
                            <div class="small">Visa ending in 1234</div>
                            <div class="text-xs text-muted">Expires 04/2024</div>
                        </div>
                    </div>
                    <div class="ms-4 small">
                        <div class="badge bg-light text-dark me-3">Default</div>
                        <a href="#!">Edit</a>
                    </div>
                </div>
                <hr>
                <!-- Payment method 2-->
                <div class="d-flex align-items-center justify-content-between px-4">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-cc-mastercard fa-2x cc-color-mastercard"></i>
                        <div class="ms-4">
                            <div class="small">Mastercard ending in 5678</div>
                            <div class="text-xs text-muted">Expires 05/2022</div>
                        </div>
                    </div>
                    <div class="ms-4 small">
                        <a class="text-muted me-3" href="#!">Make Default</a>
                        <a href="#!">Edit</a>
                    </div>
                </div>
                <hr>
                <!-- Payment method 3-->
                <div class="d-flex align-items-center justify-content-between px-4">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-cc-amex fa-2x cc-color-amex"></i>
                        <div class="ms-4">
                            <div class="small">American Express ending in 9012</div>
                            <div class="text-xs text-muted">Expires 01/2026</div>
                        </div>
                    </div>
                    <div class="ms-4 small">
                        <a class="text-muted me-3" href="#!">Make Default</a>
                        <a href="#!">Edit</a>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Billing history card-->
        <div class="card mb-4">
            <div class="card-header">Billing History</div>
            <div class="card-body p-0">
                <!-- Billing history table-->
                <div class="table-responsive table-billing-history">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="border-gray-200" scope="col">@sortablelink('order_id', 'Order ID')</th>
                                <th class="border-gray-200" scope="col">@sortablelink('created_at','Date')</th>
                                <th class="border-gray-200" scope="col">Amount</th>
                                <th class="border-gray-200" scope="col">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $item)
                            @foreach ($item->payment as $val)
                            @foreach ($item->cancell as $tt)
                            @php
                            $data = $tt->order_id;
                            $cancel = Carbon\Carbon::parse($val->created_at)->format('F j, Y');
                            @endphp
                            @endforeach
                            @endforeach
                            <tr>
                                <td>#{{ $val->order_id ?? ''}}</td>
                                <td>{{ $val->created_at ?? ''}}</td>
                                <td>${{ number_format($val->price, 2) ?? ''}}</td>
                                @if ($data == $val->order_id)
                                <td><span class="badge bg-light text-danger">Cancelled</span></td>
                                @else
                                <td><span class="badge bg-light text-dark">Pending</span></td>
                                @endif
                                <td><a href="{{ route('orderview', $item->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>
                            @empty
                            <td colspan="4">No orders found.</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {!! $orders->links() !!}
</div>    
@endsection