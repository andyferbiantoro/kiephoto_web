@extends('layouts.app_admin')

@section('title')
Dashboard Admin
@endsection


@section('content') 


 <div class="row match-height">
                        <!-- Greetings Card starts -->
                        <div class="col-12">
                            <div class="card card-congratulations">
                                <div class="card-body text-center">
                                  
                                    
                                    <div class="text-center">
                                     <div class="panel">
                                        <div id="chartpelanggan"></div>                                
                                  </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>

@endsection   

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
  Highcharts.chart('chartpelanggan', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Grafik Pemesanan Tahun Ini'
    },
    subtitle: {
      text: 'KIEPHOTO'
    },
    xAxis: {
      categories: [
      'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember',
      ],
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Banyak Pemesanan'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: 
      '<td style="padding:0"><b>{point.y}Pemesanan</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: [{
      name: 'Bulan',
      data: [{{$januari}},{{$februari}},{{$maret}},{{$april}},{{$mei}},{{$juni}},{{$juli}},{{$agustus}},{{$september}},{{$oktober}},{{$november}},{{$desember}}]

    }]
  });
</script>
@endsection                 
