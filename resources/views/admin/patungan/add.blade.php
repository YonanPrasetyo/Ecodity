<div class="modal fade" id="modalAddPatungan" tabindex="-1" role="dialog" aria-labelledby="modalPatunganLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPatunganLabel">
                    <i class="fas fa-handshake"></i> Form Patungan
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPatungan" action="{{ route('admin.patungan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_komoditas">Komoditas</label>
                        <select class="form-control" id="id_komoditas" name="id_komoditas">
                            @foreach ($komoditas as $data)
                                <option value="{{ $data['id_komoditas'] }}">{{ $data['nama_komoditas'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="total">total kuota<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number"
                                   class="form-control"
                                   id="total"
                                   name="total"
                                   min="1"
                                   required
                                   placeholder="Masukkan total">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan-display"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-handshake"></i> Ikut Patungan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
