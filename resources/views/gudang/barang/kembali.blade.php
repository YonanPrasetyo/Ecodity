<div class="modal fade" id="modalKembali" tabindex="-1" role="dialog" aria-labelledby="modalKembaliLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKembaliLabel">
                    <i class="fas fa-envelope"></i> Pesan Transaksi
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTransaksiKembali" method="POST">
                @csrf
                <div class="modal-body">

                    <p class="text-muted">Apakah barang akan dikembalikan ke gudang?</p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Kembalikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function () {
    $('.btn-kembali').on('click', function () {
        $('#formTransaksiKembali').attr('action', $(this).data('url'));
    });
});
</script>
@endpush
