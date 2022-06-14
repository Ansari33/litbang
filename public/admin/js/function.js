var host = $('meta[name="host_url"]').attr('content');
var SNdata = [];
var BarangForShipping = [];
var value;
var tamps_value_stok = [];

function DatatableInit(tablename,dateFormat,currency) {
    var targetsDateFormat = {};
    if (dateFormat != null) {
        targetsDateFormat = {
            targets: dateFormat,
            render: function(data, type, row) {
            return moment(data).format('DD MMM YYYY');
            }
        }
    }

   TableData =   $(`#${tablename}`).DataTable({
        dom: 't',
        pageLength: -1,
        responsive:true,
        colReorder:!0,
        stateSave: !1,
        lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]],
        language: {
            "lengthMenu": " _MENU_ ",
            "zeroRecords": "Belum ada data",
        },
        order: [],
        columnDefs: [
          {
            "defaultContent": "-",
            "targets": [4],
          },
          {
                targets: 0,
                className: "text-center",
                orderable:      true,
                data:           null,
                defaultContent: ''
          },
          {
            targets: 0,
            className: "text-center",
            orderable:      true,
            data:           null,
            defaultContent: ''
          },
          {
            targets : [1,2,3],
            visible : false,
          },
          targetsDateFormat,
        ],
      });

      $(`#${tablename} tbody`).on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = TableData.row( tr );


        if ( row.child.isShown() ) {
          TableData.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
            tr.removeClass('shown');
        }
        else {
          TableData.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
            tr.addClass('shown');
        }
      });

     this.tableInit = TableData; 
}


function datatableInitAjaxJadwalPengiriman(tablename,url) {

    $(`#${tablename} thead tr`).first().clone().appendTo( `#${tablename} thead`);
    $(`#${tablename} thead tr:eq(1) th`).each( function (i) {
        console.log(i)
       var title = $(this).text();
        if (title == 'ID') {
          $(this).html( '' );
        }else{
          $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
       }
 
        $( 'input', this ).on( 'keypress', function (e) {
            
            if ( e.which == 13 ) {
               table.column(i).search( this.value ).draw();
            }
        });
   });
 
   table =  $(`#${tablename}`).DataTable({
        orderCellsTop: true,
        dom:"tpr",
        rowId: 'id',
        pageLength:20,
        processing: true,
        serverSide: true,
        ajax: {
          url:host+'/'+url,
          async: true,
          error: function (res) {
            $('.dataTables_processing').hide();
            notice(res.responseJSON.message, 'error');
          }
        },
        select: {style: 'single'},
        language: {
          "zeroRecords": "Data tidak ditemukan...",
          "processing": '<span class="text-danger">Mengambil Data....</span>'
        },
        columns: [
          { data: 'id' },
          { data: 'nomor' },
          { data: 'alat_transportasi' },
          { data: 'asal' },
          { data: 'tujuan' },
          { data: 'tanggal_pembukaan' },
          { data: 'tanggal_penutupan' },
          { data: 'voyage_flight_trip' },
        ],
        columnDefs: [
          {
            "defaultContent": "-",
            "targets": "_all"
          },
          {
            "targets": [5,6],
            "render": function(data, type, row) {
              return moment(data).format('DD MMM YYYY');
            }
          },
          {
            targets: 0,
            width: '30px',
            className: 'dt-left',
            orderable: false,
            searchable: false,
            visible:false,
          },
          {
            targets: 7,
            width: '10px',
          }
        ]
      });

      return table;
}

