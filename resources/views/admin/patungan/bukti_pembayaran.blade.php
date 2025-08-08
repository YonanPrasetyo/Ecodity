<div class="modal fade" id="modal-bukti-transaksi" tabindex="-1" role="dialog" aria-labelledby="modalBuktiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="modalBuktiLabel">
                    <i class="fas fa-image"></i> Bukti Transaksi
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="preview-bukti-img" src="" alt="Bukti Pembayaran" class="img-fluid rounded shadow" style="max-height: 70vh;">
            </div>
        </div>
    </div>
</div>


@push('js')
<script>
    $(document).ready(function () {
        // Tombol preview bukti transaksi
        $('.btn-preview-bukti-transaksi').on('click', function () {
            var url = $(this).data('url');
            $('#preview-bukti-img').attr('src', url);
        });
    });
</script>
@endpush
