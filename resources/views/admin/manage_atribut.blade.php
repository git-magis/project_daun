<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - Tabel Taman</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @if(auth()->user()->level == 'admin')
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">
        @elseif(auth()->user()->level == 'staff')
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        @endif

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('welcome')}}">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> -->
                <img src="{{asset('images/siskalogo-2-white.png')}}" alt="teu aya" style="width: 50px;">
                <!-- <div class="sidebar-brand-text mx-3">* E-Daun Admin</div> -->
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                @if(auth()->user()->level == 'admin')
                <a class="nav-link" href="{{route('admin.admin-index')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                @elseif(auth()->user()->level == 'staff')
                <a class="nav-link" href="{{route('staff.admin-index')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                @endif
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Tanaman
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="Componentstrue" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-solid fa-tree"></i>
                    <span>Manajemen Pohon</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if(auth()->user()->level == 'admin')
                        <a class="collapse-item" href="{{route('admin.manage-pohon')}}">Tabel Pohon</a>
                        <a class="collapse-item" href="{{route('admin.manage-jenis-pohon')}}">Jenis Pohon</a>
                        @elseif(auth()->user()->level == 'staff')
                        <a class="collapse-item" href="{{route('staff.manage-pohon')}}">Tabel Pohon</a>
                        <a class="collapse-item" href="{{route('staff.manage-jenis-pohon')}}">Jenis Pohon</a>
                        @endif
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-solid fa-leaf"></i>
                    <span>Manajemen Bunga</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if(auth()->user()->level == 'admin')
                        <a class="collapse-item" href="{{route('admin.manage-bunga')}}">Tabel Bunga</a>
                        <a class="collapse-item" href="{{route('admin.manage-jenis-bunga')}}">Jenis Bunga</a>
                        @elseif(auth()->user()->level == 'staff')
                        <a class="collapse-item" href="{{route('staff.manage-bunga')}}">Tabel Bunga</a>
                        <a class="collapse-item" href="{{route('staff.manage-jenis-bunga')}}">Jenis Bunga</a>
                        @endif
                    </div>
                </div>
                <li class="nav-item active">
                    @if(auth()->user()->level == 'admin')
                    <a class="nav-link" href="{{route('admin.manage-atribut')}}">
                        <i class="fas fa-fw fa-shapes"></i>
                        <span>Atribut</span></a>
                    @elseif(auth()->user()->level == 'staff')
                    <a class="nav-link" href="{{route('staff.manage-atribut')}}">
                        <i class="fas fa-fw fa-shapes"></i>
                        <span>Atribut</span></a>
                    @endif
                </li>
                <li class="nav-item">
                    @if(auth()->user()->level == 'admin')
                    <a class="nav-link" href="{{route('admin.manage-taman')}}">
                        <i class="fas fa-fw fa-map-pin"></i>
                        <span>Tabel Taman</span></a>
                    @elseif(auth()->user()->level == 'staff')
                    <a class="nav-link" href="{{route('staff.manage-taman')}}">
                        <i class="fas fa-fw fa-map-pin"></i>
                        <span>Tabel Taman</span></a>
                    @endif
                </li>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                @if(auth()->user()->level == 'admin')
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Admin
                </div>
                <a class="nav-link" href="{{route('manage-user')}}">
                    <i class="fas fa-fw fa-solid fa-user"></i>
                    <span>Tabel Admin</span></a>
                @endif
            </li>

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <!-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(auth()->user()->level == 'admin')
                                <i class="fas fa-crown fa-sm fa-fw mr-2 text-primary"></i>
                                @elseif(auth()->user()->level == 'staff')
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                @endif
                                <span class="mr-2 d-none d-lg-inline text-primary">{{ auth()->user()->name }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div> -->
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        Logout
                                    </a>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">⛓️Tabel Atribut</h1>
                    
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                        </a>
                        
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                Tab ini berfungsi untuk menyimpan detail informasi yang bersifat opsional untuk <strong>Jenis Pohon</strong> dan <strong>Jenis Bunga.</strong> Berikut tata cara mengisi datanya:
                                <br><br>1. Pilih tipe tanaman pada form <strong>Tipe</strong>, lalu pilih jenis tanaman yang akan ditambah datanya pada form <strong>Tanaman.</strong>
                                <br>2. Form <strong>Nama Atribut</strong> dan <strong>Nilai Atribut</strong> diisi dalam satu baris yang sama, tambah baris bila ingin menambah informasi.
                                <br>3. Contoh pengisian data -> <b>Nama Atribut:</b> <i>Kingdom</i> + <b>Nilai Atribut:</b> <i>Plantae</i>, <b>Nama Atribut:</b> <i>Lama Hidup</i> + <b>Nilai Atribut:</b> <i>3-5 Tahun.</i>  
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="col p-0" style="text-align: end;">
                                <div class="my-2"></div>
                                <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-solid fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Atribut</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tipe</th>
                                            <th>Tanaman</th>
                                            <th>Nama Atribut</th>
                                            <th>Nilai Atribut</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tipe</th>
                                            <th>Tanaman</th>
                                            <th>Nama Atribut</th>
                                            <th>Nilai Atribut</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($atributs as $index => $attribute)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $attribute->entity_type }}</td>
                                            <td>
                                                @if ($attribute->entity_type === 'pohon')
                                                    {{ $attribute->jenisPohon ? $attribute->jenisPohon->nama_jenis_pohon : 'N/A' }}
                                                @elseif ($attribute->entity_type === 'bunga')
                                                    {{ $attribute->jenisBunga ? $attribute->jenisBunga->nama_jenis_bunga : 'N/A' }}
                                                @endif
                                            </td>  
                                            <td>{{ $attribute->attribute_name }}</td>
                                            <td>{{ $attribute->attribute_value }}</td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $attribute->id }}"
                                                        data-entity_type="{{ $attribute->entity_type }}" 
                                                        data-entity_id="{{ $attribute->entity_id }}"
                                                        data-attribute_name="{{ $attribute->attribute_name }}" 
                                                        data-attribute_value="{{ $attribute->attribute_value }}">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-pen"></i>
                                                    </span>
                                                    <span class="text">Edit</span>
                                                </button>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#hapusModal" data-id="{{ $attribute->id }}">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <span class="text">Hapus</span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>DLH Kota Tasikmalaya 2025 - Admin v.1</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

     <!-- Add Atribut Modal -->
     <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Atribut</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('atribut.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="entity_type">Tipe</label>
                            <select name="entity_type" id="entity_type" class="form-control" required>
                                <option value="" disabled selected>Choose...</option>
                                <option value="pohon">Pohon</option>
                                <option value="bunga">Bunga</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanaman">Tanaman</label>
                            <select name="entity_type" id="entity_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Tanaman...</option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label>Nama Atribut</label>
                            <input type="text" class="form-control" name="attribute_name" id="attribute_name" required>
                        </div>
                        <div class="form-group">
                            <label>Nilai Atribut</label>
                            <input type="text" class="form-control" name="attribute_value" id="attribute_value" required>
                        </div> -->
                        <div id="attributes-container">
                            <div class="row attribute-row">
                                <div class="col form-group">
                                    <label>Nama Atribut</label>
                                    <input type="text" class="form-control" name="attribute_name[]" required>
                                </div>
                                <div class="col form-group">
                                    <label>Nilai Atribut</label>
                                    <input type="text" class="form-control" name="attribute_value[]" required>
                                </div>
                                <!-- <div class="col-md-1 align-self-center pt-3" style="padding-left: 3px;">
                                    <button type="button" class="btn btn-success add-attribute">+</button>
                                </div> -->
                            </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <button type="button" class="btn btn-success w-100 add-attribute">+ Tambah Baris</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Atribut</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="{{ route('atribut.update', ':id') }}">
                        @csrf
                        @method('PUT')

                        <!-- <div class="form-group">
                            <label for="editTanaman">Tanaman</label>
                            <input type="text" class="form-control" id="editTanaman" name="entity_id" required>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="editTipe">Tipe</label>
                            <input type="text" class="form-control" id="editTipe" name="entity_type" required>
                        </div> -->
                        <div class="form-group">
                            <label for="editNamaAtribut">Nama Atribut</label>
                            <input type="text" class="form-control" id="editNamaAtribut" name="attribute_name" required>
                        </div>
                        <div class="form-group">
                            <label for="editNilaiAtribut">Nilai Atribut</label>
                            <input type="text" class="form-control" id="editNilaiAtribut" name="attribute_value" required>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Atribut</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteForm" method="POST" action="{{ route('atribut.destroy', ':id') }}">

                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus Atribut ini? <strong id="tamanName"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    <!-- Toaster -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 5000
        });
    </script>
    @endif

    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            // Get the button that triggered the modal
            var button = $(event.relatedTarget); // Button that triggered the modal
            
            // Extract data attributes from the button
            var id = button.data('id');
            var entity_id = button.data('entity_id');
            var entity_type = button.data('entity_type');
            var attribute_name = button.data('attribute_name');
            var attribute_value = button.data('attribute_value');

            // Update the modal's form action URL dynamically with the correct ID
            var formAction = '{{ route('atribut.update', ':id') }}';
            formAction = formAction.replace(':id', id);
            $('#editForm').attr('action', formAction);

            // Set the input values in the form
            $('#editTanaman').val(entity_id);
            $('#editTipe').val(entity_type);
            $('#editNamaAtribut').val(attribute_name);
            $('#editNilaiAtribut').val(attribute_value);
        });

        // Use jQuery to update the form action dynamically
        $('#hapusModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var atributId = button.data('id'); // Extract info from data-* attributes

            // Update the action of the form to include the correct ID
            var actionUrl = $('#deleteForm').attr('action').replace(':id', atributId);
            $('#deleteForm').attr('action', actionUrl);
        });
    </script>

    <!-- JavaScript to Load Entities Dynamically -->
    <script>
        document.getElementById('entity_type').addEventListener('change', function() {
            var type = this.value;
            var dropdown = document.getElementById('entity_id');
            dropdown.innerHTML = '<option value="">Loading...</option>';

            fetch('/get-entities?type=' + type)
                .then(response => response.json())
                .then(data => {
                    dropdown.innerHTML = '<option value="">Pilih Tanaman...</option>';
                    data.forEach(entity => {
                        dropdown.innerHTML += `<option value="${entity.id}">${entity.name}</option>`;
                    });
                });
        });

        // JQuery to Append new lines on Attribute.store
        $(document).ready(function () {
            // let counter = 1;
            // $("#attributes-container").on("click", ".add-attribute", function () {
            $(".add-attribute").click(function () {
                let newRow = `
                    <div class="row attribute-row">
                        <div class="col form-group">
                            <label>Nama Atribut</label>
                            <input type="text" class="form-control" name="attribute_name[]" required>
                        </div>
                        <div class="col form-group">
                            <label>Nilai Atribut</label>
                            <input type="text" class="form-control" name="attribute_value[]" required>
                        </div>
                        <div class="col-md-1 align-self-center pt-3" style="padding-left: 3px;">
                            <button type="button" class="btn btn-danger remove-attribute">-</button>
                        </div>
                    </div>`;
                $("#attributes-container").append(newRow);
                // counter++;
            });

            $(document).on("click", ".remove-attribute", function () {
                $(this).closest(".attribute-row").remove();
            });
        });

        $(document).ready(function () {
            $('#tambahModal').submit(function (e) {
                e.preventDefault();  // Prevent page reload

                var formData = {
                    entity_type: $('#entity_type').val(),
                    entity_id: $('#entity_id').val(),
                    attribute_name: [],
                    attribute_value: [],
                };

                $('input[name="attribute_name[]"]').each(function () {
                    formData.attribute_name.push($(this).val());
                });

                $('input[name="attribute_value[]"]').each(function () {
                    formData.attribute_value.push($(this).val());
                });

                console.log("Submitting Data:", formData); // Debugging step

                $.ajax({
                    type: "POST",
                    url: "{{ route('atribut.store') }}", // Adjust to your route
                    data: JSON.stringify(formData),
                    contentType: "application/json", // Set correct content type
                    dataType: "json", // Ensure Laravel understands JSON
                    processData: false, // Prevent jQuery from processing the data
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    success: function (response) {
                        // alert("Attribute Added Successfully!");
                        $('#tambahModal').modal('hide');
                        location.reload();  // Refresh to see the new data
                    },
                    error: function (xhr) {
                        console.error("Error:", xhr.responseText);
                        alert("Something went wrong!");
                    }
                });
            });
        });

    </script>

</body>

</html>