<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src={{ asset('admin/img/avatar-6.jpg') }} alt="..."
                    class="img-fluid rounded-circle"></div>
            <div class="title">

                @if (Auth::check())
                    <h1 class="h5">{{ Auth::user()->usertype }}</h1>
                    <p>Web Developer</p>
                @endif
            </div>
        </div>


        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
            @if (Auth::user()->can('Category List'))
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
                            class="icon-windows"></i>Category</a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        @if (Auth::user()->can('Category Create'))
                            <li><a href="{{ route('category.formshow') }}">Add Category</a></li>
                        @endif
                        @if (Auth::user()->can('Category View'))
                            <li><a href="{{ url('viewcategory') }}">View Category</a></li>
                        @endif

                    </ul>
                </li>
            @endif
            @if (Auth::user()->can('Subcategory List'))
                <li><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"> <i
                            class="icon-windows"></i>SubCategory</a>
                    <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                        @if (Auth::user()->can('Subcategory Create'))
                            <li><a href="{{ route('subcategory.formshow') }}">Add SubCategory</a></li>
                        @endif
                        @if (Auth::user()->can('Subcategory View'))
                            <li><a href="{{ url('viewsubcategory') }}">View SubCategory</a></li>
                        @endif

                    </ul>
                </li>
            @endif
            @if (Auth::user()->can('Product List'))
                <li><a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse"> <i
                            class="icon-windows"></i>Product</a>
                    <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
                        @if (Auth::user()->can('Product Create'))
                            <li><a href="{{ url('product') }}">Add Prouct</a></li>
                        @endif
                        @if (Auth::user()->can('Product View'))
                            <li><a href="{{ route('product.view') }}">View Product</a></li>
                        @endif

                    </ul>
                </li>
            @endif
            @if (Auth::user()->can('Blog List'))
                <li><a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse"> <i
                            class="icon-windows"></i>Blog</a>
                    <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
                        @if (Auth::user()->can('Blog Create'))
                            <li><a href="{{ url('blog') }}">Add Blog</a></li>
                        @endif

                        @if (Auth::user()->can('Blog View'))
                            <li><a href="{{ route('viewblog') }}">View Blog</a></li>
                        @endif

                    </ul>
                </li>
            @endif
            @if (Auth::user()->can('Role List'))
                <li><a href="#exampledropdownDropdown4" aria-expanded="false" data-toggle="collapse"> <i
                            class="icon-windows"></i>Role</a>
                    <ul id="exampledropdownDropdown4" class="collapse list-unstyled ">
                        @if (Auth::user()->can('Role Create'))
                            <li><a href="{{ url('show') }}">Add Role has Permission</a></li>
                        @endif
                        @if (Auth::user()->can('Role View'))
                            <li><a href="{{ route('admin.index') }}">View Role</a></li>
                        @endif

                    </ul>
                </li>
            @endif
            @if (Auth::user()->can('Permission List'))

                <li><a href="#exampledropdownDropdown5" aria-expanded="false" data-toggle="collapse"> <i
                            class="icon-windows"></i>Permission</a>
                    <ul id="exampledropdownDropdown5" class="collapse list-unstyled ">
                        @if (Auth::user()->can('Permission Create'))
                            <li><a href="{{ url('showform') }}">Add Permission</a></li>
                        @endif
                        @if (Auth::user()->can('Permission View'))
                            <li><a href="{{ route('admin.viewpermission') }}">View Permission</a></li>
                        @endif

                    </ul>
                </li>
            @endif

            @if (Auth::user()->can('User List'))
                <li><a href="#exampledropdownDropdown6" aria-expanded="false" data-toggle="collapse"> <i
                            class="icon-windows"></i>User</a>
                    <ul id="exampledropdownDropdown6" class="collapse list-unstyled ">
                        {{-- Add model has Role --}}
                        @if (Auth::user()->can('User Create'))
                            <li><a href="{{ route('user.show') }}">Add Model Has Role</a></li>
                        @endif
                        {{-- Add model has Permission --}}
                        @if (Auth::user()->can('User Create'))
                            <li><a href="{{ route('user.model_has_permission') }}">Add Model Has Permission</a></li>
                        @endif
                        @if (Auth::user()->can('User View'))
                            <li><a href="{{ route('user.viewUser') }}">View User</a></li>
                        @endif

                    </ul>
                </li>
            @endif





            {{-- <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li> --}}
        </ul>
    </nav>

    <!-- Sidebar Navigation end-->
