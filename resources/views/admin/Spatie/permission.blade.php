<!DOCTYPE html>
<html>
@include('admin.css')

<body>
    {{-- @include('sweetalert2::index') --}}
    @include('admin.header')
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Basic forms</h2>
            </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
            @include('admin.sessionMessaage')
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Basic forms </li>
            </ul>
        </div>
        <section class="no-padding-top">
            <div class="container-fluid">
                <div class="row">
                    <!-- Basic Form-->
                    <div class="col-lg-6">
                        <div class="block">
                            <div class="title"><strong class="d-block">Permission Form</strong><span
                                    class="d-block"></div>
                            <div class="block-body">
                                <form id="id" action="{{ route('admin.storepermission') }}" method="POST">
                                    
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input type="text" placeholder="Enter Name" name="name"
                                            class="form-control">
                                    </div>
                                    

                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                </form>
                                {{-- <form action="{{ route('admin.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-control-label">Role Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Role Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Permissions</label>
                                        <div class="row">
                                            @foreach ($permissions->chunk(1) as $chunk)
                                                <div class="col-md-4">
                                                    @foreach ($chunk as $permission)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="permission[]" value="{{ $permission->id }}"
                                                                id="perm_{{ $permission->id }}">
                                                            <label class="form-check-label"
                                                                for="perm_{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </form> --}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    </section>
    @include('admin.footer')
    </div>
    </div>
    @include('admin.js')
    <!-- JavaScript files-->
</body>

</html>