function dataTableAjaxBarangJasaList(tablename,url) {
    console.log(tablename);

    $(`#${tablename} thead tr`).first().clone(false).appendTo(`#${tablename} thead`);
    $(`#${tablename} thead tr:eq(1) th`).each(function (i) {
        var title = $(this).text();
        if (title == 'ID') {
          $(this).html( '' );
        }else{
          $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
        }
 
        $( 'input', this ).on( 'keypress  ', function (e) {
            if ( e.which == 13 ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    });

    table = $(`#${tablename}`).DataTable({
        orderCellsTop: true,
        dom:"tpr",
        rowId: 'id',
        pageLength:5,
  
        processing: true,
        serverSide: true,
        ajax: {
          url:host+'/'+url,
          async: true,
          error: function (res) {
            $('.dataTables_processing').hide();
            notice(res.responseJSON.message, 'error')
          }
        },
        deferRender: true,
        responsive:!0,
        select: {style: 'single'},
        sorting: [[1,"asc"]],
        pagingType: "full_numbers",
        language: {
          "zeroRecords": "Data tidak ditemukan...",
          "processing": '<span class="text-danger">Mengambil Data....</span>'
        },
        lengthMenu: [[10, 40, 50, 100], [10, 20, 50, 100]],
        columns: [
          { data: 'id' },
          { data: 'kode' },
          { data: 'kategori' },
          { data: 'keterangan' }
        ],
        columnDefs: [
          {
            "defaultContent": "-",
            "targets": "_all"
          },
          {
            targets: 0,
            visible: false,
            searchable: false
          }
        ]
      });

    return table;
}



function rowAddBarangJasaList(hargajasalist,table,type,kodePajakElement,subType) {
    
      data = hargajasalist.row(".selected").data();
      console.log(data);
      console.log(subType);
      var keterangan = '-';
      var produkServis = '-';
      var paketId = '-';
      var asalId = '-';
      var tujuanId = '-'; 
      var actionCell = '-';
      var secondColumn = [];

      if (data.keterangan != null) {
        keterangan = data.keterangan;
      }
      
      if(data.kategori != null){
        kategori = data.kategori;
      }

      if (data.produk_servis_id != null) {
        produkServis = data.produk_servis_id['keterangan'];
      }

      if (data.paket_id != null) {
        paketId = data.paket_id['keterangan'];
      }

      if (data.asal_id != null) {
        asalId = data.asal_id['provinsi']+','+data.asal_id['kabupaten']+','+data.asal_id['kecamatan']+','+data.asal_id['kelurahan']+','+data.asal_id['kodepos'];
      }

      if (data.tujuan_id != null) {
        tujuanId = data.tujuan_id['provinsi']+','+data.tujuan_id['kabupaten']+','+data.tujuan_id['kecamatan']+','+data.tujuan_id['kelurahan']+','+data.tujuan_id['kodepos'];
      }

      console.log('Data Tipe :'+data.tipe)
      console.log('Data SubType :'+subType)
      console.log('Data Menggunakan Nomor Seri :'+data['menggunakan_nomor_seri'])

      if(data.tipe == 3 && subType == 'bukanBarang'){
        actionCell = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
          <span class="svg-icon svg-icon-md">
              <i class="flaticon2-trash text-danger"></i>
          </span>
        </a>`;
      } 

      if (data.tipe == 1 && data['menggunakan_nomor_seri'] == 1 && subType == 'bukanBarang') {
        actionCell = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
        <span class="svg-icon svg-icon-md">
            <i class="flaticon2-trash text-danger"></i>
        </span>
      </a>`;
      }

      if(data.tipe == 3 && subType == 'nomorSeri'){
        actionCell = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
          <span class="svg-icon svg-icon-md">
              <i class="flaticon2-trash text-danger"></i>
          </span>
        </a>`;
      }

      if (data.tipe == 1 && data['menggunakan_nomor_seri'] == 1 && subType == 'nomorSeri') {
        actionCell = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="icon-xl fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
        <span class="svg-icon svg-icon-md">
            <i class="flaticon2-trash text-danger"></i>
        </span>
      </a>`;
      $('body .formGudang').css('display','block');
      }

      if (data.tipe == 1 && data['menggunakan_nomor_seri'] == 1 && subType == 'denganBarang') {
        actionCell = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="icon-xl fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
        <span class="svg-icon svg-icon-md">
            <i class="flaticon2-trash text-danger"></i>
        </span>
      </a>`;
      $('body .formGudang').css('display','block');
      }

      if (data.tipe == 3 && data['menggunakan_nomor_seri'] == null && subType == 'denganBarang') {
        actionCell = `<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="flaticon2-plus mr-n1"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
        <span class="svg-icon svg-icon-md">
            <i class="flaticon2-trash text-danger"></i>
        </span>
      </a>`;
      $('body .formGudang').css('display','block');
      }
      
      console.log(actionCell);
      
    
      console.log(data.stok_tersedia);
        if (data.stok_tersedia['length'] > 0) {
          $.each(data.stok_tersedia, function (indexInArray, valueOfElement) {
              secondColumn.push(valueOfElement.nomor_seri);
          });
        }else{
          secondColumn = null;  
        }

      if (type == 'dontPrice') {

        $(`#${table}`).DataTable().row.add([
          null,
          secondColumn,
          null,
          `<input type="number" value="`+data.id+`" readonly/>`,
          data.kode,
          keterangan,
          `<input type="number" class="form-control kuantitas_add_data" value="0"/>`,
        actionCell,
         produkServis,
         paketId,
          asalId,
          tujuanId,
        ]).draw();
      }else{

        $(`#${table}`).DataTable().row.add([
          null,
          secondColumn,
          null,
          `<input type="number" value="`+data.id+`" readonly/>`,
          data.kode,
          keterangan,
          `<input type="number" class="form-control kuantitas_add_data" value="0"/>`,
          kodePajakElement,
           `<input type="text" onblur="setting_column('','add')" class="form-control harga_nonPrice" value="0" placeholder="0" />`,
          `<span id="totalharga_">0</span>`,
         actionCell,
         produkServis,
         paketId,
          asalId,
          tujuanId,
        ]).draw();
        price_format_class('harga_nonPrice');
      }

     notice('Data di Tambahkan', 'success');
     $('.selectpicker').selectpicker();
}



function rowAddTableJadwalPengiriman(JadwalPengirimanTable,tableJadwalPengirimanModule,ModalJadwalPengiriman) {

    data = JadwalPengirimanTable.row('.selected').data();    
       $(`#${tableJadwalPengirimanModule}`).DataTable().clear().draw();
        $(`#${tableJadwalPengirimanModule}`).DataTable().row.add([
        null,
        null,
        null,
        data.id,
        data.nomor,
        data.alat_transportasi,
        data.asal,
        data.tujuan,
        `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="deleteJadwalPengiriman"><span class="svg-icon svg-icon-md"><i class="flaticon2-trash text-danger"></i></span></a>`,
        data.voyage_flight_trip,
        data.tanggal_pembukaan,
        data.tanggal_penutupan,
        data.eta_asal,
        data.etd_asal,
        data.eta_tujuan,
        ]).draw();
        $(`#${ModalJadwalPengiriman}`).modal('hide');
        $('#btn-add-jadwal-pengiriman').css('display','none');
}

show_add_BarangJasa = (table,type,subType) => {
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type: "POST",
    timeout: 50000,
    url: host+'/pembelian/permintaan-pembelian/add_detail',
    data: {'table': table,'type':type,'subType':subType},
    success: function (res) {
      $('#modalhargaJasaList .modal-dialog').html('');
      $('#modalhargaJasaList .modal-dialog').html(res);
      $('#modalhargaJasaList').modal('show');
    },
    error: function (res, textstatus) {
      if (textstatus === "timeout") {
        notice('Response Time Out', 'error');
      } else {
        notice(res.responseJSON.message, 'error');
      }
    }
  });
};

