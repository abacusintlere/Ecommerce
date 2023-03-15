<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="container" style="padding:30px 0px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel heading">
                        Manage Sale Settings
                    </div>
                    <div class="panel panel-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent='update'>

                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Select Sale Date</label>
                                <div class="col-md-4">
                                    <input type="text" id="sale-date" class="form-control input-md" placeholder="YYYY/MM/DD H:M:S" wire:model="sale_date">
                                    @error('sale_date') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Sale Status</label>
                                <div class="col-md-4">
                                    <select name="status" id="status" class="form-control input-md" wire:model="status">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
        $(document).ready(function(){
            $('#sale-date').datetimepicker({
                format : "Y-MM-DD h:m:s",
            })
            .on('dp.change', function(ev){
                var data = $('#sale-date').val();
                @this.set('sale_date', data);
            });
            // On Home Category Change
            $('.sel-categories').on('change', function(e){
                data = $('.sel-categories').select2('val');
                @this.set('selected_categories', data);
            });
        });
    </script>
@endpush