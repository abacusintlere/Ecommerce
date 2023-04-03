<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                Change Password
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="#" class="form-horizontal" wire:submit.prevent='changePassword'>
                            @if (Session::has('password_success'))
                                <div class="alert alert-success" role="alert">{{ Session::get('password_success') }}</div>
                            @endif

                            @if (Session::has('password_error'))
                                <div class="alert alert-danger" role="alert">{{ Session::get('password_error') }}</div>
                            @endif
                            <div class="form-group">
                                <label for="current_password" class="col-md-4 control-label">Current Password</label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control input-md" placeholder="Current Password" name="current_password" id="current_password" wire:model='current_password'>
                                    @error('current_password') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">New Password</label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control input-md" placeholder="New Password" name="password" id="password" wire:model='password'>
                                    @error('password') <p class="text-danger">{{ $message }}</p>@enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="col-md-4 control-label">Confirm Password</label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control input-md" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" wire:model='password_confirmation'>
                                    @error('password_confirmation') <p class="text-danger">{{ $message }}</p>@enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-info btn-sm">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
