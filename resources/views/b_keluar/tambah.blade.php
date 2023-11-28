@extends('layouts.app')
@section('name')
Halaman Tambah Barang Keluar
@endsection

@section('content')
<div class="card card-primary">
        <div class="card-header d-flex justify-content-between">
            <h5>Form Tambah Barang Keluar</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('bKeluar.index') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_keluar">No Keluar</label>
                                <input type="text" name="no_keluar" readonly value="{{$no_keluar}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tgl_keluar">Tanggal Keluar</label>
                                <input required type="date" name="tgl_keluar"  value="{{date('Y-m-d')}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="yg_mengeluarkan">Yang Mengeluarkan</label>
                                <input type="text" name="yg_mengeluarkan" id="yg_mengeluarkan" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="foto_nota">File Nota</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input name="foto_nota" id="foto_nota" type="file" class="custom-file-input @error('foto_nota') is-invalid @enderror" required>
                                    <label class="custom-file-label" for="foto_nota">Pilih File</label>
                                  </div>
                                </div>
                                <span class="text-danger">format file jpg,png</span><br>
                                <img id="img-view" src="" class="mt-2" width="100px">
                                @error('foto_nota')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5" placeholder="Silahkan isi Komentar" required>{{ old('keterangan') }}</textarea>
                    </div>
                    <div class="box-barang">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="id_barang">Nama Barang</label>
                                    <select name="barang_id" id="id_barang" class="form-control select2">
                                        <option disabled selected>Pilih Barang</option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jumlah Keluar</label>
                                    <input data-index="1"  type="number"  id="jumlah" min="1" value="" class="form-control">
                                    <span class="alert-barang-kosong text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stok Sebelumnya</label>
                                    <input readonly type="number" id="jumlah_sebelumnya" min="1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sisa Stok</label>
                                    <input readonly type="number" id="sisa_stok" min="1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="">Tambah</label>
                                <br>
                                <button type="button" class="btn btn-primary btn-add-barang"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok Awal</th>
                            <th>Jumlah Keluar</th>
                            <th>Sisa Stok</th>
                        </tr>
                        @if (session()->has('databarang'))
                        @foreach (session()->get('databarang') as $item)
                            <tr>
                                <td>{{ $item['kode_barang'] }}</td>
                                <td>{{ $item['nama_barang'] }}</td>
                                <td>{{ $item['stokSebelumnya'] }}</td>
                                <td>{{ $item['jumlahMasuk'] }}</td>
                                <td>{{ $item['sisaStok'] }}</td>
                            </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a class="btn btn-danger" href="{{ route('bKeluar.index') }}"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
            </form>
        </div>
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

    //add barang to session
    $(document).on('click', '.btn-add-barang', function(){
        const id_barang = $('#id_barang').val();
        const jumlahMasuk = $('#jumlah').val();
        const stokSebelumnya = $('#jumlah_sebelumnya').val();
        const satuan = $('#satuan').val();
        const sisaStok = $('#sisa_stok').val();
        if(id_barang === '' || jumlahMasuk === '' || stokSebelumnya === '' || sisaStok === '' || satuan === null){
            Swal.fire(
                    'Gagal',
                    'Tidak Boleh Kosong',
                    'error'
                )
                return false;
        }
        $.ajax({
        url: "{{route('addCartKeluar')}}",
        data: {
            id_barang, jumlahMasuk, stokSebelumnya, satuan, sisaStok,
            _token: "{{csrf_token()}}"
        },
        dataType: 'json',
        type: "POST",
        success: function(hasil) {
            if (hasil) {
                Swal.fire(
                    'sukses',
                    'sukses menambah data ke keranjang',
                    'success'
                ).then(()=>{
                    location.reload();
                })
            } else {
                $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Gagal',
                body: 'Gagal menambah data ke keranjang'
                }).then(()=>{
                    location.reload();
                })
            }
        }
    })
    })

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
