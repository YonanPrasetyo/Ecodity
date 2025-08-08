<div class="modal fade" id="modalDiambil" tabindex="-1" role="dialog" aria-labelledby="modalDiambilLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">

        {{-- Header --}}
        <div class="modal-header">
          <h5 class="modal-title" id="modalDiambilLabel">
            <i class="fas fa-envelope"></i> Pesan Patungan
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        {{-- Form --}}
        <form id="formTransaksiDiambil" method="POST">
          @csrf

          {{-- Modal Body --}}
          <div class="modal-body p-0">

            {{-- Iframe scrollable manual, tetap tinggi tetap --}}
            <div class="embed-responsive" style="height: 60vh;">
              <iframe id="invoiceFrame" src="" class="embed-responsive-item" style="border: none;" allowfullscreen></iframe>
            </div>

            <div class="p-3 text-muted">
              Apakah Pengguna sudah mengambil barang?
            </div>

          </div>

          {{-- Modal Footer Tetap --}}
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

        $('#invoiceFrame').attr('src', $(this).data('url-pdf'));
    });
});
</script>
@endpush
