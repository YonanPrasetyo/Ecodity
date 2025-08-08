<div class="modal fade" id="modalDatangPatungan" tabindex="-1" role="dialog" aria-labelledby="modalPesanPatunganLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPesanPatunganLabel">
                    <i class="fas fa-truck"></i> Barang Datang
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDatangPatungan" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>Pabrik:</strong></label>
                                <p id="modalPabrik" class="form-control-static"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>Komoditas:</strong></label>
                                <p id="modalNamaKomoditas" class="form-control-static"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>Total Barang:</strong></label>
                                <p id="modalTotalTerkumpul" class="form-control-static"></p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <label for="bukti_pembelian">Bukti Pembelian</label>
                        <img id="preview-bukti-img" src="" alt="Bukti Pembelian" class="img-fluid rounded shadow" style="max-height: 70vh;">
                    </div>

                    <p class="text-muted">Apakah Pesanan dari Pabrik sudah datang?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-truck"></i> Sudah Datang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function () {
    $('.btn-datang-patungan').on('click', function () {
        // Ambil data dari button
        var pabrik = $(this).data('pabrik');
        var namaKomoditas = $(this).data('nama-komoditas');
        var totalTerkumpul = $(this).data('terkumpul');
        var urlDatang = $(this).data('url-datang');
        var urlGambar = $(this).data('url-gambar');

        // Set data ke modal
        $('#modalPabrik').text(pabrik);
        $('#modalNamaKomoditas').text(namaKomoditas);
        $('#modalTotalTerkumpul').text(totalTerkumpul);
        $('#formDatangPatungan').attr('action', urlDatang);
        $('#preview-bukti-img').attr('src', urlGambar);
    });
});
</script>
@endpush
