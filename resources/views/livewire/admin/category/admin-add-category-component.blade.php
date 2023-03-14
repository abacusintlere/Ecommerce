<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="container" style="padding:30px 0px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Category
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
                        <form class="form-horizontal" wire:submit.prevent='store'>
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label">Category Name</label>
                                <div class="col-md-4">
                                    <input type="text" id="category_name" name="category_name" class="form-control input-md" placeholder="Category Name" wire:model="name" wire:keyup='generateSlug'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_slug" class="col-md-4 control-label">Category Slug</label>
                                <div class="col-md-4">
                                    <input type="text" id="category_slug" name="category_slug" class="form-control input-md" placeholder="Category Slug" wire:model="slug">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Category Status</label>
                                <div class="col-md-4">
                                    <select name="status" id="status" class="form-control input-md" wire:model="status">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Save Category</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
