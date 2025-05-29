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
                        <div class="col-lg-12 p-5  ">
                            <div class = "block margin-top-sm">
                                <div class ="title"><strong>Category Table</strong></div>
                                <div class ="table-responsive">
                                    <table class= "table table-striped categories-table">
                                        <thead>
                                            <tr class="test-center">
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Categorytype</th>
                                                <th>Created_At</th>
                                                <th>Updated_At</th>
                                                <th>Edit</th>
                                                <th>Delete</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $categories)
                                                <tr>
                                                    <td>{{ $categories->id }}</td>
                                                    <td>{{ $categories->name }}</td>
                                                    <td>{{ $categories->categorytype }}</td>
                                                    <td>{{ $categories->created_at }}</td>
                                                    <td>{{ $categories->updated_at }}</td>
                                                    <td><a class="btn btn-primary"
                                                            href="{{ route('category.edit', $categories->id) }}">Edit</a>
                                                    </td>

                                                    <td>
                                                        <form class=" delete-btn" data-id={{ $categories->id }}
                                                            action="{{ route('category.delete', $categories->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">Delete</button>
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
            @include('admin.footer')
        </div>
    </div>
    @include('admin.js')
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
