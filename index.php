<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "php-crud";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

if (isset($_POST['simpan'])) {
	// data akan di edit
	if ($_GET['hal'] == "edit") {
		$edit = mysqli_query($koneksi, "UPDATE mhs set 
											nama = '$_POST[nama]',
											kampus = '$_POST[kampus]',
											jurusan = '$_POST[jurusan]',
											angkatan = '$_POST[angkatan]'

											WHERE id_mhs = '$_GET[id]'
											");
		if ($edit) {
			echo "<script>
						alert('Edit data SUKSES!');
						document.location='index.php';
					</script>";
		} else {
			echo "<script>
						alert('Edit data GAGAL');
						document.location='index.php';
					</script>";
		}
	} else // data akan disimpan baru
	{
		$simpan = mysqli_query($koneksi, "INSERT INTO mhs (nim, nama, kampus, jurusan, angkatan)
												VALUES 	('$_POST[nama]',
														'$_POST[kampus]',
														'$_POST[jurusan]',
														'$_POST[angkatan]')
											");
		if ($simpan) {
			echo "<script>
						alert('Simpan data SUKSES!');
						document.location='index.php';
					</script>";
		} else {
			echo "<script>
						alert('Simpan data GAGAL');
						document.location='index.php';
					</script>";
		}
	}
}

// jika tombol edit dan hapus di klik
if (isset($_GET['hal'])) {
	if ($_GET['hal'] == "edit") {
		$tampil = mysqli_query($koneksi, "SELECT * FROM mhs WHERE id_mhs = '$_GET[id]' ");
		$data = mysqli_fetch_array($tampil);
		if ($data) {
			$vnama = $data['nama'];
			$vkampus = $data['kampus'];
			$vjurusan = $data['jurusan'];
			$vangkatan = $data['angkatan'];
		}
	} else if ($_GET['hal'] == "hapus") {
		$hapus = mysqli_query($koneksi, "DELETE FROM mhs WHERE id_mhs = '$_GET[id]' ");
		if ($hapus) {
			echo "<script>
						alert('Hapus data SUKSES');
						document.location='index.php';
					</script>";
		}
	}
}

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>PHP-CRUD</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style>
		button a {
			color: black;
			text-decoration: none;
			padding: 0px;
		}
	</style>
</head>

<body>
	<div class="container">
		<h1 class="text-center mt-5">CREATE, READ, UPDATE, DELETE</h1>
		<h3 class="text-center">WEB STATIS</h3>

		<!-- Awal Card Form-->
		<div class="card mt-5">
			<div class="card-header bg-primary text-white">
				Form Input Data Mahasiswa
			</div>
			<div class="card-body">
				<form method="post" action="">
					<div class="form-group">
						<label>Nama*</label>
						<input type="text" name="nama" value="<?= @$vnama ?>" class="form-control" placeholder="Input Nama anda disini!" required>
					</div>
					<div class="form-group">
						<label>Domisili Kampus*</label>
						<select class="form-control" name="kampus">
							<option value="<?= $vkampus ?>"><?= @$vkampus ?></option>
							<option value="Indralaya">Indralaya</option>
							<option value="Palembang">Palembang</option>
						</select>
					</div>
					<div class="form-group">
						<label>Jurusan*</label>
						<select class="form-control" name="jurusan">
							<option value="<?= $vjurusan ?>"><?= @$vjurusan ?></option>
							<option value="Teknik Informatika">Teknik Informatika</option>
							<option value="Sistem Informasi">Sistem Informasi</option>
							<option value="Teknik Komputer">Teknik Komputer</option>
						</select>
					</div>
					<div class="form-group">
						<label>Angkatan*</label>
						<select class="form-control" name="angkatan">
							<option value="<?= $vangkatan ?>"><?= @$vangkatan ?></option>
							<option value="2020">2020</option>
							<option value="2019">2019</option>
						</select>
					</div>

					<button type="submit" class="btn btn-success" name="simpan">Simpan</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</form>
			</div>
		</div>
		<!-- Akhir Card Form -->

		<!-- Awal Card Table-->
		<div class="card mt-5">
			<div class="card-header bg-success text-white">
				Daftar Mahasiswa
			</div>
			<div class="card-body">
				<table class="table table-bordered table-striped">
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Kampus</th>
						<th>Jurusan</th>
						<th>Angkatan</th>
						<th>Aksi</th>
					</tr>
					<?php
					$no = 1;
					$tampil = mysqli_query($koneksi, "SELECT * from mhs order by id_mhs desc");
					while ($data = mysqli_fetch_array($tampil)) :

					?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $data['nama'] ?></td>
							<td><?= $data['kampus'] ?></td>
							<td><?= $data['jurusan'] ?></td>
							<td><?= $data['angkatan'] ?></td>
							<td>
								<a href="index.php?hal=edit&id=<?= $data['id_mhs'] ?>" class="btn btn-warning">Edit</a>
								<a href="index.php?hal=hapus&id=<?= $data['id_mhs'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</table>
			</div>
		</div>
		<!-- Akhir Card Table -->
	</div>
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>