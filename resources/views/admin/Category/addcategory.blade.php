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
                            <div class="title"><strong class="d-block">Basic Form</strong><span class="d-block">Lorem
                                    ipsum dolor sit amet consectetur.</span></div>
                            <div class="block-body">
                                <form id="id" action="{{ route('category.add') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input type="text" placeholder="Enter Name" name="name"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="categorytype">Categorytype</label>
                                        <select name="categorytype" id="categorytype" class="form-control">
                                            <option value="blog">Blog</option>
                                            <option value="product">Product</option>
                                        </select>
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
                url: '{{ route('category.add') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response) {
                        alert("Successfully added");
                        window.location.href = '{{ route('admin.viewcategory') }}';
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






















{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
{{-- <script>
    Swal::fire([
        'title' => 'success',
        'text' => 'Category has been updated',
        'icon' => 'success',
        'confirmButtonText' => 'Cool'
    ]);

    Swal.fire({
        title: 'Error!',
        text: 'Category has been updated',
        icon: 'error',
        confirmButtonText: 'Cool'
    })
</script> --}}
