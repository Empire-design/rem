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
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Basic Form-->
                            <div class="col-lg-6">
                                <div class="block">
                                    <div class="title"><strong class="d-block">Subcategory</strong><span
                                            class="d-block">Lorem
                                            ipsum dolor sit amet consectetur.</span></div>
                                    <div class="block-body">
                                        <form id="id" action="{{ route('subcategory.add') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-control-label">Subcategory Name</label>
                                                <input type="text" placeholder="Enter Subcategory Name"
                                                    name="subcategoryname" class="form-control">
                                            </div>
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
                                                <input type="submit" value="Submit" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
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

<script>
    $(document).ready(function() {
        $('#id').on('submit', function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            e.preventDefault();
            $.ajax({
                url: '{{ route('subcategory.add') }}',
                method: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response) {
                        window.location.href = '{{ route('admin.viewsubcategory') }}';
                    } else {
                        alert("Subacategory not added");
                    }
                },

            });
        });
    });
</script>
































































































{{-- _token: '{{ csrf_token() }}' --}}
