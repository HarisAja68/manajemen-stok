@extends('layouts.app')
@section('name')
Halaman Edit Barang Keluar
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Edit Barang Keluar</h3>
    </div>
    <form action="{{ route('bKeluar.update', $bKeluar->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <input type="hidden" name="oldPhoto" value="{{ $bKeluar->foto_nota }}">
            <div class="form-group">
                <label>Tanggal Keluar</label>
                <div class="input-group date" id="tgl" data-target-input="nearest">
                    <input name="tgl_keluar" type="text" class="form-control datetimepicker-input" data-target="#tgl" value="{{ $bKeluar->tgl_keluar }}" required/>
                    <div class="input-group-append" data-target="#tgl" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="foto_nota">File Nota</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input name="foto_nota" type="file" class="custom-file-input @error('foto_nota') is-invalid @enderror" id="foto_nota">
                    <label class="custom-file-label" for="foto_nota">{{ $bKeluar->foto_nota }}</label>
                  </div>
                </div>
                <span class="text-danger">format file jpg,png</span>
                @error('foto_nota')
                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                @enderror
                <br>
                <img src="{{ asset('storage/nota_keluar/'.$bKeluar->foto_nota) }}" id="img-view" width="100px">
              </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5">{{ $bKeluar->keterangan }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('bKeluar.index') }}" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> kembali</a>
        </div>
    </form>
</div>
@endsection

@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('template') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('template') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('template') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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
<!-- SweetAlert2 -->
<script src="{{ asset('template') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
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
    $(document).on('keyup change', '#jumlah', function(){
        const id_barang = $(`#id_barang`).val();
        var jumlah_keluar = $(this).val();

        $('.alert-barang-kosong').html(``);
        if(id_barang === undefined || id_barang === '' || id_barang === null){
            $('.alert-barang-kosong').html(`Barang Harus Di Pilih Dahulu`);
            $('#btn-add').attr('disabled','disabled');
            return false;
        }
        $.ajax({
            url: '/bKeluar',
            data: {
                checkStok: true,
                id_barang,
                _token: "{{csrf_token()}}"
            },
            dataType: 'json',
            type: 'post',
            success: function (result){
                let jumlah = result.jumlah;
                $(`#jumlah_sebelumnya`).val(jumlah);
                $(`#jumlah`).attr('max',`${jumlah}`);
                const total = parseInt(jumlah) - parseInt(jumlah_keluar);
                console.log(total);
                $(`#sisa_stok`).val(total);
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
