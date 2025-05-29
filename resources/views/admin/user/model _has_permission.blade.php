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
                <li class="breadcrumb-item active">Add Model has Permission </li>
            </ul>
        </div>
        <section class="no-padding-top">
            <div class="container-fluid">
                <div class="row">
                    <!-- Basic Form-->
                    <div class="col-lg-6">
                        <div class="block">
                            <div id="id" class="title"><strong class="d-block">Add Model Has
                                    Permission</strong><span class="d-block"></span></div>
                            <div class="block-body">
                                <form id="id" action="{{ route('user.addmodel_has_permission') }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input type="text" placeholder="Enter Name" name="name"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input type="email" placeholder="Enter Email Address" name="email"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="roles">Permission</label>
                                        <select name="permissions[]" id="permissions" class="form-control">
                                            <option value="">Select Permissions</option>
                                            @foreach (\Spatie\Permission\Models\Permission::all() as $permissions)
                                                <option value="{{ $permissions->name }}">{{ $permissions->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Password</label>
                                        <input type="password" placeholder="Enter Password" name="password"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
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

<script>
    $(document).ready(function() {
        $('#id').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: '{{ route('user.add') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response) {
                        alert("Successfully added");
                        window.location.href = '{{ route('user.add') }}';
                    } else {
                        alert("Failed to add");
                    }
                },
                error: function(error) {
                    console.log(error.responseText);
                    alert("Something went wrong!");
                }
            });
        });
    });
</script>
