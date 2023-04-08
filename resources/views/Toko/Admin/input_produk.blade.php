@extends('Toko.layouts.layout_admin')

@section('toko_eka')
<div class="container pl-5 pb-5">
        <div class=" row justify-content-center">
            <div class="col-lg-6 col-sm-12">
                <div class="card mt-3 bg-info">
                    <div class="card-body bg-info">
            <h2 class="text-center text-white">Input Produk</h2>
        <br>
    <form class="form-horizontal" action="{{url('/simpan_produk')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="mb-3">
        <label for="nama_produk">Nama Produk</label>
        <input type="text" id="nama_produk" name="nama_produk" placeholder="Input Produk" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <div class="mb-3">
        <label for="harga_satuan">Harga Satuan</label>
        <input type="number" id="harga_satuan" name="harga_satuan" placeholder="Input Harga" class="form-control">
        </div>
    </div>
    
    <div class="form-group">
        <div class="mb-3">
        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" placeholder="Input Stock" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <div class="mb-3">
        <label for="foto_produk">Foto Produk</label>
        <input type="file" id="foto_produk" name="foto_produk" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <div class="mb-3">
        <label for="kategori">Kategori</label>
        <select id="kategori" name="kategori" class="form-label">
            <option value="Alat Musik Ritmis">Alat Musik Ritmis</option>
            <option value="Alat Musik Melodis">Alat Musik Melodis</option>
        </select>
        </div>
    </div>
        <button class="btn btn-success" type="button" onclick="validasiForm()"> Input Produk Baru </button>
        <button type="submit" id="submitInput" class="btn btn-success" hidden>Input Produk Baru</button>
        <button type="reset"class="btn btn-danger"> Reset </button>
        </form>
        
            </div>
            
<!-- Modal rubah id modal-->
<div class="modal fade" id="Modalinput" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detile Input Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nama Produk</label>
        <h5 id="namaProdukTampil"></h5>
        <label>Harga Satuan</label>
        <h5 id="hargaSatuanTampil"></h5>
        <label>Stock</label>
        <h5 id="stockTampil"></h5>
        <label>Kategori</label>
        <h5 id="kategoriTampil"></h5>
        <label>Foto Produk</label>
        <h5 id="fotoProdukTampil"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="submitInput()">Input Produk</button>
      </div>
    </div>
  </div>
</div>

            <script> //alert
                function validasiForm(){
                    var namaProduk = document.getElementById('nama_produk').value;
                    var hargaSatuan = document.getElementById('harga_satuan').value;
                    var stock = document.getElementById('stock').value;
                    var kategori = document.getElementById('kategori').value;
                    var fotoProduk = document.getElementById('foto_produk').value;

                    if (namaProduk == ""){
                        swal("Warning!", "Nama Produk harus diisi!!!", "warning");
                    }
                    else if (hargaSatuan == ""){
                        swal("Warning!", "Harga Satuan harus diisi!!!", "warning");
                    }
                    else if (stock == ""){
                        swal("Warning!", "Jumlah Stock harus diisi!!!", "warning");
                    }
                    else if (kategori == ""){
                        swal("Warning!", "Kategori harus diisi!!!", "warning");
                    }
                    else if (fotoProduk == ""){
                        swal("Warning!", "Foto Produk harus diisi!!!", "warning");
                    }
                    else if(namaProduk !="" && hargaSatuan !="" && stock !="" && kategori !=""&& fotoProduk !=""){
                        //Modal sesuaikan dengan id modal
                        $('#namaProdukTampil').html(namaProduk);
                        $('#hargaSatuanTampil').html(hargaSatuan);
                        $('#stockTampil').html(stock);
                        $('#kategoriTampil').html(kategori);
                        $('#fotoProdukTampil').html(fotoProduk);
                        $('#Modalinput').modal('show');
                    }
                }
                function submitInput(){
                    document.getElementById('submitInput').click();
                }
            </script>
@endsection