<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="container" style="padding:30px 0px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Slider
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.sliders') }}" class="btn btn-success pull-right">All Sliders</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent='store'>
                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">Title</label>
                                <div class="col-md-4">
                                    <input type="text" id="title" name="title" class="form-control input-md" placeholder="Title" wire:model="title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subtitle" class="col-md-4 control-label">Subtitle</label>
                                <div class="col-md-4">
                                    <input type="text" id="subtitle" name="subtitle" class="form-control input-md" placeholder="Subtitle" wire:model="subtitle">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">Price</label>
                                <div class="col-md-4">
                                    <input type="text" id="price" name="price" class="form-control input-md" placeholder="Price" wire:model="price">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="link" class="col-md-4 control-label">Link</label>
                                <div class="col-md-4">
                                    <input type="text" id="link" name="link" class="form-control input-md" placeholder="Link" wire:model="link">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-md-4 control-label">Image</label>
                                <div class="col-md-4">
                                    <input type="text" id="image" name="image" class="form-control input-md" placeholder="Image" wire:model="image">
                                    @if($image)
                                        <img src="{{ $image->temporaryUrl() }}" alt="" width="220" height="220">
                                    @endif
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
                                    <button type="submit" class="btn btn-primary">Save Slider</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
