<div class="modal fade" id="modalDiambil" tabindex="-1" role="dialog" aria-labelledby="modalDiambilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDiambilLabel">
                    <i class="fas fa-envelope"></i> Pesan Patungan
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTransaksiDiambil" method="POST">
                @csrf
                <div class="modal-body">

                    <p class="text-muted">Apakah Pengguna sudah mengambil barang?</p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Sudah Diambil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function () {
    $('.btn-diambil').on('click', function () {
        $('#formTransaksiDiambil').attr('action', $(this).data('url'));
    });
});
</script>
@endpush
