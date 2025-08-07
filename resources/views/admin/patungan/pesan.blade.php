<div class="modal fade" id="modalPesanPatungan" tabindex="-1" role="dialog" aria-labelledby="modalPesanPatunganLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPesanPatunganLabel">
                    <i class="fas fa-envelope"></i> Pesan Patungan
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPesanPatungan" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Pabrik:</strong></label>
                                <p id="modalPabrik" class="form-control-static"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Komoditas:</strong></label>
                                <p id="modalNamaKomoditas" class="form-control-static"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Total Terkumpul:</strong></label>
                                <p id="modalTotalTerkumpul" class="form-control-static"></p>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted">Apakah Anda sudah memesan produk di atas ke pabrik?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Sudah Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function () {
    $('.btn-pesan-patungan').on('click', function () {
        // Ambil data dari button
        var pabrik = $(this).data('pabrik');
        var namaKomoditas = $(this).data('nama-komoditas');
        var totalTerkumpul = $(this).data('terkumpul');
        var urlPesan = $(this).data('url-pesan');

        // Set data ke modal
        $('#modalPabrik').text(pabrik);
        $('#modalNamaKomoditas').text(namaKomoditas);
        $('#modalTotalTerkumpul').text(totalTerkumpul);
        $('#formPesanPatungan').attr('action', urlPesan);

        console.log('URL Pesan:', urlPesan);
    });
});
</script>
@endpush