show_jadwal_JadwalPengiriman = (table, modal) => {
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
      type: "POST",
      timeout: 50000,
      url: host+'/pembelian/permintaan-pembelian/add_jadwal_pengiriman',
      async: true,
      data: {'table': table, 'modal' : modal},
      success: function (res) {
        $('#modalhargaJasaList .modal-dialog').empty(); 
        $('#modalhargaJasaList .modal-dialog').html('');
        $('#modalhargaJasaList .modal-dialog').html(res);
        $('#modalhargaJasaList').modal('show');
      },
      error: function (res, textstatus) {
        if (textstatus === "timeout") {
          notice('Response Time Out', 'error');
        } else {
          notice(res.responseJSON.message, 'error');
        }
      }
    });
}

function ControlSN(HargaJasaTable) {
  var value = '';
  this.table = HargaJasaTable;  
  this.addSerialNumber = function (thisEle,url,dataParamsAdditional) {
   value = this.table.tableInit.row(thisEle).index();
   var hargaJasaId = this.table.tableInit.cell(value,3).nodes().to$().find('input').val();
   var qty = this.table.tableInit.cell(value,6).nodes().to$().find('input').val();
    console.log(hargaJasaId);
    if (dataParamsAdditional != null && SNdata.length == 0) {
      SNdata = dataParamsAdditional;
    }
  
    if (SNdata[hargaJasaId] == undefined) {
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
        type: "POST",
        url: host+'/'+url,
        data:{
          'hargaJasaId' : hargaJasaId,
          'kuantitas' : qty,
          'SNbyId' : 0
        },
        success: function (res) {
          $('#ModalSN .modal-dialog').html('');
          $('#ModalSN .modal-dialog').html(res);
          $('#ModalSN').modal('show');
        }
      });

  }else{
    console.log(SNdata[hargaJasaId]);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
      type: "POST",
      url: host+'/'+url,
      data:{
        'hargaJasaId' : hargaJasaId,
        'kuantitas' : qty,
        'SNbyId' : SNdata[hargaJasaId],
      },
      success: function (res) {
        $('#ModalSN .modal-dialog').html('');
        $('#ModalSN .modal-dialog').html(res);
        $('#ModalSN').modal('show');
      }
    });
  }
      

  }

  this.addSN = function (data,hargaJasaId) {
  
    console.log(data);
    SNdata[hargaJasaId] = data;
    $('#ModalSN').modal('hide');
    console.log(SNdata);
  }

  this.tampungSN = function (data) {
    SNdata = data;
  }

  this.addSerialNumberPenjualan = function (thisEle,url,dataParamsAdditional) {
     var indexHargaJasa = this.table.tableInit.row(thisEle).index();
     var hargaJasaId = this.table.tableInit.cell(indexHargaJasa,3).nodes().to$().find('input').val();
     var tesget = this.table.tableInit.cell(indexHargaJasa,1).data();  
      console.log(tesget);
    if (dataParamsAdditional != null && SNdata.length == 0) {
      SNdata = dataParamsAdditional;
    }

    console.log(SNdata)

     $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

     if (SNdata[hargaJasaId] == undefined) {

      $.ajax({
        type: "POST",
        url: host+'/'+url,
        data:{
          'stokTersedia' : tesget,
          'hargaJasaID': hargaJasaId,
          'stokById' : 0
        },
        success: function (res) {
          $('#ModalSN .modal-dialog').html('');
          $('#ModalSN .modal-dialog').html(res);
          $('#ModalSN').modal('show');
        }
      });
     }else{
      $.ajax({
        type: "POST",
        url: host+'/'+url,
        data:{
          'stokTersedia' : tesget,
          'hargaJasaID': hargaJasaId,
          'stokById' : SNdata[hargaJasaId]
        },
        success: function (res) {
          $('#ModalSN .modal-dialog').html('');
          $('#ModalSN .modal-dialog').html(res);
          $('#ModalSN').modal('show');
        }
      });
     }

  }

  this.addModalBarang = function (thisBarang,url,dataParams) {
    console.log(thisBarang);
    valueIndex = this.table.tableInit.row(thisBarang).index();
    valueData = this.table.tableInit.row(thisBarang).data();
    var hargaJasaId = this.table.tableInit.cell(valueIndex,3).nodes().to$().find('input').val();
    var kuantitas = this.table.tableInit.cell(valueIndex,6).nodes().to$().find('input').val();

    console.log(valueData);
    console.log(hargaJasaId);

    if (dataParams != null && SNdata.length == 0) {
      BarangForShipping = dataParams;
    }

    console.log(BarangForShipping);

    if (BarangForShipping[hargaJasaId] == undefined) {
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
        type: "POST",
        timeout: 50000,
        url: host+'/'+url,
        async: true,
        data: {
          'dataBarang' : 0,
          'hargaJasaId' : hargaJasaId,
          'kuantitas' : kuantitas,
          'paket' : valueData[8]
        },
        success: function (res) {
          $('#modalBarang .modal-dialog').html('');
          $('#modalBarang .modal-dialog').html(res);
          $('#modalBarang').modal('show');
        },
        error: function (res, textstatus) {
          if (textstatus === "timeout") {
            notice('Response Time Out', 'error');
          } else {
            notice(res.responseJSON.message, 'error');
          }
        }
      });
    }else{
      console.log(BarangForShipping[hargaJasaId]);
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
        type: "POST",
        timeout: 50000,
        url: host+'/'+url,
        async: true,
        data: {
          'dataBarang' : BarangForShipping[hargaJasaId],
          'hargaJasaId' : hargaJasaId,
          'kuantitas' : kuantitas,
          'paket' : valueData[8]
        },
        success: function (res) {
          $('#modalBarang .modal-dialog').html('');
          $('#modalBarang .modal-dialog').html(res);
          $('#modalBarang').modal('show');
        },
        error: function (res, textstatus) {
          if (textstatus === "timeout") {
            notice('Response Time Out', 'error');
          } else {
            notice(res.responseJSON.message, 'error');
          }
        }
      });
    }

   
  }

  this.addBarangDetail = function (data,hargaJasaId) {
    console.log(data);
    BarangForShipping[hargaJasaId] = data;
    console.log(BarangForShipping);
    $('#modalBarang').modal('hide');
  }

}

