<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block !important;
        }
    </style>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Admin Categories
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.add.category') }}" class="btn btn-success pull-right">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key=> $category)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit.category', $category->slug) }}" ><i class="fa fa-edit fa-2x"></i></a>
                                            <a href="#" onclick="confirm('Are You Sure To Delete Category?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $category->id }})"><i class="ml-2 fa fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
