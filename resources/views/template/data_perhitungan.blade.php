@extends('template.app')

@section('content')
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <!-- <div class="title_left">
                <h3>Users <small>Some examples to get you started</small></h3>
              </div> -->


            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Nilai Kriteria Per Alternatif</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table  class="datatable-fixed-header table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama Alternatif</th>
                          @foreach ($kriteria as $k => $v)
                            <th align="center" nowrap>{{$v->nama}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data_bobot_alternatif as $k => $v)
                          <tr>
                            <td align="center">{{$k}}</td>
                              @foreach ($v as $i => $u)
                                <td align="right" nowrap>{{$u['nilai']}}</td>
                              @endforeach
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Normalisasi Kriteria Per Alternatif</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table  class="datatable-fixed-header table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama Alternatif</th>
                          @foreach ($kriteria as $k => $v)
                            <th align="center" nowrap>{{$v->nama}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data_normalisasi_alternatif as $k => $v)
                          <tr>
                            <td align="center">{{$k}}</td>
                              @foreach ($v as $i => $u)
                                <td align="right" nowrap>{{$u['nilai']}}</td>
                              @endforeach
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Kriteria Pembobotan</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table  class="datatable-fixed-header table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th align="center">Kriteria</th>
                          <th align="center">Kepentingan</th>
                          <th align="center">Jenis</th>
                          <th align="right">Bobot</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($bobot_kriteria as $k => $v)
                          <tr>
                                <td align="center" nowrap>{{$v->nama}}</td>
                                <td align="center" nowrap>    @if($v->bobot==5) Sangat Penting
                                                              @elseif($v->bobot==4) Penting
                                                              @elseif($v->bobot==3) Kurang Penting
                                                              @elseif($v->bobot==2) Tidak Penting
                                                              @else Sangat Tidak Penting
                                                              @endif</td></td>
                                <td align="center">@if($v->benefit) Benefit @else Cost @endif </td>
                                <td align="right">{{($v->nilai)*100}}%</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Perkalian Kriteria dengan Pembobot</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table  class="datatable-fixed-header table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama Alternatif</th>
                          @foreach ($kriteria as $k => $v)
                            <th align="center" nowrap>{{$v->nama}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($perkalian as $k => $v)
                          <tr>
                            <td align="center">{{$k}}</td>
                              @foreach ($v as $i => $u)
                                <td align="right" nowrap>{{$u['nilai']}}</td>
                              @endforeach
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hasil</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table  class="datatable-fixed-header table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th align="center">Ranking</th>
                          <th align="center">Nama</th>
                          <th align="center">Nilai</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($hasil as $k => $v)
                          <tr>
                                <td align="center" nowrap>{{$v->ranking}}</td>
                                <td align="center" nowrap>{{$v->alternatif->nama}}</td>
                                <td align="center" nowrap>{{$v->nilai}}</td>

                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>



          </div>
        </div>
        <!-- /page content -->



        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="/template/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/template/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/template/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/template/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="/template/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="/template/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/template/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script src="/template/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>

    <script src="/template/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/template/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/scroller/1.4.2/js/dataTables.scroller.min.js"></script>
    <script src="/template/jszip/dist/jszip.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/template/js/custom.min.js"></script>

    <script>



    </script>

  </body>
</html>
@endsection
