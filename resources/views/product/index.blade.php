<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Data Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        /* Tambahkan gaya CSS untuk mengatur sidebar */
        #sidebar {
            position: fixed;
            height: 100%;
            width: 250px; /* Lebar sidebar */
            top: 0;
            left: 0;
            padding-top: 20px; /* Jarak ke atas dari atas layar */
            background-color: #343a40; /* Warna latar belakang sidebar */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .nav-link {
            color: white 
        }

        .btn-sm {
            padding: 0.5rem 0.5rem;
            font-size: 1rem;
        }

        /* Mengatur lebar kolom Judul Produk */
        th:nth-child(2) {
            width: 20%; /* Sesuaikan lebar sesuai kebutuhan */
        }

        /* Mengatur tinggi baris tabel */
        table {
            table-layout: fixed; /* Menggunakan lebar kolom yang telah ditentukan */
        }

        td, th {
            word-wrap: break-word; /* Memecah kata jika teks terlalu panjang */
        }

        .btn {
            display: block;
        }

        /* Atur konten agar tidak tertutup oleh sidebar */
        .content {
            margin-left: 250px; 
            padding: 35px;
        }

        .logout {
            margin-top: 500px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column mt-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="/">
                                <i class="fas fa-table-columns"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-list"></i> Kelola Data Produk
                            </a>
                        </li>
                    </ul>
                    <div class="logout">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="confirmLogout()">
                                    <i class="fas fa-arrow-right-from-bracket fa-rotate-180"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
            </nav>
            <!-- Content -->
            <main class="content col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="card p-3">
                    <h4 class="border-bottom">Kelola Data Produk</h4>
                    <div class="card-main">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="/actions/tambahData" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i>Tambah Produk</a>
                        </div>
                        <table class="table table-bordered table-striped text-center">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Judul Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>                            
                            <tbody>
                                {{-- @php
                                $startId = 1; // Nomor awal ID
                                @endphp                         --}}
                                @foreach($produk as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->judulProduk }}</td>
                                    <td>{{ $p->deskripsi }}</td>
                                    <td>{{ $p->harga }}</td>
                                    <td><img src="storage/{{$p->gambar}}" alt="gambar" width="80"></td>
                                    <td>
                                        <a class="btn btn-info mb-3" href="/actions/editData/{{ $p->id }}"> Edit
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/actions/deleteData/{{ $p->id }}" class="btn btn-danger" onclick="confirmDelete()"> 
                                            Hapus <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                    {{ $produk->links() }}
                </div>
            </main>
                </div>
            </main>
        </div>
    </div>
    <script>
        function confirmLogout() {
            if (confirm('Anda yakin ingin logout?')) {
                window.location.href = 'login';
            }
        }

        function confirmDelete(deleteUrl) {
            if (confirm('Anda yakin ingin menghapus data ini?')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
                form.innerHTML = '<input type="hidden" name="_method" value="DELETE">' + '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
                document.body.appendChild(form);

                form.submit();

                // Tampilkan pesan alert setelah menghapus data
                window.alert('Data berhasil dihapus.');
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