function postData(hargaJasaTable,JadwalPengirimanTable,UangMukaTable) {
  this.hargaJasaTable = hargaJasaTable;
  this.JadwalPengirimanTable = JadwalPengirimanTable;
  this.UangMukaTable = UangMukaTable;
  var detail;
  var uang_muka_val;

  console.log(hargaJasaTable);
  console.log(JadwalPengirimanTable);


    ControlSN(hargaJasaTable);

    this.store = function (btnElement,url,form,table,modul,mode) {
      var getvalue_jadwal_pengiriman = '';
     if (JadwalPengirimanTable != null) {
       getvalue_jadwal_pengiriman = this.JadwalPengirimanTable.tableInit.rows().count();
     }
     var jadwalPengirimanValue = '';
     var tampungSN = Object.assign({},SNdata);
     console.log(tampungSN);
     var tampungBarangforShipping = Object.assign({},BarangForShipping);

     if (JadwalPengirimanTable != null) {
      if (getvalue_jadwal_pengiriman > 0) {
        var jadwal_pengiriman_header = this.JadwalPengirimanTable.tableInit.column(0).data();
        jadwalPengirimanValue = jadwal_pengiriman_header[0][3];
      }else{
        notice('Jadwal pengiriman Belum di pilih', 'warning');
        return false;
      }
     }


  var detail_count = this.hargaJasaTable.tableInit.rows().count();
  if (detail_count > 0) {
     detail =  this.hargaJasaTable.tableInit.rows().data().toArray();
  for (let index = 0; index < detail.length; index++) {
    detail[index][2] = this.hargaJasaTable.tableInit.cell(index,2).nodes().to$().find('input').val()
    detail[index][3] = this.hargaJasaTable.tableInit.cell(index,3).nodes().to$().find('input').val()
    detail[index][5] = this.hargaJasaTable.tableInit.cell(index,5).nodes().to$().find('input').val()
    detail[index][6] = this.hargaJasaTable.tableInit.cell(index,6).nodes().to$().find('input').val()
    detail[index][7] = this.hargaJasaTable.tableInit.cell(index,7).nodes().to$().find('select').val()
    detail[index][8] = this.hargaJasaTable.tableInit.cell(index,8).nodes().to$().find('input').val()
    detail[index][9] = this.hargaJasaTable.tableInit.cell(index,9).nodes().to$().find('input').val()
  }

  console.log(detail);
  
  if (UangMukaTable != null) {

    var uangMukaCount = this.UangMukaTable.tableInit.rows().count();
    if (uangMukaCount > 0) {
      uang_muka_val = this.UangMukaTable.tableInit.rows().data().toArray();
      for (let index = 0; index < uang_muka_val.length; index++) {
        uang_muka_val[index][3] = this.UangMukaTable.tableInit.cell(index,3).nodes().to$().find('input').val()
        uang_muka_val[index][8] = this.UangMukaTable.tableInit.cell(index,8).nodes().to$().find('input').val()
        uang_muka_val[index][9] = this.UangMukaTable.tableInit.cell(index,9).nodes().to$().find('input').val()
      }
    }

  }

  console.log('tess');

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
      type: "POST",
      async: true, 
      timeout: 50000, 
      url: host+'/'+url,
      data: {
        'barangDetail' : tampungBarangforShipping,
        'SN' : tampungSN,
        'header': JSON.stringify($(`#${form}`).serializeArray()),
        'detail': JSON.stringify(detail),
        'uang_muka_val':JSON.stringify(uang_muka_val),
        'jadwalPengiriman' : jadwalPengirimanValue
      },
      success: function (res) {
        console.log(res);
        console.log(tampungSN)
        SNdata = [];
        var data = JSON.parse(res);
        KTUtil.btnRelease(btnElement);
        if (res != 'error') {
          close_content_tab(`${modul}`,`${mode}`);
          Swal.fire('Berhasil!', data.message, 'success')
          reload_table(`${table}`);
        } else {
          notice('Harga tidak boleh 0!','warning');    
        }
      },
      error: function (res, textstatus) {
        KTUtil.btnRelease(btnElement);
        if (textstatus === "timeout") {
          notice('Response Time Out.', 'error');
        } else {
          notice(res.responseJSON.message, 'error');
        }
      }
    });
  } else {
    KTUtil.btnRelease(btnElement);
    notice('Harga Jasa belum di pilih', 'warning');
  }
}

