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
            <div class="container-fluid ">
                <div class="row ">
                    <div class="col-lg-12 p-5  ">
                        <div class = "block margin-top-sm">
                            <div class ="title"><strong>Striped Table</strong></div>
                            <div class ="table-responsive">
                                <table class= "table table-striped">
                                    <thead>
                                        <tr class="test-center">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($user as $users)
                                            <tr>
                                                <td>{{ $users->id }}</td>
                                                <td>{{ $users->name }}</td>
                                                <td>{{ $users->email }}</td>
                                                <td>{{ $users->password }}</td>
                                                
                                                @if ($users->usertype == 'admin')
                                                    <td><button onclick="{{ route('login') }}" class="btn btn-primary"
                                                            type="submit">Login</button>
                                                    </td>
                                                @else
                                                    <td>
                                                        <p>User is not authorized</p>
                                                    </td>
                                                @endif

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
                <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank"
                        href={{ asset('https://templateshub.net') }}>Templates Hub</a>.</p>
            </div>
        </div>
    </footer>

</body>

</html>
