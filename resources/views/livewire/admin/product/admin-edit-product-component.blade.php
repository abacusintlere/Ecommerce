<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="container" style="padding:30px 0px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Product
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.products') }}" class="btn btn-success pull-right">All Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent='update'>
                            <div class="form-group">
                                <label for="product_name" class="col-md-4 control-label">Product Name</label>
                                <div class="col-md-4">
                                    <input type="text" id="product_name" name="product_name" class="form-control input-md" placeholder="Category Name" wire:model="name" wire:keyup='generateSlug'>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="product_slug" class="col-md-4 control-label">Product Slug</label>
                                <div class="col-md-4">
                                    <input type="text" id="product_slug" name="product_slug" class="form-control input-md" placeholder="Product Slug" wire:model="slug">
                                    @error('slug') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="short_desc" class="col-md-4 control-label">Short Description</label>
                                <div class="col-md-4">
                                    <textarea type="text" id="short_desc" name="short_desc" class="form-control" placeholder="Product Slug" wire:model="short_desc"> </textarea>
                                    @error('short_desc') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="desc" class="col-md-4 control-label">Description</label>
                                <div class="col-md-4">
                                    <textarea type="text" id="desc" name="desc" class="form-control" placeholder="Product Slug" wire:model="desc"> </textarea>
                                    @error('desc') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="regular_price" class="col-md-4 control-label">Regular Price</label>
                                <div class="col-md-4">
                                    <input type="number" id="regular_price" name="regular_price" class="form-control input-md" placeholder="Regular Price" wire:model="regular_price">
                                    @error('regular_price') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sale_price" class="col-md-4 control-label">Sale Price</label>
                                <div class="col-md-4">
                                    <input type="number" id="sale_price" name="sale_price" class="form-control input-md" placeholder="Sale Price" wire:model="sale_price">
                                    @error('sale_price') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sku" class="col-md-4 control-label">Description</label>
                                <div class="col-md-4">
                                    <input type="text" id="sku" name="sku" class="form-control input-md" placeholder="SKU" wire:model="sku">
                                    @error('sku') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="stock_status" class="col-md-4 control-label">Stock Status</label>
                                <div class="col-md-4">
                                    <select id="stock_status" name="stock_status" class="form-control input-md" wire:model="stock_status">
                                        <option value="" disabled selected>Select Stock Status</option>
                                        <option value="instock">In Stock</option>
                                        <option value="outofstock">Out Stock</option>
                                    </select>
                                    @error('stock_status') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="featured" class="col-md-4 control-label">Featured</label>
                                <div class="col-md-4">
                                    <select id="is_active" name="featured" class="form-control input-md" wire:model="featured">
                                        <option value="" disabled selected>Select Feature</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @error('featured') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="quantity" class="col-md-4 control-label">Quantity</label>
                                <div class="col-md-4">
                                    <input type="number" id="quantity" name="quantity" class="form-control input-md" placeholder="Quantity" wire:model="quantity">
                                    @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="thumbnail" class="col-md-4 control-label">Product Image</label>
                                <div class="col-md-4">
                                    <input type="file" id="thumbnail" name="thumbnail" class="input-file" placeholder="Thumbnail" wire:model="newImage">

                                    @if($newImage)
                                        <img src="{{ $newImage->temporaryUrl() }}" alt="" width="220" height="220">
                                    @else
                                        <img src="{{ asset('assets/images/products/') }}{{ $thumbnail }}" alt="" srcset="">
                                    @endif
                                    @error('thumbnail') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="thumbnail" class="col-md-4 control-label">Product Gallery</label>
                                <div class="col-md-4">
                                    <input type="file" id="thumbnail" name="thumbnail" class="input-file" placeholder="Thumbnail" wire:model="newImages" multiple>

                                    @if($newImages)
                                        @foreach ($newImages as $newImage)
                                            @if ($newImage)
                                                <img src="{{ $newImage->temporaryUrl() }}" alt="" width="220" height="220">
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($images as $image)
                                            @if ($image)
                                                <img src="{{ asset('assets/images/products/') }}{{ $image }}" alt="" srcset="">
                                            @endif
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category" class="col-md-4 control-label">Product Category</label>
                                <div class="col-md-4">
                                    <select id="category" name="category" class="form-control input-md" wire:model="category">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="is_active" class="col-md-4 control-label">Product Status</label>
                                <div class="col-md-4">
                                    <select id="is_active" name="is_active" class="form-control input-md" wire:model="is_active">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                    @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Save Product</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TinyMCE --}}
@push('scripts')
    <script>
        $(function(){
            // For Short Description
            tinymce.init({
                selector: '#short_desc',
                setup:function(editor){
                    editor.on('change', function(e){
                        tinyMCE.triggerSave();
                        var short_desc = $('#short_desc').val();
                        @this.set('short_desc', short_desc);
                    });
                }
            });

            // For Long Description
            tinymce.init({
                selector: '#desc',
                setup:function(editor){
                    editor.on('change', function(e){
                        tinyMCE.triggerSave();
                        var desc = $('#desc').val();
                        @this.set('desc', desc);
                    });
                }
            });
        });
    </script>
@endpush