<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="container" style="padding:30px 0px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel heading">
                        <div class="row">
                            <div class="col-md-6">
                                Update Category
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.coupons') }}" class="btn btn-success pull-right">All Coupons</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent='update'>
                            <div class="form-group">
                                <label for="coupon_code" class="col-md-4 control-label">Coupon Code</label>
                                <div class="col-md-4">
                                    <input type="text" id="coupon_code" name="coupon_code" class="form-control input-md" placeholder="Coupon Code" wire:model="coupon_code" >
                                    @error('coupon_code') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="coupon_type" class="col-md-4 control-label">Coupon Type</label>
                                <div class="col-md-4">
                                    <select name="coupon_type" id="coupon_type" class="form-control input-md" wire:model="coupon_type">
                                        <option value="" disabled selected>Select Coupon Type</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percent">Percent</option>
                                    </select>
                                    @error('coupon_type') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="coupon_value" class="col-md-4 control-label">Coupon Value</label>
                                <div class="col-md-4">
                                    <input type="text" id="coupon_value" name="coupon_value" class="form-control input-md" placeholder="Coupon Value" wire:model="coupon_value">
                                    @error('coupon_value') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cart_value" class="col-md-4 control-label">Coupon Value</label>
                                <div class="col-md-4">
                                    <input type="text" id="cart_value" name="cart_value" class="form-control input-md" placeholder="Cart Value" wire:model="cart_value">
                                    @error('cart_value') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="expiry_date" class="col-md-4 control-label">Expiry Date</label>
                                <div class="col-md-4">
                                    <input type="text" id="expiry_date" name="expiry_date" class="form-control input-md" placeholder="Cart Value" wire:model="expiry_date">
                                    @error('expiry_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Update Coupon</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(function(){
            $('#expiry_date').datetimepicker({
                format: "Y-MM-DD"
            })
            .on('dp.change', function(){
                var date = $('#expiry_date').val();
                @this.set('expiry_date', date)
            });
        });
    </script>
@endpush