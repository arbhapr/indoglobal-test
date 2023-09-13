<!DOCTYPE html>
<html lang="en">

@include('_layouts.sections.head')

<body class="sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('_layouts.sections.preloader')
        @include('sweetalert::alert')

        @include('_layouts.sections.navbar')

        @include('_layouts.sections.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title', 'Dashboard')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" style="text-decoration: none;">Home</a></li>
                                @yield('breadcrumb')
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            
            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>

        </div>

        @include('_layouts.sections.footer')

        @include('_layouts.sections.control')

    </div>
    <!-- ./wrapper -->

    @include('_layouts.sections.script')
</body>

</html>
