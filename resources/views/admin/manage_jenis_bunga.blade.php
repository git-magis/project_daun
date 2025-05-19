<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Tabel Jenis Bunga</title>

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
                <img src="{{asset('images/siskalogo-3.png')}}" alt="teu aya" style="width: 40px;">
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
            <li class="nav-item active">
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
                <li class="nav-item">
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
                        <span>Tabel Kahati</span></a>
                    @elseif(auth()->user()->level == 'staff')
                    <a class="nav-link" href="{{route('staff.manage-taman')}}">
                        <i class="fas fa-fw fa-map-pin"></i>
                        <span>Tabel Kahati</span></a>
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
                    <h1 class="h3 mb-4 text-gray-800">🌻Tabel Jenis Bunga</h1>
                    
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
                                Masukkan data jenis-jenis bunga pada tab ini beserta detail informasi seperti Nama Ilmiah dan Deskripsi.
                                <br><br>1. Kolom <strong>Jumlah</strong> merupakan total dari data bunga pada tab <strong>Tabel Bunga.</strong> Dihitung otomatis.
                                <br>2. Deskripsi ditujukan untuk laman detail jenis bunga. 
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
                                        <span class="text">Tambah Jenis</span>
                                    </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Nama Jenis</th>
                                            <th>Jumlah</th>
                                            <th>Nama Ilmiah</th>
                                            <th>Deskripsi</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Nama Jenis</th>
                                            <th>Jumlah</th>
                                            <th>Nama Ilmiah</th>
                                            <th>Deskripsi</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td>
                                                @if ($item->gambar_bunga) 
                                                <img src="{{ asset('images/' . $item->gambar_bunga) }}" alt="{{ $item->nama_jenis_bunga }}" style="width: 100px; height: auto;">
                                                @else
                                                <i class="fas fa-camera"></i>
                                                @endif
                                            </td>
                                            <td>{{ $item->nama_jenis_bunga }}</td> 
                                            <td>{{ $item->total }}</td>
                                            <td>{{ $item->nama_ilmiah }}</td>
                                            <td title="{{ $item->deskripsi }}">{{ Str::limit($item->deskripsi, 30, '...') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $item->id }}"
                                                        data-nama="{{ $item->nama_jenis_bunga }}"
                                                        data-ilmiah="{{ $item->nama_ilmiah }}"
                                                        data-deskripsi="{{ $item->deskripsi }}"
                                                        data-gambar="{{ $item->gambar_bunga }}"> 
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-solid fa-pen"></i>
                                                    </span>
                                                    <span class="text">Edit</span>
                                                </button>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#hapusModal" data-id="{{ $item->id }}">
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

    <!-- Add Modal-->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Bunga</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jenis_bunga.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_jenis_bunga">Nama</label>
                            <input type="text" class="form-control" id="nama_jenis_bunga" name="nama_jenis_bunga" placeholder="mawar.." required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="jumlah">Jumlah Tanaman</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" max="100" required>
                        </div> -->
                        <div class="form-group">
                            <label for="nama_ilmiah">Nama Ilmiah</label>
                            <input type="text" class="form-control" id="nama_ilmiah" name="nama_ilmiah" placeholder="oryza sativa...">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <!-- <input type="text" class="form-control" id="deskripsi" name="deskripsi"> -->
                            <input type="hidden" name="deskripsi" id="deskripsi">
                            <textarea class="form-control" name="deskripsi" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="gambar_bunga">Gambar</label>
                            <input type="file" class="form-control-file" id="gambar_bunga" name="gambar_bunga" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Bunga</h5> <!-- Changed 'Edit Pohon' to 'Edit Bunga' -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="{{ route('bunga.update', ':id') }}" enctype="multipart/form-data"> <!-- Changed 'pohon.update' to 'bunga.update' -->
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="editNama">Nama</label>
                            <input type="text" class="form-control" id="editNama" name="nama_jenis_bunga" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="editJumlah">Jumlah</label>
                            <input type="number" class="form-control" id="editJumlah" name="jumlah" min="1" required>
                        </div> -->
                        <div class="form-group">
                            <label for="editIlmiah">Nama Ilmiah</label>
                            <input type="text" class="form-control" id="editIlmiah" name="nama_ilmiah">
                        </div>
                        <div class="form-group">
                            <label for="editDesk">Deskripsi</label>
                            <input type="hidden" name="deskripsi">
                            <textarea class="form-control" name="deskripsi" id="editDesk" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editGambar">Gambar</label>
                            <input type="file" class="form-control-file" id="editGambar" name="gambar_bunga">
                        </div>
                        <div id="currentImagePreview"></div> <!-- Placeholder for current image -->

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
    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda yakin akan menghapus?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" action="{{ route('jenis_bunga.destroy', ':id') }}"> <!-- Changed 'jenis_pohon.destroy' to 'jenis_bunga.destroy' -->
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
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
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id');
            var nama = button.data('nama');
            // var jumlah = button.data('jumlah');
            var ilmiah = button.data('ilmiah');
            var deskripsi = button.data('deskripsi');
            var gambar = button.data('gambar');
            
            var formAction = '{{ route('jenis_bunga.update', ':id') }}'; // Changed 'jenis_pohon.update' to 'jenis_bunga.update'
            formAction = formAction.replace(':id', id);
            $('#editForm').attr('action', formAction);
    
            // Set the input values in the form
            $('#editNama').val(nama);
            // $('#editJumlah').val(jumlah);
            $('#editIlmiah').val(ilmiah);
            $('#editDesk').val(deskripsi);
    
            let imagePath = '/images/' + gambar; // Adjust based on your storage location
            $('#currentImagePreview').html('<img src="' + imagePath + '" width="100" alt="Current Image">');
        });
        
        // Use jQuery to update the form action dynamically
        $('#hapusModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var bungaId = button.data('id'); // Changed 'pohonId' to 'bungaId' to match the context
    
            // Update the action of the form to include the correct ID
            var actionUrl = $('#deleteForm').attr('action').replace(':id', bungaId); // Changed 'pohonId' to 'bungaId'
            $('#deleteForm').attr('action', actionUrl);
        });
    </script>
    

</body>

</html>