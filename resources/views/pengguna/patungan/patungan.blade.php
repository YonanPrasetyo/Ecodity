<!-- Modal Patungan -->
<div class="modal fade" id="modalPatungan" tabindex="-1" role="dialog" aria-labelledby="modalPatunganLabel" aria-hidden="true">
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
            <form id="formPatungan" action="{{  route('pengguna.transaksi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_patungan" name="id_patungan">
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id_user }}">
                    <input type="hidden" name="sisa" id="sisa">

                    <div class="alert alert-info">
                        <h6><strong id="komoditas-name"></strong></h6>
                        <small>Harga per <span id="satuan-text"></span>: Rp <span id="harga-text"></span></small><br>
                        <small>Sisa kebutuhan: <span id="sisa-text"></span> <span id="satuan-text-2"></span></small>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah yang ingin dipatungan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number"
                                   class="form-control"
                                   id="jumlah"
                                   name="total_patungan"
                                   min="1"
                                   required
                                   placeholder="Masukkan jumlah">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan-display"></span>
                            </div>
                        </div>
                        <small class="text-muted">Minimal 1 <span id="satuan-min"></span></small>
                    </div>

                    <div class="form-group">
                        <label for="total_harga">Total Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text"
                                   class="form-control"
                                   id="total_harga"
                                   readonly
                                   placeholder="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="opsi_pengiriman">Opsi Pengiriman</label>
                        <select class="form-control" id="opsi_pengiriman" name="opsi_pengiriman">
                            <option value="dikirim">Dikirim</option>
                            <option value="diambil">Diambil</option>
                            <option value="diinapkan">Diinapkan</option>
                        </select>
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


@section('js')
<script>
$(document).ready(function() {
    // Event handler untuk tombol patungan
    $('.btn-patungan').on('click', function() {
        const patunganId = $(this).data('id');
        const komoditas = $(this).data('komoditas');
        const satuan = $(this).data('satuan');
        const harga = $(this).data('harga');
        const sisa = $(this).data('sisa');

        // Set data ke modal
        $('#id_patungan').val(patunganId);
        $('#sisa').val(sisa);
        $('#komoditas-name').text(komoditas);
        $('#satuan-text, #satuan-text-2, #satuan-display, #satuan-min').text(satuan);
        $('#harga-text').text(new Intl.NumberFormat('id-ID').format(harga));
        $('#sisa-text').text(new Intl.NumberFormat('id-ID').format(sisa));

        // Set max jumlah berdasarkan sisa
        $('#jumlah').attr('max', sisa);

        // Reset form
        $('#jumlah').val('');
        $('#total_harga').val('');
        $('#catatan').val('');

        // Event handler untuk perhitungan total harga
        $('#jumlah').off('input').on('input', function() {
            const jumlah = parseFloat($(this).val()) || 0;
            const totalHarga = jumlah * harga;
            $('#total_harga').val(new Intl.NumberFormat('id-ID').format(totalHarga));
        });
    });

    // Validasi form sebelum submit
    $('#formPatungan').on('submit', function(e) {
        const jumlah = parseFloat($('#jumlah').val());
        const sisa = parseFloat($('#sisa-text').text().replace(/./g, ''));
        console.log(jumlah, sisa);

        if (jumlah > sisa) {
            e.preventDefault();
            alert('Jumlah tidak boleh melebihi sisa kebutuhan!');
            return false;
        }

        if (jumlah <= 0) {
            e.preventDefault();
            alert('Jumlah harus lebih dari 0!');
            return false;
        }
    });
});
</script>
@endsection
