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
                                <form id="form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <!-- Category Select -->
                                    <div class="form-group">
                                        <label for="idcategory">Category</label>
                                        <select name="idcategory" id="idcategory" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach (DB::table('categories')->get() as $categorys)
                                                <option value="{{ $categorys->id }}"
                                                    {{ $product->idcategory == $categorys->id ? 'selected' : '' }}>
                                                    {{ $categorys->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Subcategory Select -->
                                    <div class="form-group">
                                        <label for="idsubcategory">Subcategory</label>
                                        <select name="idsubcategory" id="idsubcategory" class="form-control">
                                            <option value="">Select Subcategory</option>
                                            @foreach (DB::table('subcategories')->get() as $subcategorys)
                                                <option value="{{ $subcategorys->id }}"
                                                    {{ $product->idsubcategory == $subcategorys->id ? 'selected' : '' }}>
                                                    {{ $subcategorys->subcategoryname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Product Name Input -->
                                    <div class="form-group">
                                        <label for="productname">Product Name</label>
                                        <input type="text" name="productname" id="productname" class="form-control"
                                            value="{{ $product->productname }}">
                                    </div>

                                    <!-- Product Price Input -->
                                    <div class="form-group">
                                        <label for="productprice">Product Price</label>
                                        <input type="text" name="productprice" id="productprice" class="form-control"
                                            value="{{ $product->price }}">
                                    </div>

                                    <!-- Product Image Input -->
                                    <div class="form-group">
                                        <label class="form-control-label">Product Image</label>
                                        <input type="file" name="productimage" class="form-control">
                                    </div>

                                    <!-- Product Description Input -->
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <input type="text" name="description" class="form-control"
                                            value="{{ $product->description }}">
                                    </div>

                                    <!-- Submit Button -->
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

        {{-- @include('admin.footer') --}}
        @include('admin.footer')
    </div>

    <!-- JavaScript files-->
    @include('admin.js')
</body>

</html>

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
    $(document).ready(function() {
        $("#form-data").submit( function(e) {
            e.preventDefault();  
            var form = $("#form-data")[0]; 
            var data = new FormData(form);
            $.ajax({
                type: "post",  
                url: "{{ route('product.update') }}", 
                data: data, 
                processData: false, 
                contentType: false, 
                success: function(response) {
                    if (response) {
                        alert("Product successfully updated!"); 
                        window.location.href = '{{ route('product.view') }}';  
                    } else {
                        alert("Product has not been updated.");  
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
