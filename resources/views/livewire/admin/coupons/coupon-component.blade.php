<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block !important;
        }
    </style>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Admin Coupons
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.add.coupon') }}" class="btn btn-success pull-right">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Coupon Value</th>
                                    <th>Cart Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $key=> $coupon)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->type=='fixed' ? "$".$coupon->value : $coupon->value."%" }}</td>
                                        <td>{{ $coupon->value }}</td>
                                        <td>{{ $coupon->cart_value }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit.coupon', $coupon->id) }}" ><i class="fa fa-edit fa-2x"></i></a>
                                            <a href="#" onclick="confirm('Are You Sure To Delete Coupon?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $coupon->id }})"><i class="ml-2 fa fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
