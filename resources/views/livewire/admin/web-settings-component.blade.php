<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                Website Settings
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="#" class="form-horizontal" wire:submit.prevent='updateWebSettings'>
                            @if (Session::has('settings_success'))
                                <div class="alert alert-success" role="alert">{{ Session::get('settings_success') }}</div>
                            @endif

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email Address</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Email Address" name="email" id="email" wire:model='email'>
                                    @error('email') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Phone</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Phone" name="phone" id="current_password" wire:model='phone'>
                                    @error('phone') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone2" class="col-md-4 control-label">Phone</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Phone 2" name="phone2" id="phone2" wire:model='phone2'>
                                    @error('phone2') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Address</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Address" name="address" id="address" wire:model='address'>
                                    @error('address') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="twitter" class="col-md-4 control-label">Twitter</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Twitter" name="twitter" id="twitter" wire:model='twitter'>
                                    @error('twitter') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="facebook" class="col-md-4 control-label">Facebook</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="facebook" name="Facebook" id="facebook" wire:model='map'>
                                    @error('facebook') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pinterest" class="col-md-4 control-label">Pinterest</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Pinterest" name="pinterest" id="pinterest" wire:model='pinterest'>
                                    @error('pinterest') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="instagram" class="col-md-4 control-label">Instagram</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Instagram" name="instagram" id="instagram" wire:model='instagram'>
                                    @error('instagram') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="youtube" class="col-md-4 control-label">Youtube</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Youtube" name="youtube" id="youtube" wire:model='youtube'>
                                    @error('youtube') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-info btn-sm">Update Settings</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
