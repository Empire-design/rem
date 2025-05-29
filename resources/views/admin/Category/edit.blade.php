<!DOCTYPE html>
<html>
@include('admin.css')

<body>
    @include('admin.header')
    @include('admin.sidebar')

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
                                <form id = "form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $categories->id }}">

                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input type="text" value="{{ $categories->name }}" placeholder="Enter Name"
                                            name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('admin.footer')
    </div>

    <!-- JavaScript files-->
    @include('admin.js')
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $("#form-data").submit(function(e) {
            e.preventDefault();
            var form = $("#form-data")[0];
            var data = new FormData(form);
            $.ajax({
                type: "post",
                url: "{{ route('category.update') }}",
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response) {
                        alert("Category successfully updated!");
                        window.location.href = '{{ route('admin.viewcategory') }}';
                    } else {
                        alert("Category has not been updated.");
                    }
                },
                error: function(error) {
                    console.log(error);
                    alert("Something went wrong!");
                }
            });
        });
    });
</script>
