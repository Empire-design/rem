<!DOCTYPE html>
<html>
@include('admin.css')

<body>
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
                            <div class="title"><strong class="d-block">Subcategory</strong><span class="d-block">Lorem
                                    ipsum dolor sit amet consectetur.</span></div>
                            <div class="block-body">
                                <form id="formid">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $subcategory->id }}">

                                    <div class="form-group">
                                        <label for="subcategoryname">Subcategory Name</label>
                                        <input type="text" name="subcategoryname" id="subcategoryname"
                                            class="form-control" value="{{ $subcategory->subcategoryname }}"
                                            placeholder="Enter Subcategory Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="idcategory">Category</label>
                                        <select name="idcategory" id="idcategory" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach (DB::table('categories')->get() as $categorys)
                                                <option value="{{ $categorys->id }}"
                                                    {{ $subcategory->idcategory == $categorys->id ? 'selected' : '' }}>
                                                    {{ $categorys->name }}
                                                </option>
                                            @endforeach
                                        </select>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#formid').submit(function(e) {
            e.preventDefault();
            let form = $('#formid')[0];
            let data = new FormData(form);

            $.ajax({
                method: 'POST',
                url: "{{ route('subcategory.update') }}",
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result) {
                        alert("Successfully updated!");
                        window.location.href = '{{ route('admin.viewsubcategory') }}';
                    } else {
                        alert("Failed to update");
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
