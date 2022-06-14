var tabel_add_detail;
var tabel_harga_jasa;

$(function () {
  
  tabel_harga_jasa = $('#tbl_add_detail_harga_pengiriman_penawaran_penjualan').DataTable({
    processing: true,
     serverSide: true,
     "ajax": {
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
       url:'/master-data/harga-jasa/penjualan',
       type:'POST',
       data:{pelanggan_id:pelanggan}
     },
    "columns": [
      { data:"id","name":"id" },
      { data:"harga_jasa_id","name":"harga_jasa_id" },
      { data:"pelanggan_id","name":"id_pelanggan" },
      { data:"paket_id","name":"id_paket" },
      { data:"asal_id","name":"id_asal" },
      { data:"tujuan_id","name":"id_tujuan" },
      { data:"kode","name":"kode" },
      { data:"pelanggan","name":"pelanggan" },
      { data:"paket","name":"paket" },
      { data:"asal","name":"asal" },
      { data:"tujuan","name":"tujuan" },
      { data:"harga","name":"harga" },
    
    ]
    ,
    "columnDefs": [ {
        "targets": [],
        "visible": false
     } ]
  
  });
  
  tabel_add_detail = $("#tbl_add_detail_penawaran_penjualan").DataTable({
    "columns": [
      { "name":"harga_jasa_id" },
      { "name":"kode_pajak" },
      { "name":"kuantitas" },
      { "name":"harga" },
      { "name":"actions" },
    ]
    ,
    "columnDefs": [ {
        "targets": [],
        "visible": false
     } ]
  
  });
  
  $.fn.dataTable.Api.register('column().title()', function () {
    return $(this.header()).text().trim();
  });
  $('.selectpicker').selectpicker();
  var pelanggan = $("#pelanggan option:selected").val();

  $('#btn_simpan_detail_penawaran_penjualan_baru').on( 'click', function () {
    data = tabel_harga_jasa.row(".selected").data();
    //console.log(data);
    console.log(tabel_add_detail);
    tabel_add_detail.row.add([
    data.harga_jasa_id,
    `<select name="kode_pajak_add_data" onchange="" class="form-control selectpicker" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body">\
      @foreach($kode_pajak as $key => $pajak)\
        <option value="{{ $pajak['id'] }}" nilai="{{ $pajak['nilai'] }}">{{ $pajak['nama'] }}</option>\
      @endforeach\
    </select>`,
    '<input type="number" class="form-control kuantitas_add_data" value="1"/>',
    '<input type="text" class="form-control harga_add_data" value="" placeholder=""/>',
    '<button class="btn btn-icon" id="delete"><i class="fa fa-trash"></i></button>'
  ]).draw();
  console.log(tabel_add_detail.data());
  console.log('setalah input');
  $('.selectpicker').selectpicker();
  $('#modal_penawaran_penjualan').modal('hide');
  } );

  $('#tbl_add_detail_penawaran_penjualan').on("click", "#delete", function () {
    tabel_add_detail.row($(this).parents('tr')).remove().draw(false);
  });

 
});


function show_add_detail_penawaran_penjualan() {
  if ($('#pelanggan').val() == '') {
      $("#modal_penawaran_penjualan").modal("hide");
      notice('Belum Memilih Pelanggan!', 'warning');
  } else {
    tabel_harga_jasa.ajax.reload();
    $("#modal_penawaran_penjualan").modal("show");
    $('#tbl_add_detail_harga_pengiriman_penawaran_penjualan').on( 'click', 'tr', function () {
      if ( $(this).hasClass('selected') ) {
          $(this).removeClass('selected');
      }
      else {
        tabel_harga_jasa.$('tr.selected').removeClass('selected');
          $(this).addClass('selected');
     }
  });
  }
}





    