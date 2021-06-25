<div class="main">
  <div class="container">
  <div class="row">
  <div class="d-inline-block">
  <form method="GET" action="index.php">
    <a href="#" class="btn btn-success" style="margin-left:20" id="tambah">Tambah</a>
    <div class="float-right text-right form-inline my-2 my-lg-0" style="margin-top:-25; margin-right:25;">
    <input class="form-control mr-sm-2" type="text" placeholder="Cari Komik" name="kata_cari" value="<?php if(isset($_GET['kata_cari'])) { echo $_GET['kata_cari']; } ?>"  />
    <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Search</button>
    </div>
	</form>
  </div>
  </div>
	<table class="table table-striped table-hover ">
		<thead>
			<tr>
				<th>Id</th>
				<th>Judul</th>
				<th>Sinopsis</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//untuk meinclude kan koneksi
			include('koneksi.php');

				//jika kita klik cari, maka yang tampil query cari ini
				if(isset($_GET['kata_cari'])) {
					//menampung variabel kata_cari dari form pencarian
					$kata_cari = $_GET['kata_cari'];

					//jika hanya ingin mencari berdasarkan kode_produk, silahkan hapus dari awal OR
					//jika ingin mencari 1 ketentuan saja query nya ini : SELECT * FROM produk WHERE kode_produk like '%".$kata_cari."%' 
					$query = "SELECT * FROM tbberita WHERE Judul like '%".$kata_cari."%' OR Berita like '%".$kata_cari."%' ORDER BY Id ASC";
				} else {
					//jika tidak ada pencarian, default yang dijalankan query ini
					$query = "SELECT * FROM tbberita ORDER BY Id ASC";
				}
				

				$result = mysqli_query($koneksi, $query);

				if(!$result) {
					die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
				}
				//kalau ini melakukan foreach atau perulangan
				while ($row = mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td><?php echo $row['Id']; ?></td>
				<td><?php echo $row['Judul']; ?></td>
				<td><?php echo $row['Berita']; ?></td>
        <td><a class="btn btn-danger" href="hapus.php?kode=<?php echo $row['Id']; ?>">Hapus</a></td>
			</tr>
			<?php
			}
			?>

		</tbody>
	</table>
  <script type="text/javascript">
$('#tambah').click(function(){
$('#myModal').modal('show'); 
});
 </script>
 
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Masukan Info Komik</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" action="tambah.php" method="POST">
          <fieldset>
            <div class="form-group">
        <div class="col-lg-10">
            <input type="text" class="form-control"  placeholder="Masukkan Judul" name="Judul" required >
          </div>
        </div>
        <div class="form-group">
        <div class="col-lg-10">
            <textarea type="text" class="form-control"  placeholder="Masukkan Dokumen" name="Berita" required ></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <input type="reset"  class="btn btn-danger" value="Batal">
            <input type="submit" name="simpan" class="btn btn-primary" value="simpan">
          </div>
        </div>
      </fieldset>
    </form>
  </div>
        </div>
      </div>
    </div>