this.downPayment = function (url,form,table,modul,mode,urlRedirect,labelUangMuka) {
  // var SubUrl = '';
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: 'Perhatian !!',
    text: "Apakah anda ingin membuat uang muka ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Tidak',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {

      var getvalue_jadwal_pengiriman = this.JadwalPengirimanTable.tableInit.rows().count();
      var jadwalPengirimanValue = '' 
     if (getvalue_jadwal_pengiriman > 0) {
         var jadwal_pengiriman_header = this.JadwalPengirimanTable.tableInit.column(0).data();
         jadwalPengirimanValue = jadwal_pengiriman_header[0][3];
       }else{
         notice('Jadwal pengiriman Belum di pilih', 'warning');
         return false;
       }

      var detail_count = this.hargaJasaTable.tableInit.rows().count();
        if (detail_count > 0) {
          var detail = this.hargaJasaTable.tableInit.rows().data().toArray();

          for (let index = 0; index < detail.length; index++) {
            detail[index][2] = this.hargaJasaTable.tableInit.cell(index,2).nodes().to$().find('input').val()
            detail[index][3] = this.hargaJasaTable.tableInit.cell(index,3).nodes().to$().find('input').val()
            detail[index][5] = this.hargaJasaTable.tableInit.cell(index,5).nodes().to$().find('input').val()
            detail[index][6] = this.hargaJasaTable.tableInit.cell(index,6).nodes().to$().find('input').val()
            detail[index][7] = this.hargaJasaTable.tableInit.cell(index,7).nodes().to$().find('select').val()
            detail[index][8] = this.hargaJasaTable.tableInit.cell(index,8).nodes().to$().find('input').val()
          }

          $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
          $.ajax({
            type: "POST",
            async: true,
            timeout: 50000, 
            url: host+'/'+url,
            data: {
              'header': JSON.stringify($(`#${form}`).serializeArray()),
              'detail': JSON.stringify(detail),
              'jadwalPengiriman' : jadwalPengirimanValue
            },
            success: function (res) {
              if (res != 'error') {
                data_value = JSON.parse(res);
                console.log(data_value);
                console.log(data_value.data['id']);
                notice('Pemesanan Pembelian berhasil di buat', 'success');
                reload_table(`${table}`);
                add_content_tab(`${modul}`,'uang_muka',`${urlRedirect}`+data_value.data['id']+'', `${labelUangMuka}`,'', 'GET');
                close_content_tab(`${modul}`,`${mode}`);
              }else{

              }
              
              
             
            },
            error: function (res, textstatus) {
              if (textstatus === "timeout") {
                notice('Response Time Out.', 'error');
              } else {
                notice(res.responseJSON.message, 'error');
              }
            }
          });
        } else {
          // KTUtil.btnRelease(btn_save_pembelian_pesanan_pembelian);
          notice('Detail Permintaan Pembelian belum ada', 'warning');
        }


    } else if (
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Batal',
        'Batal untuk pembuatan uang muka',
        'error'
      )
    }
  })

}
}

