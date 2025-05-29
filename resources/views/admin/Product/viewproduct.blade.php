{{-- <img src="{{ asset('images/'.$product->productimage) }}" alt="{{ $product->productname }}" style="width: 150px;">
<!DOCTYPE html>
<html>
@include('admin.css')

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Tables </li>
        </ul>

        <section class="no-padding-top">
            <div class = "container-fluid">
                <div class="row ">
                    <div class="col-lg-12 p-5  ">
                        <div class = "block margin-top-sm">
                            <div class ="title"><strong>Striped Table</strong></div>
                            <div class ="table-responsive">
                                <table class= "table table-striped">
                                    <thead>
                                        <tr class="test-center">
                                            <th>ID</th>
                                            <th>IdCategory</th>
                                            <th>Idsubcategory</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Created_At</th>
                                            <th>Updated_At</th>
                                            <th>Edit</th>
                                            <th>Delete</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($product as $products)
                                            <tr>
                                                <td>{{ $products->id }}</td>
                                                <td>{{ $products->categorys->name }}</td>
                                                <td>{{ $products->subcategorys->subcategoryname }}</td>
                                                <td>{{ $products->productname }}</td>
                                                <td>{{ $products->price }}</td>
                                                <td><img src="{{ asset('images/' . $products->productimage) }}"
                                                        alt="{{ $products->productname }}" style="width: 150px;">
                                                </td>
                                                <td>{{ $products->description }}</td>
                                                <td>{{ $products->created_at }}</td>
                                                <td>{{ $products->updated_at }}</td>
                                                <td><a class="btn btn-primary"
                                                        href="{{ url('editproduct', $products->id) }}">Edit</a></td>

                                                <td>
                                                    <form action="{{ url('prodelete', $products->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="footer">
        <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
                <p class="no-margin-bottom">2025 &copy; Your company. Download From <a target="_blank"
                        href={{ asset('https://templateshub.net') }}>Templates Hub</a>.</p>
            </div>
        </div>
    </footer>
    {{-- @include('admin.footer') --}}
{{-- </body>

</html>


 type="text/javascript">
    $(document).ready(function() {
        $('#products-table').DataTable({
            processing: true, 
            serverSide: true, 
            ajax: '{!! route('admin.view') !!}', 
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'productname',
                    name: 'productname'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                } // Actions column (Edit, Delete buttons)
            ]
        });
    }); --}}
<!DOCTYPE html>
<html lang="en">
@include('admin.css')

<head>
    @include('admin.header')
</head>

<body>
    @include('admin.sidebar')
    <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Tables</h2>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ul>
            <div class="form-group">
                <label for="idcategory">Select Category</label>
                <select name="idcategory" id="idcategory" class="form-control">
                    <option value="">Select Category</option>
                    @foreach (DB::table('categories')->get() as $categorys)
                        <option value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="idsubcategory">Select Subcategory</label>
                <select name="idsubcategory" id="idsubcategory" class="form-control">
                    <option value="">Select Subcategory</option>
                    @foreach (DB::table('subcategories')->get() as $subcategorys)
                        <option value="{{ $subcategorys->id }}">{{ $subcategorys->subcategoryname }}</option>
                    @endforeach
                </select>
            </div>

            <section class="no-padding-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="block margin-top-sm">
                                <div class="title"><strong>Products Table</strong></div>
                                <div class="table-responsive">
                                    <table id="products-table" class="table table-striped"
                                        style="overscroll-behavior-x: hidden;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category</th>
                                                <th>Subcategory</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
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

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


</body>

</html>

{{-- <script>
    $(function() {

        let table = $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.view') !!}',
            // data: {
            //     category_id: category_id
            // },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'idcategory',
                    name: 'idcategory'
                },
                {
                    data: 'idsubcategory',
                    name: 'idsubcategory'

                },
                {
                    data: 'productname',
                    name: 'productname'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'productimage',
                    name: 'productimage',
                    render: function(data) {
                        return '<img src="{{ asset('images/') }}/' + data +
                            '" alt="Product Image" style="width: 150px;">';
                    }
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action',

                },
                // {
                // data: 'delete',
                // name: 'delete',
                //     orderable: false, // Disable sorting for this column
                //     searchable: false // Disable searching for this column
                // }

                
                
                ]
                });
        $('#idcategory').change(function() {
            table.ajax.reload();
        });
        $('#idsubcategory').change(function() {
            table.ajax.reload();
        });
    })
</script> --}}


<script>
    let table = $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('product.view') !!}',
            type: 'GET',
            data: function(data) {
                data.category_id = $('#idcategory').val();
                data.subcategory_id = $('#idsubcategory').val();
            },
            dataSrc: function(response) {
                return response.data;
            }
        },
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'idcategory',
                name: 'idcategory'
            },
            {
                data: 'idsubcategory',
                name: 'idsubcategory'
            },
            {
                data: 'productname',
                name: 'productname'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'productimage',
                name: 'productimage',
                render: function(data) {
                    return '<img src="{{ asset('images/') }}/' + data +
                        '" alt="Product Image" style="width: 150px;">';
                }
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'action',
                name: 'action'
            },
            // {
            //     data: 'delete',
            //     name: 'delete'
            // }
        ]
    });

    $(document).ready(function() {
        table.ajax.reload();

        $('#idcategory, #idsubcategory').on('change', function() {
            table.ajax.reload();
        });
    });


    $('#products-table').on('click', '.delete-btn', function() {
        let productId = $(this).data('id');
        $.ajax({
            url: '{!! route('admin.delete', ':id') !!}'.replace(':id', productId),
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    table.ajax.reload();
                } else {
                    alert('Failed to delete product.');
                }
            },
            error: function() {
                alert('Error occurred while deleting product');
            }
        });
    });
</script>

{{-- <script>
    
    <script type="text/javascript">
        $(document).ready(function () {
        
            $('#fetchDataButton').on('click', function () {
                $.ajax({
                    url: '{{ route('/fetch-data') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}'  
                    },
                    success: function (response) {
                        $('#result').html(response.message);
                    },
                    error: function () {
                        $('#result').html('Error fetching data.');
                    }
                });
            });
        });
    </script> --}}
