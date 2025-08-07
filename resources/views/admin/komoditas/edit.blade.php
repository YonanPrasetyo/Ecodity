<div class="modal fade" id="modalEditKomoditas" tabindex="-1" role="dialog" aria-labelledby="modalKomoditasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKomoditasLabel">
                    <i class="fas fa-handshake"></i> Edit Komoditas
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditKomoditas" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama_komoditas">Nama Komoditas<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="edit_nama_komoditas"
                                   name="nama_komoditas"
                                   min="1"
                                   required
                                   placeholder="Masukkan Nama Komoditas">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="satuan">Satuan<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="edit_satuan"
                                   name="satuan"
                                   min="1"
                                   required
                                   placeholder="Masukkan Satuan">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="harga_per_satuan">Harga Per Satuan<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number"
                                   class="form-control"
                                   id="edit_harga_per_satuan"
                                   name="harga_per_satuan"
                                   min="1"
                                   required
                                   placeholder="Masukkan Harga Per Satuan">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pabrik">Pabrik<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="edit_pabrik"
                                   name="pabrik"
                                   min="1"
                                   required
                                   placeholder="Masukkan Pabrik">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Komoditas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function () {
    $('.btn-edit-komoditas').on('click', function () {
        const namaKomoditas = $(this).data('nama-komoditas');
        const satuan = $(this).data('satuan');
        const harga = $(this).data('harga-per-satuan');
        const pabrik = $(this).data('pabrik');

        $('#edit_nama_komoditas').val(namaKomoditas);
        $('#edit_satuan').val(satuan);
        $('#edit_harga_per_satuan').val(harga);
        $('#edit_pabrik').val(pabrik);

        $('#formEditKomoditas').attr('action', $(this).data('url-update'));

        $('#modalEditKomoditas').modal('show');
    });
});
</script>
@endpush