function choiceHeader(url,type,table_jadwal,tblhargaJasa) {
  if($(`#${type}`).val() != '') {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
      type: "POST",
      timeout: 50000,
      url: host+'/'+url,
      async: true,
      data: {'type' : type, 'table_jadwal' : table_jadwal,'tblHargaJasa':tblhargaJasa},
      success: function (res) {
        $('#previousTransaksi .modal-dialog').html('');
        $('#previousTransaksi .modal-dialog').html(res);
        $('#previousTransaksi').modal('show');
      },
      error: function (res, textstatus) {
        if (textstatus === "timeout") {
          notice('Response Time Out', 'error');
        } else {
          notice(res.responseJSON.message, 'error');
        }
      }
    });
  } else {
    notice('Data Pemasok Belum Dipilih !!!', 'warning');
  }
}

function previousTransactions(tablename,url,type,vendorType) {

  var vendorValue = '';

  if (vendorType == 'pemasok') {
    vendorValue = 'pemasok';
  }else{
    vendorValue =  'pelanggan';
  }

  $(`#${tablename} thead tr`).first().clone(false).appendTo(`#${tablename} thead`);
  $(`#${tablename} thead tr:eq(1) th`).each(function (i) {
      var title = $(this).text();
      if (title == 'ID') {
        $(this).html( '' );
      }else{
        $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
      }

      $( 'input', this ).on( 'keypress  ', function (e) {
          if ( e.which == 13 ) {
              table
                  .column(i)
                  .search( this.value )
                  .draw();
          }
      } );
  });

  table = $(`#${tablename}`).DataTable({
      orderCellsTop: true,
      dom:"tpr",
      rowId: 'id',
      pageLength:5,

      processing: true,
      serverSide: true,
      ajax: {
        url:host+'/'+url,
        type: "POST",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        async: true, 
        data: function( d ) {
          d.id = $(`#${type}`).val();
          d.type = 'pemasok_id';
        },
        error: function (res) {
          $('.dataTables_processing').hide();
          notice(res.responseJSON.message, 'error');
        }
      },
      deferRender: true,
      responsive:!0,
      select: {style: 'single'},
      sorting: [[1,"asc"]],
      pagingType: "full_numbers",
      language: {
        "zeroRecords": "Data tidak ditemukan...",
        "processing": '<span class="text-danger">Mengambil Data....</span>'
      },
      lengthMenu: [[10, 40, 50, 100], [10, 20, 50, 100]],
      columns: [
        { data: 'id' },
        { data: 'nomor' },
        { data: 'tanggal' },
        { data: `${vendorValue}` },
        {data:'kuantitas'}
      ],
      columnDefs: [
        {
          "defaultContent": "-",
          "targets": "_all"
        },
        {
          targets: 0,
          visible: false,
          searchable: false
        }
      ]
    });

  this.tableInit = table;
  this.addDataRelations = function (tblJadwal,syaratPengirimanElement,hargaJasaTable,urlDetail,syaratPengirimanListElement,elementOptional,kodePajakElement,type,downPayment,tblUangMuka,typeSubData) {
   console.log(syaratPengirimanElement);
   console.log(tblUangMuka);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    data = this.tableInit.row(".selected").data();   
    console.log(data);
    var time = 500;

    $.ajax({
      type: "POST",
      timeout: 50000,
      url: host+'/'+urlDetail,
      async: true,
      data :  {
        id_detail : data['id']
      },
      success: function (res) {
        var produkServis = '';
        var paket = '';
        var asal = '';
        var tujuan = '';
        var harga_pembelian;
        var x;
        var number = 1;
        var cellAction = '';
        var columnShippingStok = [];
        $(`#${hargaJasaTable}`).DataTable().clear().draw();
        $(`#${tblJadwal}`).DataTable().clear().draw();
        if (downPayment == 'useDP') {
          $(`#${tblUangMuka}`).DataTable().clear().draw();
        }
        $(`.${syaratPengirimanElement}`).empty();
        $(`#${syaratPengirimanListElement}`).empty();

        console.log(res.data);

        $.each(res.data, function(key,value) {


          if (value['harga_jasa_id']['produk_servis_id'] != null) {
            produkServis = value['harga_jasa_id']['produk_servis_id']['keterangan'];
          }

          if (value['harga_jasa_id']['paket_id'] != null) {
            paket =  value['harga_jasa_id']['paket_id']['keterangan'];
          }

          if (value['harga_jasa_id']['asal_id'] != null) {
            asal = value['harga_jasa_id']['asal_id']['provinsi'] +' , '+ value['harga_jasa_id']['asal_id']['kabupaten'] +' , '+value['harga_jasa_id']['asal_id']['kecamatan']+' , '+value['harga_jasa_id']['asal_id']['kelurahan']+', '+value['harga_jasa_id']['asal_id']['kodepos']
          }

          if (value['harga_jasa_id']['tujuan_id'] != null) {
            tujuan = value['harga_jasa_id']['tujuan_id']['provinsi'] +' , '+ value['harga_jasa_id']['tujuan_id']['kabupaten'] +' , '+value['harga_jasa_id']['tujuan_id']['kecamatan']+' , '+value['harga_jasa_id']['tujuan_id']['kelurahan']+', '+value['harga_jasa_id']['tujuan_id']['kodepos']
          }

          console.log('Data Tipe :'+value['harga_jasa_id']['tipe'])
          console.log('Data SubType :'+typeSubData)
          console.log('Data Menggunakan Nomor Seri :'+value['harga_jasa_id']['menggunakan_nomor_seri'])
    
          if(value['harga_jasa_id']['tipe'] == 3 && typeSubData == 'general'){
            cellAction = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
              <span class="svg-icon svg-icon-md">
                  <i class="flaticon2-trash text-danger"></i>
              </span>
            </a>`;
          } 
    
          if (value['harga_jasa_id']['tipe'] == 1 && value['harga_jasa_id']['menggunakan_nomor_seri'] == 1 && typeSubData == 'general') {
            cellAction = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
            <span class="svg-icon svg-icon-md">
                <i class="flaticon2-trash text-danger"></i>
            </span>
          </a>`;
          }
    
          if(value['harga_jasa_id']['tipe'] == 3 && typeSubData == 'nomorSeri'){
            cellAction = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
              <span class="svg-icon svg-icon-md">
                  <i class="flaticon2-trash text-danger"></i>
              </span>
            </a>`;
          }
    
          if (value['harga_jasa_id']['tipe'] == 1 && value['harga_jasa_id']['menggunakan_nomor_seri'] == 1 && typeSubData == 'nomorSeri') {
            cellAction = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="icon-xl fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
            <span class="svg-icon svg-icon-md">
                <i class="flaticon2-trash text-danger"></i>
            </span>
          </a>`;
          $('body .formGudang').css('display','block');
          }

          if (value['harga_jasa_id']['tipe'] == 3 && value['harga_jasa_id']['menggunakan_nomor_seri'] == null && typeSubData == 'barang') {
            cellAction = `<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="flaticon2-plus mr-n1"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
            <span class="svg-icon svg-icon-md">
                <i class="flaticon2-trash text-danger"></i>
            </span>
          </a>`;
          }

          if (value['harga_jasa_id']['tipe'] == 1 && value['harga_jasa_id']['menggunakan_nomor_seri'] == 1 && typeSubData == 'barang') {
            cellAction = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="icon-xl fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
            <span class="svg-icon svg-icon-md">
                <i class="flaticon2-trash text-danger"></i>
            </span>
          </a>`;
          $('body .formGudang').css('display','block');
          }


          if (type == 'nonShipping') {
            $(`#${hargaJasaTable}`).DataTable().row.add([
              null,
              null,
              `<input type="number" value="`+ value['id_detail']+`" readonly/>`,
              `<input type="number" value="`+value['harga_jasa_id']['id']+`" readonly/>`,
              value.nomor,
              value['harga_jasa_id']['keterangan'],
              `<input type="number" onblur="setting_column('','add')" class="form-control kuantitas_pembelian" id="kuantitas_pembelian_${elementOptional}_${number}" value="`+ value['kuantitas']+`" readonly/>`,
              kodePajakElement,
              `<input type="text" onblur="setting_column('','add')" class="form-control ${elementOptional}" id="${elementOptional}_${number}" value="`+value['harga']+`" placeholder="0"/>`,
              `<span id="totalharga_${elementOptional}_${number}">${value['harga'] * value['kuantitas']}</span>`,
              cellAction,
              produkServis,
             paket,
              asal,
              tujuan,
          ]).draw();
          number++;
          price_format_class(`${elementOptional}`)
          setting_column('','add');
          $('.selectpicker').selectpicker();
          }else if(type == 'shippingStok'){

            if (value['harga_jasa_id']['stok_tersedia']['length'] > 0) {
              $.each(value['harga_jasa_id']['stok_tersedia'], function (indexInArray, valueOfElement) {
                  columnShippingStok.push(valueOfElement.nomor_seri);
              });
            }else{
              columnShippingStok = null;  
            }

            console.log(columnShippingStok);

            $(`#${hargaJasaTable}`).DataTable().row.add([
              null,
              columnShippingStok,
              `<input type="number" value="`+ value['id_detail']+`" readonly/>`,
              `<input type="number" value="`+value['harga_jasa']['id']+`" readonly/>`,
              value.nomor,
              value['harga_jasa_id']['keterangan'],
              `<input type="number" class="form-control kuantitas_pembelian" value="`+ value['kuantitas']+`" readonly/>`,
              cellAction,
            produkServis,
            paket,
             asal,
             tujuan,
          ]).draw();
          columnShippingStok = [];
          }else{

            $(`#${hargaJasaTable}`).DataTable().row.add([
              null,
              null,
              `<input type="number" value="`+ value['id_detail']+`" readonly/>`,
              `<input type="number" value="`+value['harga_jasa_id']['id']+`" readonly/>`,
              value.nomor,
              value['harga_jasa_id']['keterangan'],
              `<input type="number" class="form-control kuantitas_pembelian" value="`+ value['kuantitas']+`" readonly/>`,
           cellAction,
            produkServis,
            paket,
             asal,
             tujuan,
          ]).draw();

          }
        })

        $(`#${tblJadwal}`).DataTable().row.add([
          null,
          null,
          null,
          res.data[0]['jadwal_pengiriman_id']['id'],
          res.data[0]['jadwal_pengiriman_id']['nomor'],
          res.data[0]['jadwal_pengiriman_id']['alat_transportasi']['keterangan'],
          res.data[0]['jadwal_pengiriman_id']['asal']['provinsi']+','+res.data[0]['jadwal_pengiriman_id']['asal']['kabupaten']+','+res.data[0]['jadwal_pengiriman_id']['asal']['kecamatan']+','+res.data[0]['jadwal_pengiriman_id']['asal']['kelurahan']+','+res.data[0]['jadwal_pengiriman_id']['asal']['kodepos'],
          res.data[0]['jadwal_pengiriman_id']['tujuan']['provinsi']+','+res.data[0]['jadwal_pengiriman_id']['tujuan']['kabupaten']+','+res.data[0]['jadwal_pengiriman_id']['tujuan']['kecamatan']+','+res.data[0]['jadwal_pengiriman_id']['tujuan']['kelurahan']+','+res.data[0]['jadwal_pengiriman_id']['tujuan']['kodepos'],
          `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="deleteJadwalPengiriman"><span class="svg-icon svg-icon-md"><i class="flaticon2-trash text-danger"></i></span></a>`,
          res.data[0]['jadwal_pengiriman_id']['voyage_flight_trip'],
          Date.parse(res.data[0]['jadwal_pengiriman_id']['tanggal_pembukaan']),
          res.data[0]['jadwal_pengiriman_id']['tanggal_penutupan'],
          res.data[0]['jadwal_pengiriman_id']['eta_asal'],
          res.data[0]['jadwal_pengiriman_id']['eta_tujuan'],
          res.data[0]['jadwal_pengiriman_id']['etd_asal']
        ]).draw(); 

        if (downPayment == 'useDP') {
  
              
          $.each(res.data[0]['faktur_uang_muka'], function (indexInArray, valueOfElement) { 
                 $(`#${tblUangMuka}`).DataTable().row.add([
                   null,
                   null,
                   null,
                   `<input type="text" value="${valueOfElement.faktur_pembelian_header_id}">`,
                  valueOfElement.nomor,
                  `Uang Muka`,
                  valueOfElement.tanggal,
                  valueOfElement.uang_muka,
                  `<input type="text" value="`+valueOfElement.sisa_uang_muka+`" class="form-control harga" id="nominal_sisa_uang_muka${valueOfElement.faktur_pembelian_header_id}" readonly style="background: #e8e8e8">`,
                  `<input type="text" name="nominal_uang_muka" class="form-control harga_nominal" id="nominal_uang_muka${valueOfElement.faktur_pembelian_header_id}" value="0" min="0" placeholder="0" onkeypress="nominal_aksi('${valueOfElement.faktur_pembelian_header_id}')" />`,
              ]).draw();
              price_format_class('harga');
              price_format_class('harga_nominal');
         });

        }
        

        var syarat_pengiriman = res.data[0]['transaksi_syarat_pengiriman'];
        $.each(syarat_pengiriman[0]['syarat_pengiriman'], function (key,value) {
          $(`.${syaratPengirimanElement}`).append($("<option selected></option>")
                .attr("value", value.id)
                .text(value.keterangan));
           $(`#${syaratPengirimanListElement}`).append(`<li>${value.keterangan}</li>`)     
        })
  
        $('.selectpicker').selectpicker();
        $(`.${syaratPengirimanElement}`).selectpicker('refresh');
        $('#previousTransaksi').modal('hide');
      },error: function (res, textstatus) {
        if (textstatus === "timeout") {
          notice('Response Time Out', 'error');
        } else {
          notice(res.responseJSON.message, 'error');
        }
        time += 500;
      }
    });
  }
  
}
