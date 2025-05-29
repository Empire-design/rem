<!DOCTYPE html>
<html>
@include('admin.css')

<body>
    {{-- @include('sweetalert2::index') --}}
    @include('admin.header')
    @include('admin.sidebar')

    {{-- <div class="d-flex align-items-stretch"> --}}
    <!-- Sidebar Navigation-->
    {{-- <nav id="sidebar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h5">Mark Stephen</h1>
              <p>Web Designer</p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
          <ul class="list-unstyled">
                  <li><a href="index.html"> <i class="icon-home"></i>Home </a></li>
                  <li><a href="tables.html"> <i class="icon-grid"></i>Tables </a></li>
                  <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
                  <li class="active"><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li>
                  <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Example dropdown </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                      <li><a href="#">Page</a></li>
                      <li><a href="#">Page</a></li>
                      <li><a href="#">Page</a></li>
                    </ul>
                  </li>
                  <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
          </ul><span class="heading">Extras</span>
          <ul class="list-unstyled">
            <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
            <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
            <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
          </ul>
        </nav> --}}
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
                            <div class="title"><strong class="d-block">Basic Form</strong><span class="d-block"></span>
                            </div>
                            <div class="block-body">
                                <form id="id" action="{{ url('addproduct') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="idcategory"></label>
                                        <select name="idcategory" id="idcategory" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach (DB::table('categories')->get() as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="idsubcategory"></label>
                                        <select name="idsubcategory" id="idsubcategory" class="form-control">
                                            <option value="">Select Subcategory</option>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Product Name</label>
                                        <input type="text" placeholder="Enter Product Name" name="productname"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Product Price</label>
                                        <input type="number" placeholder="Enter Product Price" name="price"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Product Image</label>
                                        <input type="file" placeholder="Enter Product Image" name="productimage"
                                            class="form-control">
                                    </div>
                                    <div id="example" class="form-group">
                                        <label class="form-control-label">Product Description</label>
                                        {{-- <input type="text" placeholder="Enter Description" name="description"
                                            class="form-control"> --}}
                                            <textarea name="description" placeholder="Enter Description"  class="form-control" id=""></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- {!!  !!} --}}
                        
                </div>
            </div>
    </div>
    </section>
    @include('admin.footer')

    </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
</body>



</html>
{{--  --}}
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>  
    <script> 
      var editor = new FroalaEditor('#example');
    </script>
{{--  --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#idcategory').on('change', function() {
            let category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: '/subcategories/' + category_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        $('#idsubcategory').empty().append(
                            '<option value="">Select a subcategory</option>');
                        $.each(data, function(index, value) {
                            $('#idsubcategory').append('<option value="' + value
                                .id + '">' + value.subcategoryname + '</option>'
                            );
                        });

                        if (data.length > 0) {
                            $('#idsubcategory').val(data[0].id);
                        }
                    },
                    error: function(xhr) {
                        alert("subcategories not fetch ");
                    }
                });
            } else {

                $('#idsubcategory').empty().append('<option value="">Select a subcategory</option>');
            }
        });
    });
</script>

<script>
    $('#id').on('submit', function() {
        e.preventDefault();
        let formdata = new FormData(this);
        $.ajax({
            url: '{{ route('product.add') }}',
            method: "POST",
            processData: false,
            contentType: false,
            data: {
                formdata,
            }
            success: function(response) {
                if (response) {
                    alert('updated');
                    window.location.href = '{{ route('product.view') }}';
                } else {
                    alert("Product has not added");
                }
            }
            error: function(error) {
                console.log(error);
                alert("Something went wrong");
            }

        })
    })
</script>
