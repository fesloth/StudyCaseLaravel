<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
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
            color: white;
        }

        /* Sidebar dalam mode terbuka */
        #sidebar.active {
            margin-left: 0;
        }

        /* Sidebar dalam mode tertutup */
        #sidebar {
            margin-left: -250px;
        }

        /* Transisi agar halus saat mengubah mode */
        #sidebar, #sidebar.active {
            transition: margin-left 0.3s ease;
        }

        /* Konten utama berada di sebelah kanan saat sidebar terbuka */
        #sidebar.active + .content {
            margin-left: 250px; /* Lebar sidebar */
            transition: margin-left 0.3s ease; /* Agar transisi halus saat mengubah mode */
        }

        /* Konten utama berada di tengah saat sidebar tertutup */
        .content {
            margin-left: 0; /* Ubah margin menjadi 0 saat sidebar tertutup */
            transition: margin-left 0.3s ease; /* Agar transisi halus saat mengubah mode */
        }

        .box {
            padding: 5px;
            background-color: #343a40;
            color: white;
            width: 10%;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 13px;
            border-radius: 5px
        }

        .box a {
            text-decoration: none;
        }

        .logout {
            margin-top: 500px;
        }

        @media (max-width:600px) {
            .box {
                width: 40%;
                height: 80px;
            }
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
                            <a class="nav-link active" href="#">
                                <i class="fas fa-table-columns"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/product">
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
                <header>
                    <!-- Tombol toggle sidebar -->
                    <a href="#" class="btn-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars mt-3 text-secondary"></i>
                    </a>
                </header>
                <h4 class="text-center">Selamat Datang di Halaman School Gallery Banjarmasin</h4>
                <div class="col mt-5 m-3">
                    <h6>Jumlah Data Produk</h6>
                    <div class="box text-center">
                        <a href="#" class="text-white text-center">{{ $totalProduk }}</a>
                    </div>
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

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
