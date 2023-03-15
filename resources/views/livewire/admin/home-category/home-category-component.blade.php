<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="container" style="padding:30px 0px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel heading">
                        Manage Home Categories
                    </div>
                    <div class="panel panel-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent='update'>

                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Choose Categories</label>
                                <div class="col-md-4">
                                    <select name="categories[]" id="categories" class="form-control sel-categories" wire:model="selected_categories">
                                        <option value="" disabled selected>Select Category</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @empty
                                            <option value="">No Category Found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nos_products" class="col-md-4 control-label">No of Products</label>
                                <div class="col-md-4">
                                    <input type="text" id="nos_products" name="nos_products" class="form-control input-md" placeholder="No of Products" wire:model="no_of_products">
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
            $('.sel-categories').select2();
            // On Home Category Change
            $('.sel-categories').on('change', function(e){
                data = $('.sel-categories').select2('val');
                @this.set('selected_categories', data);
            });
        });
    </script>
@endpush