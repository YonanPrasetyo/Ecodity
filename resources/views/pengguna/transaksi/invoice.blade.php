<div class="modal fade" id="modalInvoice" tabindex="-1" role="dialog" aria-labelledby="modalInvoiceLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document"> {{-- ukuran lebih besar untuk PDF --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInvoiceLabel">
                    <i class="fas fa-file-invoice"></i> Invoice Transaksi
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" style="height: 80vh">
                <iframe id="invoiceFrame" src="" width="100%" height="100%" style="border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function () {
        $('#modalInvoice').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang membuka modal
            var url = button.data('url'); // Ambil URL dari data-url
            $('#invoiceFrame').attr('src', url); // Set URL ke dalam iframe
        });

        $('#modalInvoice').on('hidden.bs.modal', function () {
            $('#invoiceFrame').attr('src', ''); // Kosongkan iframe setelah modal ditutup
        });
    });
</script>
@endpush
