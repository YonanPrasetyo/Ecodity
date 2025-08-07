<div class="modal fade" id="modalAddKomoditas" tabindex="-1" role="dialog" aria-labelledby="modalKomoditasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKomoditasLabel">
                    <i class="fas fa-handshake"></i> Form Komoditas
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formKomoditas" action="{{ route('admin.komoditas.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama_komoditas">Nama Komoditas<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="nama_komoditas"
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
                                   id="satuan"
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
                                   id="harga_per_satuan"
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
                                   id="pabrik"
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
                        <i class="fas fa-plus"></i> Tambah Komoditas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
