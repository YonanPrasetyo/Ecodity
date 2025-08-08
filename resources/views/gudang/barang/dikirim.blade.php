<div class="modal fade" id="modalDikirim" tabindex="-1" role="dialog" aria-labelledby="modalDikirimLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDikirimLabel">
                    <i class="fas fa-envelope"></i> Pesan Transaksi
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTransaksiDikirim" method="POST">
                @csrf
                <div class="modal-body">

                    <p class="text-muted">Apakah barang akan dikirim?</p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function () {
    $('.btn-dikirim').on('click', function () {
        $('#formTransaksiDikirim').attr('action', $(this).data('url'));
    });
});
</script>
@endpush
