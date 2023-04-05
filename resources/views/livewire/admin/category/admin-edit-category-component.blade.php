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
                                <a href="{{ route('admin.categories') }}" class="btn btn-success pull-right">All Categories</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent='update'>
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label">Category Name</label>
                                <div class="col-md-4">
                                    <input type="text" id="category_name" name="category_name" class="form-control input-md" placeholder="Category Name" wire:model="name" wire:keyup='generateSlug'>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_slug" class="col-md-4 control-label">Category Slug</label>
                                <div class="col-md-4">
                                    <input type="text" id="category_slug" name="category_slug" class="form-control input-md" placeholder="Category Slug" wire:model="slug">
                                    @error('slug') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="parent_category" class="col-md-4 control-label">Parent Category</label>
                                <div class="col-md-4">
                                    <select name="parent_category" id="parent_category" class="form-control input-md" wire:model="parent_category">
                                        <option value="null" selected>None</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $category_id ? "selected" : "" }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_category') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="is_active" class="col-md-4 control-label">Category Status</label>
                                <div class="col-md-4">
                                    <select name="is_active" id="is_active" class="form-control input-md" wire:model="is_active">
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
                                    <button type="submit" class="btn btn-primary">Update Category</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
