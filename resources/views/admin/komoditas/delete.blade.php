<div class="modal fade" id="modalDeleteKomoditas" tabindex="-1" role="dialog" aria-labelledby="modalKomoditasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKomoditasLabel">
                    <i class="fas fa-handshake"></i> Delete Komoditas
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDeleteKomoditas" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus Komoditas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function () {
    $('.btn-delete-komoditas').on('click', function () {
        console.log($(this).data('url-delete'));

        $('#formDeleteKomoditas').attr('action', $(this).data('url-delete'));

        $('#modalDeleteKomoditas').modal('show');
    });
});
</script>
@endpush
