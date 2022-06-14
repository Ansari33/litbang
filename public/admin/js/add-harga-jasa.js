var cek_penjualan;
var table_pembelian;
var temp_pembelian = [];
var table_penjualan;
var table_penjualan_detail;
var table_add_penjualan_detail;
var table_data_penjualan_detail;
    //table_data_penjualan_detail
var temp_data_set = [];
var temp_total_harga = [];
var index = -1;
var pelanggan = [];
var detail_penjualan = [];
$('#add_pelanggan')
  .selectpicker({
    title: 'Pilih Pelanggan'
  }).selectpicker('refresh'); 
var pemasok =[];
$(function() {
 
 
  table_pembelian = $('#tbl_add_informasi_pembelian').DataTable({     
    
    "bDestroy": true,
    searching: false, paging: false, info: false,
    "columns": [
      
      { "name":"id_pemasok" },
      { "name":"pemasok" },
      { "name":"harga_pembelian" },
      { "name":"actions","width": "1%" },
    ]
    ,
    "columnDefs": [ {
        "targets": 0,
        "visible": false
     },
     {
          "targets": 2,
          "render": function (data, type, row) {
            return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }
      }]
     
  });

    table_edit_pembelian = $('#tbl_edit_informasi_pembelian').DataTable({     
    
    "bDestroy": true,
    searching: false, paging: false, info: false,
    "columns": [
      { "name":"id" },
      { "name":"id_pemasok" },
      { "name":"pemasok" },
      { "name":"harga_pembelian" },
      { "name":"actions" ,"width": "1%"},
    ]
    ,
    "columnDefs": [ {
        "targets": [0,1],
        "visible": false
     },
     {
          "targets": 3,
          "render": function (data, type, row) {
            return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }
      }
      ]
     
  });

  

  table_penjualan = $('#tbl_add_informasi_penjualan').DataTable({ 
    searching: false, paging: false, info: false,
    "bDestroy": true,  
      "columns": [
       
        { "name":"id_pelanggan" },
        { "name":"id_jenis_barang" },
        { "name":"id_tipe_pengiriman" },
        { "name":"pelanggan" },
        { "name":"jenis_barang" },
        { "name":"tipe_pengiriman" },          
        { "name":"opsi" },
        { "name":"persen" },
        { "name":"harga_penjualan" },
        { "name":"actions" },
      ]
      ,
      "columnDefs": [ {
          "targets": [0,1,2],
          "visible": false
       } ]

    });

   table_penjualan_detail = $('#tbl_informasi_detail').DataTable({     
   
   searching: false, paging: false, info: false,
    "bDestroy": true,
    "columns": [
       
        { "name":"id_pelanggan" },
        { "name":"pelanggan" },
        { "name":"total_harga" },
        { "name":"actions" },
      ]
      ,
      "columnDefs": [ {
          "targets": 0,
          "visible": false
       },{
          "targets": 2,
          "render": function (data, type, row) {
            return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }
      } ]

    });

    table_add_penjualan_detail = $('#tbl_add_informasi_detail').DataTable({ 
      dom:"tpr",
      paging:false,
       info: false,
      "bDestroy": true,
      deferRender: true,
      responsive:!0,
      select: {style: 'single'},
      sorting: [[1,"asc"]],
      pagingType: "full_numbers",
      language: {
        "zeroRecords": "Data tidak ditemukan...",
        "processing": '<span class="text-danger">Mengambil Data....</span>'
      },    
      "columns": [
        { "name":"id" },
        { "name":"id_pelanggan" },
        { "name":"id_paket" },
        { "name":"id_asal" },
        { "name":"id_tujuan" }, 
        { "name":"kode" },
        { "name":"pelanggan" },
        { "name":"produk_layanan" },
        { "name":"paket" },
        { "name":"asal" },
        { "name":"tujuan" },
        { "name":"harga" },
        { "name":"actions" },
      ]
      ,
      "columnDefs": [ {
          "targets": [0,1,2,3,4],
          "visible": false
       },{
          "targets": 11,
          "render": function (data, type, row) {
            return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }
      } ]

    });

    $('#tbl_data_penjualan_detail').on( 'click', 'tr', function () {
      if ( $(this).hasClass('selected') ) { 
          $(this).removeClass('selected');
      }
      else {
          table_data_penjualan_detail.$('tr.selected').removeClass('selected');
          $(this).addClass('selected');
      }
    } );  
});

