<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        .table1 {
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }

        .table1, th, td {
            border: 1px solid #999;
            padding: 8px 20px;
        }

        .table2 {
            font-family: sans-serif;
            color: #444;
            border-collapse: collapse;
            width: 50%;
            border: 1px solid #f2f5f7;
        }

        .table2 tr th{
            background: #35A9DB;
            color: #fff;
            font-weight: normal;
        }

        .table2, th, td {
            padding: 8px 20px;
            text-align: center;
        }

        .table2 tr:hover {
            background-color: #f5f5f5;
        }

        .table2 tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div align="center">
        <h1><b>KIEPHOTO</b></h1>
        <hr>
        Halo {{$pemesanan_mail->nama_lengkap}} <br>
        Pesanan kamu sudah tercatat, silahkan melakukan pembayaran 1x24 jam <br>
        No. Order: {{$pemesanan_mail->kode_pemesanan}} <br>
        <hr>
    </div>

    <div align="center">
        <h2><b>Detail Pemesanan</b></h2>
        <table cclass="table1">
            <tr>
                <th>Paket</th>
                <th>Tipe</th>
                <th>Jumlah Orang</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>{{$pemesanan_mail->nama_paket}}</td>
                <td>{{$pemesanan_mail->nama_tipe_paket}}</td>
                <td>{{$pemesanan_mail->jumlah_orang}} Orang</td>
                <td>Rp. <?=number_format($pemesanan_mail->total_bayar, 0, ".", ".")?>,00</td>
            </tr>
        </table>
    </div><br><hr>

    <div align="center">
       <table class="table2" >
           <tr>
               <td>
                   Pembayaran dapat dilakukan dengan DP minimal Rp. <?=number_format($pemesanan_mail->min_dp, 0, ".", ".")?>,00 <br>
                   atau lunas sesuai dengan kolom total
               </td>
               <td>
                   Lakukan pembayaran sebelum 1x24 jam <br>
                   segera lakukan konfirmasi view web, sebelum batas waktu yang ditentukan <br>
               </td>
           </tr>
       </table>
   </div><br>
   <div align="center">
       
      <table class="table2" >
           <tr>
               <td>
                   <b>BCA</b> <br>
                   A/n kiephoto <br>
                   <b>no rekening. 7282-2827-2828</b>
               </td>
           </tr>
       </table>
   </div>
   </div>

</body>
</html>