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
                <h2 class="h5 no-margin-bottom">Tables</h2>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Tables </li>
            </ul>
            <section class="no-padding-top">
                <div class = "container-fluid">
                    <div class="row ">
                        <div class="col-lg-12">
                            <div class = "block margin-top-sm">
                                <div class ="title"><strong>Detail Page</strong></div>
                                <div  class ="table-responsive">
                                    <table  class= "table table-striped categories-table">
                                        <thead class="text-center">
                                              @if ($type == 'blog')
                                                <tr>
                                                    <th class="col">Image</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @if (isset($multi->image) && $multi->image->url)
                                                            <img src="{{ asset($multi->image->url) }}"
                                                                alt="{{ $multi->name }}" style="width: 150px;">
                                                        @else
                                                            No image available
                                                        @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="col">Blog Name</th>
                                                </tr>

                                                <tr>
                                                    <td class="col">{{ $multi->name }}</td>
                                                </tr>
                                                </tr>
                                               
                                                <tr>
                                                    <th class="col">Description</th>
                                                </tr>
                                                <tr>
                                                    <td class="col">{{ $multi->description }}</td>
                                                </tr>

                                                <tr>
                                                    {{-- @dd($multi->image) --}}

                                                </tr>

                                                </tr>
                                            @endif
                                        </thead>
                                        <tbody >



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
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>  
    <script> 
      var editor = new FroalaEditor('#example');
    </script>

<script>
    (document).ready(function() {
        $('.categories-table').on('click', '.delete-btn', function() {
            let productId = $(this).data('id');
            $.ajax({
                url: '{{ route('category.delete', ':id') }}'.replace(':id', productId),
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.result);

                    } else if (response.error) {
                        alert('Failed to delete product.');
                    }
                },
                error: function() {
                    alert('Error occurred while deleting product');
                }
            });
        });

    })
</script>

{{-- useful --}}
{{-- <script>
    let table = $('#blog-table').DataTable({
        let blogid = $(this).val();
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('blog.multi', ':id') }}'.replace(':id': blogid),
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
                data: 'name',
                name: 'name'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'image',
                name: 'image',
                // render: function(data) {

                //     return '<img src="{{ asset('images/') }}/' + data +
                //         '" alt="Image" style="width: 150px;">';
                // }
                render: function(data) {
                    if (data) {
                        return '<img src="' + data + '" alt="Image" style="width: 150px;">';
                    } else {
                        return 'No image';
                    }
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

        ]
    });

    $(document).ready(function() {
        table.ajax.reload();

        // $('#idcategory, #idsubcategory').on('change', function() {
        //     table.ajax.reload();
        // });
    });
</script> --}}

{{-- <script>
    $(document).ready(function() {
        let blogId = '{{ $id }}'; 

        let table = $('#blog-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('blog.multi', ':id') }}'.replace(':id', blogId),
                type: 'GET',
                data: function(data) {
                    data.category_id = $('#idcategory').val();
                    data.subcategory_id = $('#idsubcategory').val();
                },
                dataSrc: 'data'
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'image',
                    name: 'image',
                    render: function(data) {
                        if (data) {
                            return '<img src="' + data + '" alt="Image" style="width: 150px;">';
                        } else {
                            return 'No image';
                        }
                    }
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        If you want to reload on category filter changes, uncomment:
        $('#idcategory, #idsubcategory').on('change', function () {
            table.ajax.reload();
        });
    });
</script> --}}
{{-- 
<script>
    $('#blog-table').on('click', '.delete-btn', function() {
    let blogid = $(this).data('id');
    $.ajax({
    url: '{!! route('blog.delete', ':id') !!}'.replace(':id', blogid),
    method: 'DELETE',
    data: {
        _token: '{{ csrf_token() }}',
    },
    success: function(response) {
        if (response.status === 'success') {
            alert(response.message);
            table.ajax.reload();
        } else {
            alert('Failed to delete blog.');
        }
    },
    error: function() {
        alert('Error occurred while deleting blog');
    }
    });
    });
</script> --}}
