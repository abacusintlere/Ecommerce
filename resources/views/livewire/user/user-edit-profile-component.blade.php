<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="container" style="padding:30px 0px;">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    My Profile
                </div>
                <div class="panel-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                    @endif
                    <form action="#" wire:submit.prevent='updateProfile'>
                        <div class="col-md-4">
                            @if ($newimage)
                                <img src="{{ $newimage->temporaryUrl() }}" alt="{{ $user->name }}" width="100%">
                            @elseif ($image)
                                <img src="{{ asset('assets/images/profiles') }}/{{ $image }}" alt="{{ $user->name }}" width="100%">
                            @else
                                <img src="{{ asset('assets/images/profiles/default.png') }}" alt="{{ $user->name }}" width="100%">
                            @endif

                            <input type="file" class="form-control" name="newimage" id="newimage" wire:model='newimage' style="margin:30px 0px;">
                        </div>

                        <div class="col-md-8">
                            <p><b>Name</b> <input type="text" class="form-control" name="name" id="name" wire:model='name'></p>
                            <p><b>Email</b> <input type="text" class="form-control" name="email" id="email" wire:model='email'></p>
                            <p><b>Mobile</b> <input type="text" class="form-control" name="mobile" id="mobile" wire:model='mobile'></p>
                            <hr>
                            <p><b>Line1</b> <input type="text" class="form-control" name="line1" id="line1" wire:model='line1'></p>
                            <p><b>Line2</b> <input type="text" class="form-control" name="line2" id="line2" wire:model='line2'></p>
                            <p><b>City</b> <input type="text" class="form-control" name="city" id="city" wire:model='city'></p>
                            <p><b>Province</b> <input type="text" class="form-control" name="province" id="province" wire:model='province'></p>
                            <p><b>Country</b> <input type="text" class="form-control" name="country" id="country" wire:model='country'></p>
                            <p><b>Zipcode</b> <input type="text" class="form-control" name="zipcode" id="zipcode" wire:model='zipcode'></p>

                            <button type="submit" class="btn btn-info pull-right">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