function edit_detail_penjualan(pelanggan_id) {
    table_add_penjualan_detail.clear().draw();

    console.log(temp_data_set);
    console.log(pelanggan_id);
    console.log('sampai sini');
   $('#id_pelanggan_add ').val(pelanggan_id);
   $('#nama_pelanggan_add ').val(temp_total_harga[pelanggan_id][1]); 
   table_add_penjualan_detail.rows.add( temp_data_set[pelanggan_id] ).draw();
   $('#total_semua').html(table_add_penjualan_detail.column(11).data().sum().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
   console.log('Mematikan Pilihan = '+pelanggan_id);
   $('#add_pelanggan ').val(pelanggan_id).selectpicker('refresh');
    $("#add_pelanggan").prop("disabled", true);
    $(".selectpicker[data-id='add_pelanggan']").addClass("disabled");
  console.log($('#add_pelanggan').val());
  console.log($('#add_pelanggan option:selected').text());
    
    $('#modal_informasi_penjualan_detail').modal('show');

  }
function show_modal_penjualan(){
  $("#add_pelanggan_edit").prop("disabled", false);
  $(".selectpicker[data-id='add_pelanggan_edit']").removeClass("disabled");
  $("#add_pelanggan").prop("disabled", false);
  $(".selectpicker[data-id='add_pelanggan']").removeClass("disabled");
  $("#temp_pelanggan ").val('default').selectpicker("refresh");
  $("#temp_jenis_barang ").val('default').selectpicker("refresh");
  $("#temp_tipe_pengiriman ").val('default').selectpicker("refresh");
  // $("#temp_pemasok ")
//  $("#form-informasi-penjualan").trigger("reset");
  $('#modalpenjualan').modal('show');
}


  function tambah_informasi_penjualan(){
    if($("#temp_pelanggan option:selected").val() == '' || 
       $("#temp_jenis_barang option:selected").val() == '' || 
       $("#temp_tipe_pengiriman option:selected").val() == ''){
        notice('Data Belum Lengkap!','warning');
      }else{
        cek_penjualan = table_penjualan.column(0).data().toArray(); 
        if (cek_penjualan.includes($("#temp_pelanggan option:selected").val())) {
          notice('Data Pelanggan Sudah Ada!', 'warning');
          //console.log($("#temp_pelanggan option:selected").val());
        }else{
          table_penjualan.row.add( [ 
            $("#temp_pelanggan option:selected").val(), 
            $("#temp_jenis_barang option:selected").val(), 
            $("#temp_tipe_pengiriman option:selected").val(), 
            $("#temp_pelanggan option:selected").text(), 
            $("#temp_jenis_barang option:selected").text(), 
            $("#temp_tipe_pengiriman option:selected").text(),
            '<input type="button" onclick="set_total('+$("#temp_pelanggan option:selected").val()+')" value="Rp" class="btn btn-icon btn-primary" id="btn_opsi_'+$("#temp_pelanggan option:selected").val()+'" />',
            '<input name="" type="number" disabled="" class="form-control" placeholder="" id="persen_'+$("#temp_pelanggan option:selected").val()+'" onkeyup="set_total_persen('+$("#temp_pelanggan option:selected").val()+');"/>'+
            '<input name="opsi[]" value=0 type="hidden" disabled="" class="form-control" placeholder="" id="opsi_'+$("#temp_pelanggan option:selected").val()+'"/>',
            '<input name="harga_penjualan[]" type="text" class="form-control" placeholder="Harga" id="harga_'+$("#temp_pelanggan option:selected").val()+'"/>',
            '<button class="btn btn-icon" id="delete_penjualan" onclick="delete_to_detail('+$("#temp_pelanggan option:selected").val()+');"><i class="fa fa-trash" onclick="delete_to_detail('+$("#temp_pelanggan option:selected").val()+');"></i></button>' ] )
            .draw();

            var pelanggan = parseInt($("#temp_pelanggan option:selected").val());
            temp_total_harga[pelanggan] = [
              $("#temp_pelanggan option:selected").val(),
              $("#temp_pelanggan option:selected").text(),
              0,
              '<input type="hidden" value="0" id="total_'+pelanggan+'"><button class="btn btn-icon" onclick="edit_detail_penjualan('+
              pelanggan+');"><i class="fa fa-edit"></i></button>'
            ];

            table_penjualan_detail.clear().draw();
            temp_total_harga.forEach(function (item, index) { 
              table_penjualan_detail.row.add(item).draw();
              console.log(item);
            });
            if ($("#add_pelanggan option[value='"+pelanggan+"']").length == 0) {
              $("#add_pelanggan").append('<option value="'+pelanggan+'">'+$("#temp_pelanggan option:selected").text()+'</option>');
            }
            $("#temp_pelanggan ").selectpicker("refresh");
            table_add_penjualan_detail.clear().draw();
            temp_data_set[pelanggan] = table_add_penjualan_detail.data();
            detail_penjualan[pelanggan] = null;
            var id_harga = "harga_"+pelanggan;
            price_format(id_harga);
          }
      }
      console.log(table_penjualan.data().toArray());
      $("#temp_pelanggan ").val('default').selectpicker("refresh");
      $("#temp_jenis_barang ").val('default').selectpicker("refresh");
      $("#temp_tipe_pengiriman ").val('default').selectpicker("refresh");
      // $("#temp_pemasok ")
    //  $("#form-informasi-penjualan").trigger("reset");

    }

  function edit_tambah_informasi_penjualan(){
    if($("#temp_pelanggan option:selected").val() == '' || 
       $("#temp_jenis_barang option:selected").val() == '' || 
       $("#temp_tipe_pengiriman option:selected").val() == ''){
        notice('Data Belum Lengkap!','warning');
      }else{
        cek_penjualan = table_penjualan.column(0).data().toArray(); 
        if (cek_penjualan.includes($("#temp_pelanggan option:selected").val())) {
          notice('Data Pelanggan Sudah Ada!', 'warning');
          //console.log($("#temp_pelanggan option:selected").val());
        }else{
          table_penjualan.row.add( [ 
            $("#temp_pelanggan option:selected").val(), 
            $("#temp_jenis_barang option:selected").val(), 
            $("#temp_tipe_pengiriman option:selected").val(), 
            $("#temp_pelanggan option:selected").text(), 
            $("#temp_jenis_barang option:selected").text(), 
            $("#temp_tipe_pengiriman option:selected").text(),
            '<input type="button" onclick="set_total('+$("#temp_pelanggan option:selected").val()+')" value="Rp" class="btn btn-icon btn-primary" id="btn_opsi_'+$("#temp_pelanggan option:selected").val()+'" />',
            '<input name="" type="number" disabled="" class="form-control" placeholder="" id="persen_'+$("#temp_pelanggan option:selected").val()+'" onkeyup="set_total_persen('+$("#temp_pelanggan option:selected").val()+');"/>'+
            '<input name="opsi[]" value=0 type="hidden" disabled="" class="form-control" placeholder="" id="opsi_'+$("#temp_pelanggan option:selected").val()+'"/>',
            '<input name="harga_penjualan[]" type="text" class="form-control" placeholder="Harga" id="harga_'+$("#temp_pelanggan option:selected").val()+'"/>',
            '<button class="btn btn-icon" id="delete_penjualan" onclick="delete_to_detail('+$("#temp_pelanggan option:selected").val()+');"><i class="fa fa-trash" onclick="delete_to_detail('+$("#temp_pelanggan option:selected").val()+');"></i></button>' ] )
            .draw();

            var pelanggan = parseInt($("#temp_pelanggan option:selected").val());
            temp_total_harga[pelanggan] = [
              $("#temp_pelanggan option:selected").val(),
              $("#temp_pelanggan option:selected").text(),
              0,
              '<input type="hidden" value="0" id="total_'+pelanggan+'"><button class="btn btn-icon" onclick="edit_detail_penjualan_edit('+
              pelanggan+');"><i class="fa fa-edit"></i></button>'
            ];
            
            table_penjualan_detail.clear().draw();
            temp_total_harga.forEach(function (item, index) { 
              table_penjualan_detail.row.add(item).draw();
              console.log(item);
            });
            if ($("#add_pelanggan option[value='"+pelanggan+"']").length == 0) {
              $("#add_pelanggan").append('<option value="'+pelanggan+'">'+$("#temp_pelanggan option:selected").text()+'</option>');
            }
            $("#temp_pelanggan ").selectpicker("refresh");
            table_add_penjualan_detail.clear().draw();
            temp_data_set[pelanggan] = table_add_penjualan_detail.data();
            detail_penjualan[pelanggan] = null;
            var id_harga = "harga_"+pelanggan;
            price_format(id_harga);
          }
      }
      console.log(table_penjualan.data().toArray());
      $("#temp_pelanggan ").val('default').selectpicker("refresh");
      $("#temp_jenis_barang ").val('default').selectpicker("refresh");
      $("#temp_tipe_pengiriman ").val('default').selectpicker("refresh");
      // $("#temp_pemasok ")
    //  $("#form-informasi-penjualan").trigger("reset");

    }

function delete_pembelian_data(id) {
 console.log(temp_pembelian[id]);
 delete temp_pembelian[id];
 delete edit_temp_pembelian[id]; 
 console.log(temp_pembelian[id])
}

function delete_to_detail(id){
console.log("menghapus isi detail pelanggan : "+id);
 delete temp_total_harga[id];
 delete temp_data_set[id];
 delete detail_penjualan[id];

  table_penjualan_detail.clear().draw();

  temp_total_harga.forEach(function (item, index) { 
    table_penjualan_detail.row.add(item).draw();
  });
}

  function set_total(params) {
    var btn = "#btn_opsi_"+params;
    var persen = "#persen_"+params;
    var harga = "#harga_"+params;
    var opsi = "#opsi_"+params;
    var total = "#total_"+params;
  
    
    if ($(btn).val() == '%') {
      
      $(btn).val('Rp');
      $(opsi).val(0);
      $(persen).prop("disabled",true);
      $(harga).prop("disabled",false);


       //price_format(harga);
      console.log(temp_total_harga[params]);
      console.log('pelanggan = '+params);
      console.log('opsi = '+$(opsi).val());
      console.log('persen = '+$(opsi).val());
      console.log('harga total = '+$(total).val());
      var total_baru= $(total).val();
     
      
    }else{
      
      $(btn).val('%');
      $(opsi).val(1);
      $(persen).prop("disabled",false);
      $(harga).prop("disabled",true);
      var total_persen = $(persen).val();
      var total_baru= parseInt( $(total).val() ) * total_persen /100 ;

      //var total_temp =(total_persen/100) * $(harga).val();
      

      console.log('pelanggan = '+params);
      console.log('opsi = '+$(opsi).val());
      console.log('persen = '+$(opsi).val());
      console.log('harga total = '+$(total).val());
      console.log('harga temp total = '+total_temp);

      
    }
  }

  function set_total_persen(params) {
    // body...
    var btn = "#btn_opsi_"+params;
    var persen = "#persen_"+params;
    var harga = "#harga_"+params;
    var opsi = "#opsi_"+params;
    var total = "#total_"+params;

    var jumlah_persen = $(persen).val();
    console.log(jumlah_persen);
    var total_persen = parseInt( $(total).val() ) * parseInt( jumlah_persen ) /100 ;
    console.log(total_persen);
    console.log($(total).val());
    var total_baru = total_persen+parseInt($(total).val());
    console.log(total_baru);
    //$(harga).val(total_baru);

  }

  $('#tbl_add_informasi_pembelian').on("click", "#delete_pembelian", function () {
      table_pembelian.row($(this).parents('tr')).remove().draw(false);

    });
   $('#tbl_edit_informasi_pembelian').on("click", "#delete_edit_pembelian", function () {
      table_edit_pembelian.row($(this).parents('tr')).remove().draw(false);
    });
  $('#tbl_add_informasi_penjualan').on("click", "#delete_penjualan", function () {
      table_penjualan.row($(this).parents('tr')).remove().draw(false);
     
    });
  $('#tbl_add_informasi_detail').on("click", "#delete_detail_penjualan", function () {
      table_add_penjualan_detail.row($(this).parents('tr')).remove().draw(false);
  });
  $('#tbl_informasi_detail').on("click", "#delete_total", function () {    
      table_penjualan_detail.row($(this).parents('tr')).remove().draw(false);
  });
  $('#btn_add_penjualan').on("click", function () {
   
    if (table_penjualan.rows().count() == 0) {
      $("#modal_informasi_penjualan_detail").modal("hide");
      notice('Data Penjualan Masih Kosong!', 'warning');
    }else{
   //$('#pilihan_pelanggan').html();
   //$('#add_pelanggan').selectpicker('show');
    $('#total_semua').html(0);
    console.log('Mengaktifkan Pilihan  Pelangan!! ');
    //$('#add_pelanggan').prop('disabled', false);
    $(".selectpicker[data-id='add_pelanggan']").removeClass("disabled");
    
    //$('#add_pelanggan').disabled="disabled";

      table_add_penjualan_detail.clear().draw();
        
        $('#add_pelangggan').selectpicker('destroy');
        $('#add_pelangggan').empty();
        $('#add_pelangggan').find('option')
        .remove()
        .end();
        $('#add_pelanggan').selectpicker('refresh');
        console.log(table_penjualan.data().toArray());
        $.each(table_penjualan.data().toArray(), function(key, value) {
         if ($("#add_pelanggan option[value='"+value[0]+"']").length == 0) {
            $("#add_pelanggan")
            .append('<option value="'+value[0]+'">'+value[3]+'</option>');
         }
        console.log(value[0]+value[3]);
        $('#add_pelanggan').selectpicker('refresh');
        });
      $("#modal_informasi_penjualan_detail").modal("show");
      // table_data_penjualan_detail.ajax.reload();
    }
  });
  function tambah_data_penjualan(tipe) {
    var data;
    if (tipe == 'add') {
      data = table_data_penjualan_detail_add.row('.selected').data();
    }else if(tipe == 'edit'){
      data = table_data_penjualan_detail_edit.row('.selected').data();
    }
     
     console.log(data)
     var row_data = [
      data.id,
      data.pemasok_id,
      data.paket_id,
      data.asal_id,
      data.tujuan_id,
      data.kode,
      data.pemasok,
      data.produk_layanan,
      data.paket,
      data.asal,
      data.tujuan,
      data.harga,
      '<button class="btn btn-icon" id="delete_detail_penjualan"><i class="fa fa-trash"></i></button>'] ;
     
     table_add_penjualan_detail.row.add( row_data )
      .draw();   
     $('#total_pembelian').html("Rp "+table_add_penjualan_detail.column( 11 ).data().sum());
      $('#total_semua').html(table_add_penjualan_detail.column( 11 ).data().sum().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      notice('Data Ditambah!','success');
    //  $("#modal_tabel_penjualan_detail").modal("hide");
  }
  

  $('#add_total_harga').on("click", function () {
        new_temp_total_harga = table_penjualan_detail.data().toArray();
        console.log(new_temp_total_harga);
        $.each( new_temp_total_harga, function( key, value ) {
        var pell= value[0];
        temp_total_harga[pell] = value;

      });
        var pelanggan = parseInt($('#id_pelanggan_add').val());
        console.log('data set baru pelanggan '+pelanggan);
        temp_data_set[pelanggan] = table_add_penjualan_detail.data().toArray();
        console.log(temp_data_set[pelanggan]);
        
        var data_baru = 
            [pelanggan,$('#nama_pelanggan_add').val(),
            table_add_penjualan_detail.column( 11 ).data().sum(),
            '<input type="hidden" value="'+table_add_penjualan_detail.column( 11 ).data().sum()+'" id="total_'+pelanggan+'"><button class="btn btn-icon" onclick="edit_detail_penjualan('+
              pelanggan+');"><i class="fa fa-edit"></i></button>'];
        console.log("Data Detail Terbaru Pelanggan "+pelanggan);
        console.log(data_baru);
        detail_penjualan[pelanggan] =  table_add_penjualan_detail.column(0).data().toArray();
        console.log("Isi Detail Pelanggan "+pelanggan);
        console.log(detail_penjualan[pelanggan]);

        temp_total_harga[pelanggan] = data_baru;
        table_penjualan_detail.clear().draw();

        temp_total_harga.forEach(function (item, index) { 
          table_penjualan_detail.row.add(item).draw();
        });
       
       var harga = "#harga_"+pelanggan;
       // $(harga).val(table_add_penjualan_detail.column( 10 ).data().sum());
 
   });

  var validation;
  validation = FormValidation.formValidation(
    KTUtil.getById('form-add-informasi-pembelian'),
    {
      fields: {
        temp_pemasok: {
          validators: {
            notEmpty: {
              message: 'Pemasok Harus Dipilih'
            },
          }
        },

        temp_harga_beli: {
          validators: {
            notEmpty: {
              message: 'Harga Beli Tidak Boleh Kosong'
            },
          }
        },

      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap(),
        submitButton: new FormValidation.plugins.SubmitButton(),
        }
      }
    }

  );

  $('#add_pembelian').on('click', function (e) {
    e.preventDefault();
    validation.validate().then(function (status) {
      if (status == 'Valid') {
      }
  });
  });

 
