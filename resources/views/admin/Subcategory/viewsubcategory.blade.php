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
                <div class="container-fluid ">
                    @include('admin.sessionMessaage')
                    <div class="row ">
                        <div class="col-lg-12 p-5  ">
                            <div class = "block margin-top-sm">
                                <div class ="title"><strong>View Subcategory</strong></div>
                                <div class ="table-responsive">
                                    <table class= "table table-striped subcategories-table">
                                        <thead>
                                            <tr class="test-center">
                                                <th>ID</th>
                                                <th>Subcategory Name</th>
                                                <th>Category Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subupdate as $subcategories)
                                                <tr>
                                                    <td>{{ $subcategories->id }}</td>
                                                    <td>{{ $subcategories->subcategoryname }}</td>
                                                    <td>{{ $subcategories->category->name }}</td>
                                                    <td><a class="btn btn-primary"
                                                            href="{{ route('subcategory.edit', $subcategories->id) }} ">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form class="delete-btn" data-id={{ $subcategories->id }} action="{{ route('subcategory.delete', $subcategories->id) }}"
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


<script>
    $(document).ready(function() {
        $('.subcategories-table').on('click', '.delete-btn', function(e) {
            e.preventDefault();
            
            let subcategoryId = $(this).data('id');
            let form = $(this);
            if (confirm("Are you sure you want to delete this subcategory?")) {
                $.ajax({
                    url: '{{ route('subcategory.delete', ':id') }}'.replace(':id', subcategoryId),  // Replace :id with actual subcategoryId
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',  
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);  
                            form.closest('tr').fadeOut(); 
                        } else {
                            alert('Failed to delete the subcategory.');
                        }
                    },
                    error: function() {
                        alert('An error occurred while deleting the subcategory.');
                    }
                });
            }
        });
    });
</script>



























































{{-- <form action="{{ route('subcategory.store') }}" method="POST" id="subcategory-form">
    @csrf
    <div class="form-group">
        <label for="subcategory_name">Subcategory Name</label>
        <input type="text" name="subcategory_name" id="subcategory_name" class="form-control">
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            <option value="">Select Category</option>
            <!-- Category options will be dynamically loaded here -->
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    
    $('#subcategory_name').on('change', function() {
        
        if(subcategoryName) {
            // AJAX call to fetch category options based on subcategory name
            $.ajax({
                url: "{{ route('getCategoryBySubcategory') }}", // Define your route here
                type: "GET",
                data: {subcategory_name: subcategoryName},
                success: function(response) {
                    // Empty the existing options in category dropdown
                    $('#category_id').empty();
                    $('#category_id').append('<option value="">Select Category</option>');
                    
                    // Loop through categories and append them as options
                    $.each(response.categories, function(index, category) {
                        $('#category_id').append('<option value="'+category.id+'">'+category.name+'</option>');
                    });
                }
            });
        }
    });
}); --}}


{{-- error: function(xhr, status, error) {

    alert('Error: ' + error);
} --}}
