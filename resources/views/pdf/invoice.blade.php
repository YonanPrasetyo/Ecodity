<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            padding: 20px;
            background: #fff;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 30px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2c3e50;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 5px;
        }

        .judul {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 12px;
            color: #7f8c8d;
            font-style: italic;
        }

        /* Transaction Info */
        .transaction-info {
            margin-bottom: 30px;
            background: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
        }

        .kode-box {
            margin-bottom: 20px;
        }

        .kode-box:last-child {
            margin-bottom: 0;
        }

        .kode-label {
            font-size: 13px;
            color: #7f8c8d;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .kode-value {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            padding: 12px 16px;
            background: #fff;
            border: 2px solid #bdc3c7;
            border-radius: 6px;
            letter-spacing: 0.5px;
        }

        /* Main Content */
        .content {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            padding: 8px 0;
            border-bottom: 2px solid #ecf0f1;
            text-transform: uppercase;
        }

        /* Table Styles */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .info-table th {
            background: #34495e;
            color: #fff;
            font-weight: bold;
            text-align: left;
            padding: 12px 15px;
            font-size: 12px;
            text-transform: uppercase;
            width: 35%;
        }

        .info-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ecf0f1;
            font-size: 12px;
            background: #fff;
        }

        .info-table tr:last-child td {
            border-bottom: none;
        }

        .info-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .info-table tr:nth-child(even) td {
            background-color: #f8f9fa;
        }

        /* Highlight important values */
        .price-highlight {
            font-weight: bold;
            color: #27ae60;
            font-size: 13px;
        }

        .status-active {
            color: #27ae60;
            font-weight: bold;
            text-transform: capitalize;
        }

        .status-pending {
            color: #f39c12;
            font-weight: bold;
            text-transform: capitalize;
        }

        .status-cancelled {
            color: #e74c3c;
            font-weight: bold;
            text-transform: capitalize;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #ecf0f1;
            text-align: center;
            color: #7f8c8d;
            font-size: 11px;
        }

        .footer-note {
            margin-bottom: 10px;
            font-style: italic;
        }

        .generated-time {
            font-size: 10px;
            color: #95a5a6;
        }

        /* Print styles */
        @media print {
            body {
                padding: 0;
            }

            .container {
                box-shadow: none;
                padding: 0;
            }

            .info-table {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">ECODITY</div>
            <div class="judul">Invoice Transaksi</div>
            <div class="subtitle">Platform Patungan Komoditas</div>
        </div>

        <!-- Transaction Codes -->
        <div class="transaction-info">
            <div class="kode-box">
                <div class="kode-label">Kode Transaksi</div>
                <div class="kode-value">{{ $transaksi->kode_transaksi }}</div>
            </div>
            <div class="kode-box">
                <div class="kode-label">Kode Patungan</div>
                <div class="kode-value">{{ $transaksi->patungan->kode_patungan }}</div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="section-title">Detail Transaksi</div>

            <table class="info-table">
                <tr>
                    <th>Nama Pengguna</th>
                    <td>{{ $transaksi->user->nama }}</td>
                </tr>
                <tr>
                    <th>Komoditas</th>
                    <td>{{ $transaksi->patungan->komoditas->nama_komoditas }}</td>
                </tr>
                <tr>
                    <th>Nama Pabrik</th>
                    <td>{{ $transaksi->patungan->komoditas->pabrik }}</td>
                </tr>
                <tr>
                    <th>Total Patungan</th>
                    <td class="price-highlight">{{ $transaksi->total_patungan }} {{ $transaksi->patungan->komoditas->satuan }}</td>
                </tr>
                <tr>
                    <th>Harga Total Komoditas</th>
                    <td class="price-highlight">Rp {{ number_format($transaksi->patungan->harga_total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Opsi Pengiriman</th>
                    <td>{{ ucfirst($transaksi->opsi_pengiriman) }}</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-note">
                Terima kasih telah menggunakan layanan Ecodity
            </div>
            <div class="generated-time">
                Invoice dibuat pada: {{ date('d F Y, H:i:s') }}
            </div>
        </div>
    </div>
</body>
</html>
