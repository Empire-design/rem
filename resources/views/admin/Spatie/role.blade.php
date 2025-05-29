<!DOCTYPE html>
<html>
@include('admin.css')

<body>
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
                            <div class="title"><strong class="d-block">Add Role has Permission</strong></div>
                            <div class="block-body">
                                @session('status')
                                    <div class="alert alert-success">
                                        {{ session()->get('status') }}
                                    </div>
                                @endsession
                                <form action="{{ route('admin.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-control-label">Role Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Role Name" required>
                                    </div>

                                    <strong>
                                        <h5>Assign Permission</h5>
                                    </strong><br><br>

                                    @foreach (\Spatie\Permission\Models\Permission::all() as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input btn btn-warning" type="checkbox"
                                                name="permissions[]" value="{{ $permission->name }}"
                                                id="_perm{{ $permission->id }}">
                                            <label class="form-check-label" for="_perm{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <br>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </form>

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
