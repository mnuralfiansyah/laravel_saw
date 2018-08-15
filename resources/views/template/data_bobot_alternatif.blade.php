@extends('template.app')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <!-- <div class="title_left">
                <h3>Users <small>Some examples to get you started</small></h3>
              </div> -->


            </div>

            <div class="clearfix"></div>

            <div class="row">
              @if(session('Berhasil'))
                  <div class="alert alert-success" id="peringatan">
                      {{ session('Berhasil') }}
                  </div>
              @endif

              @if(session('Gagal'))
                  <div class="alert alert-danger" id="peringatan">
                      {{ session('Gagal') }}
                  </div>
              @endif





              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Alternatif</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table  class="datatable-fixed-header table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          @foreach ($kriteria as $k => $v)
                            <th align="right">{{$v->nama}}</th>
                          @endforeach

                          <th>Aksi</th>
                        </tr>
                      </thead>


                      <tbody>

                        @foreach ($data_bobot_alternatif as $k => $v)
                          <tr>
                            <td>{{$k}}</td>
                              @foreach ($v as $i => $u)
                                <td align="right">{{$u['nilai']}}</td>
                              @endforeach
                            <td>
                                <button data-alternatif-id="{{$u['id']}}"
                                @foreach ($v as $i => $u) data-{{$i}}="{{$u['nilai']}}" @endforeach
                                   type="button"  class="btn btn-xs btn-warning btn-edit"
                                   data-toggle="modal" data-target=".modal-edit-bobot-alternatif"
                                   data-nama="{{$k}}">
                                  Edit
                                </button>
                            </td>
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
        <!-- modals -->
        <!-- Large modal -->


        <div class="modal fade modal-edit-bobot-alternatif" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><div id='modal_edit'></div></h4>
              </div>
              <div class="modal-body">
                <form id="edit_form" action="" method="post" data-parsley-validate class="form-horizontal form-label-left">
                  {{ method_field('PUT') }}
                  {{ csrf_field() }}

                  @php $a=0;@endphp
                @foreach ($data_bobot_alternatif as $k => $v)
                  @if($a==0)
                    @foreach ($v as $i => $u)

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{$u['nama_kriteria']}} <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="{{$i}}" type="text" id="data_{{$i}}" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      @php $a=2;@endphp
                    @endforeach
                  @endif

                @endforeach



                      {{-- <div class="ln_solid"></div> --}}

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
              </div>
              {{-- <div class="ln_solid"></div> --}}

            </div>
          </div>
        </div>

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
    $(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });

    //waktu mundur
    var detik = 5;
    var menit = 0;
    function hitung(){
      setTimeout(hitung,1000);
      detik --;

      if(detik < 0){
        detik = 59;
        menit --;
        if(menit < 0){
          menit = 0;
          detik = 0;
        }
        $('#peringatan').hide();
      }
    }
    hitung();
    });
    $(document).on('click','button.btn-edit', function()
    {
      @php $a=0;@endphp
    @foreach ($data_bobot_alternatif as $k => $v)
      @if($a==0)
        @foreach ($v as $i => $u)
          var data_{{$i}} = $(this).attr('data-{{$i}}');
          $('#data_{{$i}}').val(data_{{$i}});
          @php $a=2;@endphp
        @endforeach
      @endif

    @endforeach

    var action = '/data_bobot_alternatif/'+$(this).attr('data-alternatif-id');
      $("#edit_form").attr("action",action);

      isi_modal = $(this).attr('data-nama');
      $("#modal_edit").html(isi_modal);
    //
    // isi_modal = "Apakah Anda Yakin Menghapus Data Obat "+nama;
    //
    // $("#modal_hapus_pesan").html(isi_modal);
    // $("#hapus_form").attr("action",action);





    });
    </script>

  </body>
</html>
@endsection
