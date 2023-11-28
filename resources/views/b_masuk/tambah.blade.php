@extends('layouts.app')
@section('name')
Halaman Tambah Barang Masuk
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Barang Masuk</h3>
            </div>
            <form action="{{ route('bMasuk.index') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <input type="hidden" name="penerima" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="id_barang">Nama Barang</label>
                        <select name="barang_id" id="id_barang" class="form-control select2" required>
                            <option disabled selected>Pilih Barang</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Suppliers</label>
                        <select name="supplier_id" id="supplier_id" class="form-control select2" required>
                            <option disabled selected>Pilih Suppliers</option>
                            @foreach ($supplier as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Masuk</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Silahkan isi jumlah masuk" required>
                        <span class="alert-barang-kosong text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label>Stok Sebelumnya</label>
                        <input type="number" name="jumlah_sebelumnya" id="jumlah_sebelumnya" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Total Stok</label>
                        <input type="number" name="total_stok" id="total_stok" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <div class="input-group date" id="tgl" data-target-input="nearest">
                            <input name="tgl_masuk" type="text" class="form-control datetimepicker-input" data-target="#tgl" required/>
                            <div class="input-group-append" data-target="#tgl" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto_nota">File Nota</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input name="foto_nota" id="foto_nota" type="file" class="custom-file-input @error('foto_nota') is-invalid @enderror" required>
                            <label class="custom-file-label" for="foto_nota">Choose file</label>
                          </div>
                        </div>
                        <span class="text-danger">format file jpg,png</span>
                        <br>
                        <img id="img-view" src="" class="mt-2" width="100px">
                        @error('foto_nota')
                        <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                        @enderror
                      </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Isi Keterangan" required></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('bMasuk.index') }}" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> kembali</a>
                </div>
            </form>
        </div>
    <div class="col-md-6">
</div>
@endsection

@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('template') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('template') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush
@push('js')
<!-- Select2 -->
<script src="{{ asset('template') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="{{ asset('template') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('template') }}/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('template') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('template') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
@endpush
@push('script')
<script>
$(document).ready(function() {
    //bs-custom-file-input
    bsCustomFileInput.init();

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    //Date picker
    $('#tgl').datetimepicker({
            icons: { time: 'far fa-clock' },
            format: 'YYYY-MM-DD',
            locale: 'id'
        });

    // cek stok
    $(document).on('keyup change', '#jumlah', function() {
                const id_barang = $('#id_barang').val();
                var jumlah_masuk = $('#jumlah').val();
                $('.alert-barang-kosong').html(``);
                if (id_barang === undefined || id_barang === '' || id_barang === null) {
                    $('.alert-barang-kosong').html(`Barang Harus Di Pilih Dahulu`);
                    $('.btn').attr('disabled', 'disabled');
                    return false;
                }
                $.ajax({
                    url: '/bMasuk',
                    data: {
                        checkStok: true,
                        id_barang,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function(result) {
                        let jumlah = result.jumlah;
                        $('#jumlah_sebelumnya').val(jumlah);
                        const total = parseInt(jumlah) + parseInt(jumlah_masuk);
                        $('#total_stok').val(total);
                    }
                })
            })

    // review gambar
    $('#foto_nota').change(function () {
        previewImage(this);
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img-view').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
});
</script>
@endpush
