var host = $('meta[name="host_url"]').attr('content');
var SNdata = [];
var BarangForShipping = [];
var value;
var tamps_value_stok = [];
var callShowJadwalPengiriman;
var sisaFlat = '';
var dataJadwalArray = [];
var dataSyaratArrayPengiriman = [];

//## Variabel Baru
var detailExpedisi = [];
var g_transaksi = '';
var preferensi = [];
var copiedData = {};
var copiedAllData = {};
var copiedSyarat = [];
var copiedJadwal = [];

//##

function DatatableInit(tablename, dateFormat, currency, mode) {
  var targetsDateFormat = {};
  var targetsCurrencyFormat = {};
  var targetsColumnFirst = {};
  if (dateFormat != null) {
    targetsDateFormat = {
      targets: dateFormat,
      render: function (data, type, row) {
        return moment(data).format('DD MMM YYYY');
      }
    }
  }

  if (mode == 'none') {
    targetsColumnFirst = {
      targets: 0,
      className: "text-center",
      visible: false
    }
  } else {
    targetsColumnFirst = {
      targets: 0,
      className: "text-center",
      orderable: true,
      data: null,
      defaultContent: ''
    }
  }

  if (currency != null) {
    targetsCurrencyFormat = {
      targets: currency,
      sClass: 'text-right',
      render: function (data, type, row) {
        return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    }
  }

  TableData = $(`#${tablename}`).DataTable({
    dom: 't',
    pageLength: -1,
    responsive: true,
    colReorder: !0,
    stateSave: !1,
    lengthMenu: [
      [10, 20, 50, 100],
      [10, 20, 50, 100]
    ],
    language: {
      "lengthMenu": " _MENU_ ",
      "zeroRecords": "Belum ada data",
    },
    order: [],
    columnDefs: [{
        "defaultContent": "-",
        "targets": [4],
      },
      targetsColumnFirst,
      {
        targets: [1, 2, 3, 4, 5, 6],
        visible: false,
      },
      targetsDateFormat,
      targetsCurrencyFormat,
    ],
  });

  $(`#${tablename} tbody`).on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = TableData.row(tr);


    if (row.child.isShown()) {
      TableData.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
      tr.removeClass('shown');
    } else {
      TableData.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
      tr.addClass('shown');
    }
  });

  this.tableInit = TableData;
}

function datatableSubInit(table) {
  var table = $(`#${table}`).DataTable({
    bDestroy: true,
    dom: 't',
    pageLength: -1,
    responsive: true,
    colReorder: !0,
    stateSave: !1,
    lengthMenu: [
      [10, 20, 50, 100],
      [10, 20, 50, 100]
    ],
    language: {
      "lengthMenu": " _MENU_ ",
      "zeroRecords": "Belum ada data",
    },
    order: [],
    columnDefs: [{
        targets: [0, 1],
        visible: false,
      },
      {
        targets: -1,
        width: '20%'
      }
    ],
  });

  return table;
}

function transaksiInit() {

  this.c
  var _this = this;
  this.SNdata = SNdata;

  var tabelBebanFaktur = null;
  var transaksiIni = 'nilai awal';

  this.setTransaksi = function (value){ transaksiIni = value; }
  this.getTransaksi = function (){ return  this.transaksiIni; }

  this.constructor = function (barangJasa, JadwalPengiriman) {
    _this.barangJasa = barangJasa;
    _this.JadwalPengiriman = JadwalPengiriman;
  }

  this.datatableInitAjaxJadwalPengiriman = function (tablename, url) {
    // console.log(tablename)
    // console.log(url)

    $(`#${tablename} thead tr`).first().clone().appendTo(`#${tablename} thead`);
    $(`#${tablename} thead tr:eq(1) th`).each(function (i) {
      var title = $(this).text();
      if (title == 'ID') {
        $(this).html('');
      } else {
        $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
      }

      // $('input', this).on('keypress', function (e) {
      //
      //   if (e.which == 13) {
      //     table.column(i).search(this.value).draw();
      //     console.log(this.value);
      //   }
      // });

      $('input', this).on('keyup', function (e) {

        // if (e.which == 13) {
        table.column(i).search(this.value).draw();
        //   console.log(this.value);
        // }
      });

    });

    table = $(`#${tablename}`).DataTable({
      orderCellsTop: true,
      dom: "tpr",
      rowId: 'id',
      pageLength: 20,
      processing: true,
      serverSide: true,
      ajax: {
        url: host + '/' + url,
        async: true,
        error: function (res) {
          $('.dataTables_processing').hide();
          notice(res.responseJSON.message, 'error');
        }
      },
      select: {
        style: 'single'
      },
      language: {
        "zeroRecords": "Data tidak ditemukan...",
        "processing": '<span class="text-danger">Mengambil Data....</span>'
      },
      columns: [{
          data: 'id'
        },
        {
          data: 'nomor'
        },
        {
          data: 'alat_transportasi'
        },
        {
          data: 'asal'
        },
        {
          data: 'tujuan'
        },
        {
          data: 'tanggal_pembukaan'
        },
        {
          data: 'tanggal_penutupan'
        },
        {
          data: 'voyage_flight_trip'
        },
      ],
      columnDefs: [{
          "defaultContent": "-",
          "targets": "_all"
        },
        {
          "targets": [5, 6],
          "render": function (data, type, row) {
            return moment(data).format('DD MMM YYYY');
          }
        },
        {
          targets: 0,
          width: '30px',
          className: 'dt-left',
          orderable: false,
          searchable: false,
          visible: false,
        },
        {
          targets: 7,
          width: '10px',
        }
      ]
    });

    return table;

  }
this.pa
  this.show_jadwal_JadwalPengiriman = function (index, table, modal) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var params = {
      url: 'pembelian/permintaan-pembelian/add_jadwal_pengiriman',
      data: {
        'table': table,
        'modal': modal
      },
      modal: '#JadwalPengirimanList',
      status: 'modalShow'
    }


    this.ajaxGroup(params);
  }

  this.informasiPenjualanDetail = function (pelanggan_id, modal_penjualan_detail, result_table, details, tb_barang, index,result_rows) {
  // console.log(details);
  //   console.log(result_rows);
    let temps_data = [];
    if (result_rows != undefined) {
       $.each(result_rows[pelanggan_id], function (indexInArray, valueOfElement) { 
            temps_data.push(valueOfElement);
       });
    }
   // console.log(temps_data);
    var params = {
      url: 'master-data/harga-jasa/add_informasi_penjualan_detail',
      data: {
        'pelanggan_id': pelanggan_id,
        'modal_penjualan_detail': modal_penjualan_detail,
        'html_data': result_table,
        'details': details,
        'tb_barang': tb_barang,
        'index': index,
        'result_rows' : temps_data
      },
      modal: '#informasi_penjualan_detail_modal',
      status: 'modalShow'
    }
    this.ajaxGroup(params);
  }

  this.show_modal_add_detail_penjualan = function (table) {
  //  console.log('cekk');
    var params = {
      url: 'master-data/harga-jasa/add-detail-penjualan',
      data: {
        'table': table
      },
      modal: '#modal_informasi_penjualan_bj',
      status: 'modalShow'
    }
    this.ajaxGroup(params);
  }

  this.showModalJadwal = function (thisEle, table) {
    var elementRow = $(table).DataTable().row(thisEle).index();
    var id_Tables = $(table).DataTable().tables().nodes().to$().attr('id');
    var dataJadwalPengiriman = $(table).DataTable().cell(elementRow, 3).data();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var params = {
      url: 'master-data/jadwal-pengiriman/detail-add',
      data: {
        'indexElement': elementRow,
        'idTabel': id_Tables,
        'dataJadwal': dataJadwalPengiriman
      },
      modal: '#JadwalPengirimanModal',
      status: 'modalShow'
    }
    this.ajaxGroup(params);

  }

  this.saveToArrayJadwalPengiriman = function (table, index, data, barangJasa) {
    var data = $(`${table}`).DataTable().rows().data().toArray();
  //  console.log(data);
    if (data.length != 0) {
      $(`#${barangJasa}`).DataTable().cell(index, 3).data(data[0]);
      $('#JadwalPengirimanModal').modal('hide');
      notice('Jadwal Pengiriman Di Tambahkan', 'success');
    } else {
      notice('Data Jadwal Pengiriman Belum Ada', 'warning');
    }
  }

  this.rowAddTableJadwalPengiriman = function (JadwalPengirimanTable, tableJadwalPengirimanModule, ModalJadwalPengiriman) {
    data = JadwalPengirimanTable.row('.selected').data();

    // data = JadwalPengirimanTable.row('.selected').data();
    // console.log(data);
    if (data != undefined) {
     // console.log(tableJadwalPengirimanModule);
      $(tableJadwalPengirimanModule).DataTable().clear().draw();

      $('#tbl_jadwal_pengiriman').DataTable().row.add([
        null,
        null,
        null,
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

      notice('Data di Tambahkan', 'success');
      $(tableJadwalPengirimanModule).DataTable().rows().data().toArray();
      $('#JadwalPengirimanList').modal('hide');
    } else {
      notice('Jadwal Pengiriman Belum di Pilih', 'warning');
    }

  }

  this.showModalSyaratPengiriman = function (thisEle, table) {
    var elementRow = $(table).DataTable().row(thisEle).index();
    var id_Tables = $(table).DataTable().tables().nodes().to$().attr('id');
    var dataSyaratPengiriman = $(table).DataTable().cell(elementRow, 2).data();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var params = {
      url: 'perusahaan/syarat-pengiriman/detail-add',
      data: {
        'indexElement': elementRow,
        'idTables': id_Tables,
        'dataSyaratPengiriman': dataSyaratPengiriman
      },
      modal: '#ModalSyaratPengiriman',
      status: 'modalShow'
    }
    this.ajaxGroup(params);

  }

  this.addDataSyaratPengiriman = function (thisEle, index) {
    var data = $(table).DataTable().rows().data()[0];
  }

  this.showAddBarangJasa = function (table, type, subType, mode, vendors, modules, gudang) {

    if ($(vendors).val() != '') {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var params = {
        url: 'pembelian/permintaan-pembelian/add_detail',
        data: {
          'table': table,
          'type': type,
          'subType': subType,
          'mode': mode,
          'valVendors': $(vendors).val(),
          'modules': modules,
          'gudang': gudang
        },
        modal: '#modalhargaJasaList',
        status: 'modalShow'
      }
      this.ajaxGroup(params);

    } else {
      notice('Data Pemasok / Pelanggan Belum Dipilih !!!', 'warning');
    }
  }

  this.dataTableAjaxBarangJasaList = function (tablename, url) {
    $(`#${tablename} thead tr`).first().clone(false).appendTo(`#${tablename} thead`);
    $(`#${tablename} thead tr:eq(1) th`).each(function (i) {
      var title = $(this).text();
     // console.log(title);
      if (title == '') {
        $(this).html('');
      } else {
        $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
      }

      // $('input', this).on('keypress  ', function (e) {
      //   if (e.which == 13) {
      //     table
      //       .column(i)
      //       .search(this.value)
      //       .draw();
      //   }
      // });

      $('input', this).on('keyup', function (e) {
        //if (e.which == 13) {
          table
              .column(i)
              .search(this.value)
              .draw();
       // }
      });

    });

    table = $(`#${tablename}`).DataTable({
      orderCellsTop: true,
      dom: "tpr",
      rowId: 'id',
      pageLength: 5,
      processing: true,
      serverSide: true,
      ajax: {
        url: host + '/' + url,
        async: true,
        error: function (res) {
          $('.dataTables_processing').hide();
          notice(res.responseJSON.message, 'error')
        }
      },
      deferRender: true,
      //responsive: !0,
      select: {
        style: 'single'
      },
      sorting: [
        [1, "asc"]
      ],
      pagingType: "full_numbers",
      language: {
        "zeroRecords": "Data tidak ditemukan...",
        "processing": '<span class="text-danger">Mengambil Data....</span>'
      },
      lengthMenu: [
        [10, 40, 50, 100],
        [10, 20, 50, 100]
      ],
      columns: [{
          data: null
        },
        {
          data: 'id'
        },
        {
          data: 'kode'
        },
        {
          data: 'keterangan'
        },
        {
          data: 'paket'
        },
        {
          data: 'produk_layanan'
        },
        {
          data: 'asal'
        },
        {
          data: 'tujuan'
        }
      ],
      columnDefs: [{
          "defaultContent": "-",
          "targets": [2, 3, 4, 5, 6, 7],
        },
        {
          targets: 0,
          visible: false
        },
        {
          targets: [1],
          visible: false,
        },
        {
          title: 'Asal',
          targets: [6],
        },
        {
          title: 'Tujuan',
          targets: [7],
        }
      ]
    });

    return table;
  }

  this.dataTableAjaxretur = function (tablename, url, mode, type) {

   // console.log(mode)

    $(`#${tablename} thead tr`).first().clone(false).appendTo(`#${tablename} thead`);
    $(`#${tablename} thead tr:eq(1) th`).each(function (i) {
      var title = $(this).text();
     // console.log(title);
      if (title == '') {
        $(this).html('');
      } else {
        $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
      }

      // $('input', this).on('keypress  ', function (e) {
      //   if (e.which == 13) {
      //     table
      //       .column(i)
      //       .search(this.value)
      //       .draw();
      //   }
      // });

      $('input', this).on('keyup', function (e) {
        // if (e.which == 13) {
          table
              .column(i)
              .search(this.value)
              .draw();
        // }
      });

    });

    if (mode != 'penjualan') {

      if (type == '2') {
        table = $(`#${tablename}`).DataTable({
          orderCellsTop: true,
          dom: "tpr",
          rowId: 'id',
          pageLength: 5,
          processing: true,
          serverSide: true,
          ajax: {
            url: host + '/' + url,
            async: true,
            error: function (res) {
              $('.dataTables_processing').hide();
              notice(res.responseJSON.message, 'error')
            }
          },
          deferRender: true,
          responsive: !0,
          select: {
            style: 'single'
          },
          sorting: [
            [1, "asc"]
          ],
          pagingType: "full_numbers",
          language: {
            "zeroRecords": "Data tidak ditemukan...",
            "processing": '<span class="text-danger">Mengambil Data....</span>'
          },
          lengthMenu: [
            [10, 40, 50, 100],
            [10, 20, 50, 100]
          ],
          columns: [{
              data: 'id'
            },
            {
              data: 'nomor'
            },
            {
              data: 'tanggal'
            },
            {
              data: 'pemasok'
            },
            {
              data: 'keterangan'
            },
            {
              data: 'total_harga'
            }
          ],
          columnDefs: [{
              "defaultContent": "-",
              "targets": "_all",
            },
            {
              targets: 0,
              visible: false
            },
          ]
        });
      } else {
        table = $(`#${tablename}`).DataTable({
          orderCellsTop: true,
          dom: "tpr",
          rowId: 'id',
          pageLength: 5,
          processing: true,
          serverSide: true,
          ajax: {
            url: host + '/' + url,
            async: true,
            error: function (res) {
              $('.dataTables_processing').hide();
              notice(res.responseJSON.message, 'error')
            }
          },
          deferRender: true,
          responsive: !0,
          select: {
            style: 'single'
          },
          sorting: [
            [1, "asc"]
          ],
          pagingType: "full_numbers",
          language: {
            "zeroRecords": "Data tidak ditemukan...",
            "processing": '<span class="text-danger">Mengambil Data....</span>'
          },
          lengthMenu: [
            [10, 40, 50, 100],
            [10, 20, 50, 100]
          ],
          columns: [{
              data: 'id'
            },
            {
              data: 'nomor'
            },
            {
              data: 'tanggal'
            },
            {
              data: 'pemasok'
            },
            {
              data: 'nomor_release_order'
            }
          ],
          columnDefs: [{
              "defaultContent": "-",
              "targets": "_all",
            },
            {
              targets: 0,
              visible: false
            },
          ]
        });
      }

    } else {

      table = $(`#${tablename}`).DataTable({
        orderCellsTop: true,
        dom: "tpr",
        rowId: 'id',
        pageLength: 5,
        processing: true,
        serverSide: true,
        ajax: {
          url: host + '/' + url,
          async: true,
          error: function (res) {
            $('.dataTables_processing').hide();
            notice(res.responseJSON.message, 'error')
          }
        },
        deferRender: true,
        responsive: !0,
        select: {
          style: 'single'
        },
        sorting: [
          [1, "asc"]
        ],
        pagingType: "full_numbers",
        language: {
          "zeroRecords": "Data tidak ditemukan...",
          "processing": '<span class="text-danger">Mengambil Data....</span>'
        },
        lengthMenu: [
          [10, 40, 50, 100],
          [10, 20, 50, 100]
        ],
        columns: [{
            data: 'id'
          },
          {
            data: 'nomor'
          },
          {
            data: 'tanggal'
          },
          {
            data: 'pelanggan'
          }
        ],
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all",
          },
          {
            targets: 0,
            visible: false
          },
        ]
      });
    }

    return table;
  }

  this.choiceHeader = function (url, type, table_jadwal, tblhargaJasa, kenaPajak, denganPajak, typeSet, modeSet, barangJasaSet, moduleSet, syaratPengirimanListValue, gudangEle) {

    if ($(type).val() != '') {
      var params = {
        url: url,
        data: {
          'type': type,
          'table_jadwal': table_jadwal,
          'tblHargaJasa': tblhargaJasa,
          'kenaPajak': kenaPajak,
          'denganPajak': denganPajak,
          'typeSet': typeSet,
          'modeSet': modeSet,
          'moduleSet': moduleSet,
          'barangJasaSet': barangJasaSet,
          'syaratPengirimanListValue': syaratPengirimanListValue,
          'gudangEle': gudangEle
        },
        modal: '#previousTransaksi',
        status: 'modalShow'
      }
      this.ajaxGroup(params);
    } else {
      notice('Data Pemasok / Pelanggan Belum Dipilih !!!', 'warning');
    }
  }

  this.rowAddBarangJasaList = function (hargajasalist, table, type, kodePajakElement, subType, mode, valVendors, modules, gudang) {

    let data = hargajasalist.row(".selected").data();
    var keterangan = '-';
    var produkServis = '-';
    var paketId = '-';
    var asalId = '-';
    var tujuanId = '-';
    var actionCell = '-';
    var secondColumn = [];
    let stok_transfer = [];
    var hargaValue = 0;
    var rowHargaValue = 0;

    if (data.keterangan != null) {
      keterangan = data.keterangan;
    }

    if (data.kategori != null) {
      kategori = data.kategori;
    }

    if (data.produk_servis_id != null) {
      produkServis = data.produk_servis_id['keterangan'];
    }

    if (data.paket_id != null) {
      paketId = data.paket_id['keterangan'];
    }

    if (data.asal_id != null) {
      asalId = normalizeLokasi(data.asal_id);
          //data.asal_id['provinsi'] + ',' + data.asal_id['kabupaten'] + ',' + data.asal_id['kecamatan'] + ',' + data.asal_id['kelurahan'] + ',' + data.asal_id['kodepos'];
    }

    if (data.tujuan_id != null) {
      tujuanId = normalizeLokasi(data.tujuan_id);
          //data.tujuan_id['provinsi'] + ',' + data.tujuan_id['kabupaten'] + ',' + data.tujuan_id['kecamatan'] + ',' + data.tujuan_id['kelurahan'] + ',' + data.tujuan_id['kodepos'];
    }

    if (subType == 'transfer_barang') {
      actionCell = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
        <i class="fas fa-trash text-danger"></i>
      </a>`;
      if(data['menggunakan_nomor_seri'] == 1){
        actionCell += `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number">
      <i class=" fas fa-box-open"></i>
      </a>`;
      }
    }

    if (data.tipe == 3 && subType == 'bukanBarang') {
      actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
            <i class="fas fa-trash text-danger"></i>
          </a>`;
    }

    if (data.tipe == 1 && subType == 'bukanBarang') {
      actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
          <i class="fas fa-trash text-danger"></i>
        </a>`;
      $('body .formGudang').css('display', 'block');
      $('body .formGudang').attr('data-id', 'gudangValidate')
    }


    if (data.tipe == 1 && data['menggunakan_nomor_seri'] == null) {
      actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
          <i class="fas fa-trash text-danger"></i>
        </a>`;
    }

    if (data.tipe == 3 && subType == 'nomorSeri') {
      actionCell = `<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Barang"><i class="flaticon2-plus mr-n1"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
          <i class="fas fa-trash text-danger"></i>
        </a>`;

    }

    if (data.tipe == 1 && data['menggunakan_nomor_seri'] == 1 && subType == 'nomorSeri') {
      actionCell = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number">
            <i class=" fas fa-box-open"></i>
        </a>
        <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal">
           <i class="far fa-calendar text-primary"></i>
        </a>
        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
          <i class="fas fa-trash text-danger"></i>
        </a>`;

      $('body .formGudang').css('display', 'block');
      $('body .formGudang').attr('data-id', 'gudangValidate')
    }

    if (data.tipe == 1 && data['menggunakan_nomor_seri'] == 0 && subType == 'nomorSeri') {
      actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
          <i class="fas fa-trash text-danger"></i>
        </a>`;
      $('body .formGudang').css('display', 'block');
      $('body .formGudang').attr('data-id', 'gudangValidate')
    }

    if (data.tipe == 1 && subType == 'denganBarang') {
      if (data['menggunakan_nomor_seri'] == 1) {
        actionCell = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number">
                <i class=" fas fa-box-open"></i>
            </a>
        <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal">
        <i class="far fa-calendar text-primary"></i>
        </a>
        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
          <i class="fas fa-trash text-danger"></i>
        </a>`;
      } else {
        actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
          <i class="fas fa-trash text-danger"></i>
        </a>`;
      }


      $('body .formGudang').css('display', 'block');
      $('body .formGudang').attr('data-id', 'gudangValidate')
    }

    if (data.tipe == 3 && data['menggunakan_nomor_seri'] == null && subType == 'denganBarang') {
      actionCell = `<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Barang"><i class="flaticon2-plus mr-n1"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
        <i class="fas fa-trash text-danger"></i>
      </a>`;

    }

    // console.log(data.stok_tersedia);
    if (data.stok_tersedia['length'] > 0) {
      $.each(data.stok_tersedia, function (indexInArray, valueOfElement) {
        secondColumn.push(valueOfElement.nomor_seri);
      });
    } else {
      secondColumn = null;
    }


    if (type == 'dontPrice') {

      $(table).DataTable().row.add([
        data.tipe,
        null,
        null,
        null,
        secondColumn,
        null,
        `<input type="number" value="` + data.id + `" readonly/>`,
        data.kode,
        keterangan,
        `<input type="number" id="priceElement" class="form-control kuantitas_add_data" value="0"/>`,
        actionCell,
        produkServis,
        paketId,
        asalId,
        tujuanId,
        `-`,
        `-`
      ]).draw();


    }
    else if (type == 'transfer_barang') {
      $.ajax({
        type: "POST",
        timeout: 50000,
        url: host + '/pembelian/transfer-barang/get_sn',
        async: true,
        data: {
          'harga_jasa_id': data.id,
          'gudang_id': gudang
        },
        success: function (response) {
         // console.log(response);
          $.each(response, function (indexInArray, valueOfElement) {
            stok_transfer.push(valueOfElement.nomor_seri);
          });
        }
      });


      $(table).DataTable().row.add([
        data.tipe,
        null,
        null,
        null,
        stok_transfer,
        null,
        `<input type="number" value="` + data.id + `" readonly/>`,
        data.kode,
        keterangan,
        `<input type="number" id="priceElement" class="form-control kuantitas_add_data" value="0"/>`,
        actionCell,
        produkServis,
        paketId,
        asalId,
        tujuanId,
        `-`,
        `-`
      ]).draw();
    }
    else {

      if (modules == 'pembelian') {

        if (data['informasi_pembelian']['length'] > 0) {
          $.each(data['informasi_pembelian'], function (keys, values) {
            if (values.pemasok_id == valVendors) {
              rowHargaValue = values.harga_pembelian;
            }
          });
        }
      }
      else {
        if (data['informasi_penjualan']['length'] > 0) {
          $.each(data['informasi_penjualan'], function (keys, values) {
            if (values.pelanggan_id == valVendors) {
              rowHargaValue = values.harga_penjualan;
            }
          });
        }
      }

      if (mode == null) {
        $(table).DataTable().row.add([
          data.tipe,
          null,
          null,
          null,
          secondColumn,
          null,
          `<input type="number" value="` + data.id + `" readonly/>`,
          data.kode,
          keterangan,
          `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="0"/>`,
          kodePajakElement,
          `<input type="text" id="priceElement" class="form-control harga_nonPrice" value="${rowHargaValue}" placeholder="0" />`,
          `<span id="totalharga_">0</span>`,
          actionCell,
          produkServis,
          paketId,
          asalId,
          tujuanId,
        ]).draw();
      } else {
        $(table).DataTable().row.add([
          data.tipe,
          null,
          null,
          null,
          secondColumn,
          null,
          `<input type="number" value="` + data.id + `" readonly/>`,
          data.kode,
          keterangan,
          `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="0"/>`,
          kodePajakElement,
          `<input type="text" id="priceElement" class="form-control harga_nonPrice" value="${rowHargaValue}" placeholder="0" />`,
          `<span id="totalharga_">0</span>`,
          actionCell,
          produkServis,
          paketId,
          asalId,
          tujuanId,
          `-`,
          `-`,
          `-`
        ]).draw();
      }

      price_format_class('harga_nonPrice');
    }

    notice('Data di Tambahkan', 'success');
    $('.selectpicker').selectpicker();
  }

  this.rowadd_return = (function (tableVal, tabel, vendors, subType, kodePajakElement, attr_vendors, mode, type, elementHeader) {
    let data = tableVal.row(".selected").data();
    if (data != undefined) {
      $(elementHeader).val(data.id);
      $(attr_vendors).val(data.pelanggan_id);
      $('.selectpicker').selectpicker('refresh');

      if(type == 1){
        let columnSN = [];
        let data_detail = '';

        if(mode == 'pembelian'){
          $.ajax({
            type: "POST",
            timeout: 50000,
            url: host + '/pembelian/pengiriman-pembelian/list/by/detail',
            async: true,
            data: {
              'id_detail': data['id']
            },
            success: function (response) {
              if (response.data['length'] > 0) {
                data_detail = response['data'];
              }

              $.each(data_detail, function (indexInArray, valueOfElement) {
                $.ajax({
                  type: "POST",
                  timeout: 50000,
                  url: host + '/pembelian/retur-pembelian/getStokByDetail',
                  async: true,
                  data: {
                    'id': valueOfElement['id_detail'],
                    'transaksi': 'pengiriman'
                  },
                  success: function (response) {
                    $(attr_vendors).val(data.vendor);
                    $('#gudang-return-pembelian').val(data.gudang_id);
                    $(attr_vendors).selectpicker('refresh');
                    $('#gudang-return-pembelian').selectpicker('refresh');

                    let temps = [];
                    $.each(response, function (index, value) {
                      temps.push(value.nomor_seri)
                    });

                    let ndata = valueOfElement;
                    ndata.pengiriman = `<input type="text" value="${ndata.id_detail}">`;
                    ndata.faktur     = null;
                    let ads = [];
                    ads['sn_terpilih'] = [];
                    ads['sn_tersedia'] = temps;
                    ads['transaksi'] = 'pengiriman';
                    ads['mode_sn'] = '';
                    ads['tipe_transaksi'] = '';
                    ads['mode_transaksi'] = mode;
                    ads['gudang_id'] = data['gudang_id'];
                    ads['kode_pajak_class'] = 'selectpickerPrevious';
                    ads['syarat'] = [];
                    ads['jadwal'] = [];
                    addDetailRetur(tabel,ndata,ads);

                    $.each(kodePajakElement, function (indexInArray, valueOfElement) {
                      $('.selectpickerPrevious').append(`<option value="${valueOfElement['id']}" nilai="${valueOfElement['nilai']}">${valueOfElement['nama']}</option>`)
                    });

                    price_format_class('harga_nonPrice');
                    $('.selectpickerPrevious').selectpicker();

                  }
                });
              });
            }
          });

        }
        else if(mode == 'penjualan'){
          //let ndata;
          $.ajax({
            type: "POST",
            timeout: 50000,
            url: host + '/penjualan/pengiriman-pesanan/list/by/detail',
            async: true,
            data: {
              'id_detail': data['id']
            },
            success: function (response) {
              if (response.data['length'] > 0) {
                data_detail = response['data'];
              }
              $.each(data_detail, function (indexInArray, valueOfElement) {
                $.ajax({
                  type: "POST",
                  timeout: 50000,
                  url: host + '/penjualan/retur-penjualan/getStokByDetail',
                  async: true,
                  data: {
                    'id': valueOfElement['id_detail'],
                    'transaksi': 'pengiriman'
                  },
                  success: function (response) {
                    function nSeri(e) {
                      return e.nomor_seri;
                    }
                    $('#pelanggan_penjualan_retur_penjualan_add').val(valueOfElement['pelanggan_id']);
                    $('#pelanggan_penjualan_retur_penjualan_add').selectpicker('refresh');
                    let ndata = valueOfElement;
                    ndata.pengiriman = `<input type="text" value="${ndata.id_detail}">`;
                    ndata.faktur     = null;
                    let ads = [];
                    ads['sn_terpilih']    = [];
                    ads['sn_tersedia']    = response.map(nSeri);
                    ads['transaksi']      = 'pengiriman';
                    ads['mode_sn']        = '';
                    ads['tipe_transaksi'] = '';
                    ads['mode_transaksi'] = mode;
                    ads['gudang_id']      = data['gudang_id'];
                    ads['kode_pajak_class'] = 'selectpickerPrevious';
                    addDetailRetur(tabel,ndata,ads);
                    console.log(ndata)

                    $.each(kodePajakElement, function (idxpjk, valpjk) {
                      $('.selectpickerPrevious').append(`<option value="${valpjk['id']}" nilai="${valpjk['nilai']}">${valpjk['nama']}</option>`)
                    });

                    price_format_class('harga_nonPrice');
                    $('.selectpickerPrevious').selectpicker();

                  }
                });
              });

            }
          })
         // $(tabel).DataTable().columns([11,12]).visible(false);
        }
        $(tabel).DataTable().columns([11,12]).visible(false);
      }
      else if(type == 2){
        $.each(data['detail'], function (indexInArray, valueOfElement) {
          if (mode == 'pembelian') {
            let temp =[];
            $.ajax({
              type: "POST",
              timeout: 50000,
              url: host + '/pembelian/retur-pembelian/getStokByDetail',
              async: true,
              data: {
                'id': valueOfElement['id'],
                'transaksi': 'faktur'
              },
              success: function (response) {
                if (response['length'] > 0) {
                  $.each(response, function (index, value) {
                    temp.push(value.nomor_seri);
                  });
                } else {
                  temp = null;
                }
              }
            });

            let ndata = valueOfElement;
            ndata.pengiriman = null;
            ndata.faktur     = `<input type="text" value="${ndata.id}">`;
            let ads = [];
            ads['sn_terpilih'] = [];
            ads['sn_tersedia'] = temp;
            ads['transaksi'] = 'faktur';
            ads['mode_sn'] = '';
            ads['tipe_transaksi'] = '';
            ads['mode_transaksi'] = mode;
            ads['gudang_id'] = data['gudang_id'];
            ads['kode_pajak_class'] = `kodePajakElePrevious${indexInArray}`;
            addDetailRetur(tabel,ndata,ads);

            $.each(kodePajakElement, function (idxpjk, valpjk) {
              $(`.kodePajakElePrevious${indexInArray}`).append(`<option value="${valpjk['id']}" nilai="${valpjk['nilai']}">${valpjk['nama']}</option>`)
            });

            $(`.selectpickerPrevious`).selectpicker('referesh');

            $(attr_vendors).selectpicker('val', data.pemasok_id['id']);
            $('#kena_pajak_retur_pembelian_add_retur_pembelian').prop("checked", true);
            if (data.termasuk_pajak != null) {
              $('#dengan_pajak_pesanan_pembelian').prop("checked", true);
            }
          }
          else if(mode == 'penjualan'){
            let temp = [];
            $.ajax({
              type: "POST",
              timeout: 50000,
              url: host + '/penjualan/retur-penjualan/getStokByDetail',
              async: true,
              data: {
                'id': valueOfElement['id'],
                'transaksi': 'faktur'
              },
              success: function (response) {
                if (response['length'] > 0) {
                  $.each(response, function (index, value) {
                    temp.push(value.nomor_seri);
                  });
                } else {
                  temp = null;
                }
              }
            });
            let ndata = valueOfElement;
            ndata.pengiriman = null;
            ndata.faktur     = `<input type="text" value="${ndata.id}">`;
            let ads = [];
            ads['sn_terpilih'] = [];
            ads['sn_tersedia'] = temp;
            ads['transaksi'] = 'faktur';
            ads['mode_sn'] = '';
            ads['tipe_transaksi'] = '';
            ads['mode_transaksi'] = mode;
            ads['gudang_id'] = data['gudang_id'];
            ads['kode_pajak_class'] = `kodePajakElePrevious${indexInArray}`;
            //ads['kode_pajak_class'] = `kodePajakReturPenjualan${indexInArray}_{{$data['id']}}`;
            addDetailRetur(tabel,ndata,ads);

            $(attr_vendors).selectpicker('val', data.pelanggan_id);
            $('#kena_pajak_retur_penjualan_add_retur_penjualan').prop("checked", true);
            if (data.termasuk_pajak != null) {
              $('#dengan_pajak_pesanan_penjualan').prop("checked", true);
            }
            $.each(kodePajakElement, function (idxpjk, valpjk) {
              $(`.kodePajakElePrevious${indexInArray}`).append(`<option value="${valpjk['id']}" nilai="${valpjk['nilai']}">${valpjk['nama']}</option>`)
            });
            $(`.selectpickerPrevious`).selectpicker('referesh');
          }
        });
      }


      // if (type != 1) {
      //   $.each(data['detail'], function (indexInArray, valueOfElement) {
      //
      //     var keterangan = '-';
      //     var produkServis = '-';
      //     var paketId = '-';
      //     var asalId = '-';
      //     var tujuanId = '-';
      //     var actionCell = '-';
      //     var secondColumn = [];
      //     var hargaValue = 0;
      //     var rowHargaValue = 0;
      //     let stokTersedia = [];
      //
      //     rowHargaValue += valueOfElement.harga
      //
      //     if (valueOfElement['harga_jasa_id']['keterangan'] != null) {
      //       keterangan = valueOfElement['harga_jasa_id']['keterangan'];
      //     }
      //
      //     if (valueOfElement['harga_jasa_id']['kategori'] != null) {
      //       kategori = valueOfElement['harga_jasa_id']['kategori'];
      //     }
      //
      //     if (valueOfElement['harga_jasa_id']['produk_servis_id'] != null) {
      //       produkServis = valueOfElement['harga_jasa_id']['produk_servis_id']['keterangan'];
      //     }
      //
      //     if (valueOfElement['harga_jasa_id']['paket_id'] != null) {
      //       paketId = valueOfElement['harga_jasa_id']['paket_id']['keterangan'];
      //     }
      //
      //     if (valueOfElement['harga_jasa_id']['asal_id'] != null) {
      //       asalId = normalizeLokasi(valueOfElement['harga_jasa_id']['asal_id']);
      //           //valueOfElement['harga_jasa_id']['asal_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kodepos'];
      //     }
      //
      //     if (valueOfElement['harga_jasa_id']['tujuan_id'] != null) {
      //       tujuanId = normalizeLokasi(valueOfElement['harga_jasa_id']['tujuan_id']);
      //           //valueOfElement['harga_jasa_id']['tujuan_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kodepos'];
      //     }
      //
      //     if (valueOfElement['harga_jasa_id']['tipe'] == 1) {
      //
      //       if (valueOfElement['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
      //         actionCell = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
      //         <i class="fas fa-trash text-danger"></i>
      //       </a>`;
      //         $('body .formGudang').css('display', 'block');
      //         $('body .formGudang').attr('data-id', 'gudangValidate')
      //       } else {
      //         actionCell = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete"><i class="fas fa-trash text-danger"></i></a>`;
      //       }
      //
      //
      //     }
      //
      //     if (valueOfElement['harga_jasa_id']['tipe'] == 3) {
      //       actionCell = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
      //         <i class="fas fa-trash text-danger"></i>
      //       </a>`;
      //
      //     }
      //
      //     if (mode != 'penjualan') {
      //       $.ajax({
      //         type: "POST",
      //         timeout: 50000,
      //         url: host + '/pembelian/retur-pembelian/getStokByDetail',
      //         async: true,
      //         data: {
      //           'id': valueOfElement['id'],
      //           'transaksi': 'faktur'
      //         },
      //         success: function (response) {
      //           // console.log(response);
      //           if (response['length'] > 0) {
      //             $.each(response, function (index, value) {
      //               secondColumn.push(value.nomor_seri);
      //             });
      //           } else {
      //             secondColumn = null;
      //           }
      //         }
      //       });
      //     }
      //     else {
      //       $.ajax({
      //         type: "POST",
      //         timeout: 50000,
      //         url: host + '/penjualan/retur-penjualan/getStokByDetail',
      //         async: true,
      //         data: {
      //           'id': valueOfElement['id'],
      //           'transaksi': 'faktur'
      //         },
      //         success: function (response) {
      //         //  console.log(response);
      //           if (response['length'] > 0) {
      //             $.each(response, function (index, value) {
      //               secondColumn.push(value.nomor_seri);
      //             });
      //           } else {
      //             secondColumn = null;
      //           }
      //         }
      //       });
      //     }
      //
      //     $(tabel).DataTable().row.add([
      //       valueOfElement.tipe,
      //       null,
      //       null,
      //       valueOfElement['harga_jasa_id']['id'],
      //       secondColumn,
      //       null,
      //       `<input type="number" value="` + valueOfElement.id + `" readonly/>`,
      //       valueOfElement['harga_jasa_id']['kode'],
      //       keterangan,
      //       `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="0"/>`,
      //       `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious kodePajakElePrevious${indexInArray}" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
      //       `<input type="text" id="priceElement" class="form-control harga_nonPrice" value="${rowHargaValue}" placeholder="0" />`,
      //       `<span id="totalharga_">0</span>`,
      //       actionCell,
      //       produkServis,
      //       paketId,
      //       asalId,
      //       tujuanId,
      //     ]).draw();
      //
      //     $.each(kodePajakElement, function (indexInArray, valueOfElement) {
      //       $('.selectpickerPrevious').append(`<option value="${valueOfElement['id']}" nilai="${valueOfElement['nilai']}">${valueOfElement['nama']}</option>`)
      //     });
      //
      //
      //     if (data.kena_pajak > 0) {
      //
      //       if (mode != 'penjualan') {
      //         $('#kena_pajak_retur_pembelian_add_retur_pembelian').prop("checked", true);
      //         if (data.termasuk_pajak != null) {
      //           $('#dengan_pajak_pesanan_pembelian').prop("checked", true);
      //         }
      //       } else {
      //         $('#kena_pajak_retur_penjualan_add_retur_penjualan').prop("checked", true);
      //         if (data.termasuk_pajak != null) {
      //           $('#dengan_pajak_retur_penjualan_add_retur_penjualan').prop("checked", true);
      //         }
      //       }
      //
      //       if (valueOfElement.kode_pajak_id != null) {
      //         $(`.kodePajakElePrevious${indexInArray}`).selectpicker('val', valueOfElement.kode_pajak_id['id']);
      //         $(`.kodePajakElePrevious${indexInArray}`).selectpicker('refresh');
      //       }
      //
      //     }
      //
      //     if (mode == 'pembelian') {
      //       $('#gudang-return-pembelian').selectpicker('val', data.gudang_id);
      //       $('#pemasok_pembelian_retur_pembelian_add').selectpicker('val', data.vendor);
      //     }
      //
      //
      //     price_format_class('harga_nonPrice');
      //     $('.selectpickerPrevious').selectpicker();
      //
      //     if (mode != 'penjualan') {
      //       $(attr_vendors).selectpicker('val', data.pemasok_id['id']);
      //     }
      //     else {
      //       $(attr_vendors).selectpicker('val', data.pelanggan_id);
      //     }
      //
      //     notice('Data Faktur Pembelian di Tambahkan', 'success')
      //   });
      // }
      // else {
      //
      //   let keterangan_2 = '';
      //   let harga_2 = 0;
      //   let action_ = '';
      //   let produk_layanan_ = '';
      //   let paket_ = '';
      //   let asal_ = '';
      //   let tujuan_ = '';
      //   let columnSN = [];
      //   let data_detail = '';
      //   let stokSelect = [];
      //
      //
      //   // if (mode != 'penjualan') {
      //   //   $.ajax({
      //   //     type: "POST",
      //   //     timeout: 50000,
      //   //     url: host + '/pembelian/retur-pembelian/getStokByDetail',
      //   //     async: true,
      //   //     data: {
      //   //       'id': data['id_detail'],
      //   //       'transaksi' : 'pengiriman'
      //   //     },
      //   //     success: function (response) {
      //   //       console.log(response);
      //   //       if (response['length'] > 0) {
      //   //         $.each(response, function (index, value) {
      //   //           columnSN.push(value.nomor_seri);
      //   //         });
      //   //       } else {
      //   //         columnSN = null;
      //   //       }
      //   //     }
      //   //   });
      //
      //   // } else {
      //   //   $.ajax({
      //   //     type: "POST",
      //   //     timeout: 50000,
      //   //     url: host + '/penjualan/retur-penjualan/getStokByDetail',
      //   //     async: true,
      //   //     data: {
      //   //       'id': data['id_detail'],
      //   //       'transaksi' : 'pengiriman'
      //   //     },
      //   //     success: function (response) {
      //   //       console.log(response);
      //   //       if (response['length'] > 0) {
      //   //         $.each(response, function (index, value) {
      //   //           columnSN.push(value.nomor_seri);
      //   //         });
      //   //       } else {
      //   //         columnSN = null;
      //   //       }
      //   //     }
      //   //   });
      //   // }
      //
      //   if (mode != 'penjualan') {
      //     // $('#retur_header_pengiriman_pembelian').val(data.pengiriman_pembelian_header_id['id']);
      //
      //     $.ajax({
      //       type: "POST",
      //       timeout: 50000,
      //       url: host + '/pembelian/pengiriman-pembelian/list/by/detail',
      //       async: true,
      //       data: {
      //         'id_detail': data['id']
      //       },
      //       success: function (response) {
      //         if (response.data['length'] > 0) {
      //           data_detail = response['data'];
      //         }
      //
      //         $.each(data_detail, function (indexInArray, valueOfElement) {
      //           $.ajax({
      //             type: "POST",
      //             timeout: 50000,
      //             url: host + '/pembelian/retur-pembelian/getStokByDetail',
      //             async: true,
      //             data: {
      //               'id': valueOfElement['id_detail'],
      //               'transaksi': 'pengiriman'
      //             },
      //             success: function (response) {
      //               $(attr_vendors).val(data.vendor);
      //               $('#gudang-return-pembelian').val(data.gudang_id);
      //               $(attr_vendors).selectpicker('refresh');
      //               $('#gudang-return-pembelian').selectpicker('refresh');
      //
      //               let temps = [];
      //               $.each(response, function (index, value) {
      //                 temps.push(value.nomor_seri)
      //               });
      //
      //               columnSN[indexInArray] = temps;
      //
      //               let ndata = valueOfElement;
      //               ndata.pengiriman = `<input type="text" value="${ndata.id_detail}">`;
      //               ndata.faktur     = null;
      //               let ads = [];
      //               ads['sn_terpilih'] = [];
      //               ads['sn_tersedia'] = temps;
      //               ads['transaksi'] = 'pengiriman';
      //               ads['mode_sn'] = '';
      //               ads['tipe_transaksi'] = '';
      //               ads['mode_transaksi'] = 'pembelian';
      //               ads['gudang_id'] = data['gudang_id'];
      //
      //               addDetailRetur(tabel,ndata,ads);
      //
      //                 // if (valueOfElement['harga_jasa_id']['produk_servis_id'] != null) {
      //                 //   produk_layanan_ = valueOfElement['harga_jasa_id']['produk_servis_id']['keterangan'];
      //                 // }
      //                 //
      //                 // if (valueOfElement['harga_jasa_id']['paket_id'] != null) {
      //                 //   paket_ = valueOfElement['harga_jasa_id']['paket_id']['keterangan'];
      //                 // }
      //                 //
      //                 // if (valueOfElement['harga_jasa_id']['asal_id'] != null) {
      //                 //   asal_ = normalizeLokasi(valueOfElement['harga_jasa_id']['asal_id']);
      //                 //       //valueOfElement['harga_jasa_id']['asal_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kodepos'];
      //                 // }
      //                 //
      //                 // if (valueOfElement['harga_jasa_id']['tujuan_id'] != null) {
      //                 //   tujuan_ = normalizeLokasi(valueOfElement['harga_jasa_id']['tujuan_id']);
      //                 //       //valueOfElement['harga_jasa_id']['tujuan_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kodepos'];
      //                 // }
      //                 //
      //                 // if (valueOfElement['harga_jasa_id']['tipe'] == 1) {
      //                 //
      //                 //   if (valueOfElement['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
      //                 //     action_ = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i>
      //                 //               </a>
      //                 //               <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
      //                 //           <i class="fas fa-trash text-danger"></i>
      //                 //         </a>`;
      //                 //     $('body .formGudang').css('display', 'block');
      //                 //     $('body .formGudang').attr('data-id', 'gudangValidate')
      //                 //   } else {
      //                 //     action_ = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete"><i class="fas fa-trash text-danger"></i></a>`;
      //                 //   }
      //                 // }
      //                 //
      //                 // if (valueOfElement['harga_jasa_id']['tipe'] == 3) {
      //                 //   //console.log('acton   _');
      //                 //   action_ = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
      //                 //           <i class="fas fa-trash text-danger"></i>
      //                 //         </a>`;
      //                 // }
      //                 //
      //                 // if (valueOfElement.harga_jasa_id['keterangan'] != null) {
      //                 //   keterangan_2 = valueOfElement.harga_jasa_id['keterangan'];
      //                 // }
      //                 //
      //                 // if (valueOfElement.harga != null) {
      //                 //   harga_2 = valueOfElement.harga
      //                 // }
      //                 //
      //                 // $(tabel).DataTable().row.add([
      //                 //   valueOfElement.harga_jasa_id['tipe'],
      //                 //   null,
      //                 //   null,
      //                 //   valueOfElement.harga_jasa_id['id'],
      //                 //   columnSN[indexInArray],
      //                 //   `<input type="number" value="` + valueOfElement.id_detail + `" readonly/>`,
      //                 //   null,
      //                 //   valueOfElement.harga_jasa_id['kode'],
      //                 //   keterangan_2,
      //                 //   `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="0"/>`,
      //                 //   `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious kodePajakElePrevious" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
      //                 //   `<input type="text" id="priceElement" class="form-control harga_nonPrice" value="${harga_2}" placeholder="0" />`,
      //                 //   `<span id="totalharga_">0</span>`,
      //                 //   action_,
      //                 //   produk_layanan_,
      //                 //   paket_,
      //                 //   asal_,
      //                 //   tujuan_,
      //                 // ]).draw();
      //
      //                 $.each(kodePajakElement, function (indexInArray, valueOfElement) {
      //                   $('.selectpickerPrevious').append(`<option value="${valueOfElement['id']}" nilai="${valueOfElement['nilai']}">${valueOfElement['nama']}</option>`)
      //                 });
      //
      //                 price_format_class('harga_nonPrice');
      //                 $('.selectpickerPrevious').selectpicker();
      //
      //             }
      //           });
      //         });
      //       }
      //     });
      //     notice('Data Pengiriman Pembelian di Tambahkan', 'success')
      //     $(tabel).DataTable().columns([11,12]).visible(false);
      //   }
      //   else {
      //
      //     // INI untuk Retur Penjualan
      //
      //
      //     // if (data.pengiriman_penjualan_header_id != null) {
      //     //   $('#retur_header_pengiriman_penjualan').val(data.pengiriman_penjualan_header_id)
      //     // }
      //
      //     let columnSN = [];
      //     $.ajax({
      //       type: "POST",
      //       timeout: 50000,
      //       url: host + '/penjualan/pengiriman-pesanan/list/by/detail',
      //       async: true,
      //       data: {
      //         'id_detail': data['id']
      //       },
      //       success: function (response) {
      //         if (response.data['length'] > 0) {
      //           data_detail = response['data'];
      //         }
      //
      //       //  console.log(data_detail);
      //
      //         $.each(data_detail, function (indexInArray, valueOfElement) {
      //         //  console.log(valueOfElement['id_detail'])
      //           $.ajax({
      //             type: "POST",
      //             timeout: 50000,
      //             url: host + '/penjualan/retur-penjualan/getStokByDetail',
      //             async: true,
      //             data: {
      //               'id': valueOfElement['id_detail'],
      //               'transaksi': 'pengiriman'
      //             },
      //             success: function (response) {
      //               let ads = [];
      //               ads['idx']          = indexInArray;
      //               ads['pajak'] = kodePajakElement;
      //               ads['stokTerpakai'] = response.map(nSeri);
      //               function nSeri(e) {
      //                 return e.nomor_seri;
      //               }
      //               $('#pelanggan_penjualan_retur_penjualan_add').val(valueOfElement['pelanggan_id']);
      //               $('#pelanggan_penjualan_retur_penjualan_add').selectpicker('refresh');
      //               addDetailRetur(tabel,valueOfElement,ads);
      //
      //             //  console.log(response);
      //             //   let temps = [];
      //             //
      //             //   // if (response['length'] > 0) {
      //             //
      //             //     $.each(response, function (index, value) {
      //             //       temps.push(value.nomor_seri)
      //             //     });
      //             //
      //             //     columnSN[indexInArray] = temps;
      //             //   //  console.log(columnSN)
      //             //     if (valueOfElement['harga_jasa_id']['produk_servis_id'] != null) {
      //             //       produk_layanan_ = valueOfElement['harga_jasa_id']['produk_servis_id']['keterangan'];
      //             //     }
      //             //
      //             //     if (valueOfElement['harga_jasa_id']['paket_id'] != null) {
      //             //       paket_ = valueOfElement['harga_jasa_id']['paket_id']['keterangan'];
      //             //     }
      //             //
      //             //     if (valueOfElement['harga_jasa_id']['asal_id'] != null) {
      //             //       asal_ =  normalizeLokasi(valueOfElement['harga_jasa_id']['asal_id']);
      //             //           //valueOfElement['harga_jasa_id']['asal_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kodepos'];
      //             //     }
      //             //
      //             //     if (valueOfElement['harga_jasa_id']['tujuan_id'] != null) {
      //             //       tujuan_ = normalizeLokasi(valueOfElement['harga_jasa_id']['tujuan_id']);
      //             //           //valueOfElement['harga_jasa_id']['tujuan_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kodepos'];
      //             //     }
      //             //
      //             //     if (valueOfElement['harga_jasa_id']['tipe'] == 1) {
      //             //
      //             //       if (valueOfElement['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
      //             //         action_ = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
      //             //               <i class="fas fa-trash text-danger"></i>
      //             //             </a>`;
      //             //         $('body .formGudang').css('display', 'block');
      //             //         $('body .formGudang').attr('data-id', 'gudangValidate')
      //             //       } else {
      //             //         action_ = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete"><i class="fas fa-trash text-danger"></i></a>`;
      //             //       }
      //             //     }
      //             //
      //             //
      //             //     if (valueOfElement['harga_jasa_id']['tipe'] == 3) {
      //             //       //console.log('apa  action');
      //             //       action_ = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
      //             //               <i class="fas fa-trash text-danger"></i>
      //             //             </a>`;
      //             //
      //             //     }
      //             //
      //             //     if (valueOfElement.harga_jasa_id['keterangan'] != null) {
      //             //       keterangan_2 = valueOfElement.harga_jasa_id['keterangan'];
      //             //     }
      //             //
      //             //     if (valueOfElement.harga != null) {
      //             //       harga_2 = valueOfElement.harga
      //             //     }
      //             //
      //             //
      //             //   //  console.log(stokSelect)
      //             //
      //             //     $(tabel).DataTable().row.add([
      //             //       valueOfElement.harga_jasa_id['tipe'],
      //             //       null,
      //             //       null,
      //             //       valueOfElement.harga_jasa_id['id'],
      //             //       columnSN[indexInArray],
      //             //       `<input type="number" value="` + valueOfElement.id_detail + `" readonly/>`,
      //             //       null,
      //             //       valueOfElement.harga_jasa_id['kode'],
      //             //       keterangan_2,
      //             //       `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="0"/>`,
      //             //       `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious kodePajakElePrevious" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
      //             //       `<input type="text" id="priceElement" class="form-control harga_nonPrice" value="${harga_2}" placeholder="0" />`,
      //             //       `<span id="totalharga_">0</span>`,
      //             //       action_,
      //             //       produk_layanan_,
      //             //       paket_,
      //             //       asal_,
      //             //       tujuan_,
      //             //     ]).draw();
      //             //
      //             //     $.each(kodePajakElement, function (indexInArray, valueOfElement) {
      //             //       $('.selectpickerPrevious').append(`<option value="${valueOfElement['id']}" nilai="${valueOfElement['nilai']}">${valueOfElement['nama']}</option>`)
      //             //     });
      //             //
      //             //     price_format_class('harga_nonPrice');
      //             //     $('.selectpickerPrevious').selectpicker();
      //
      //             }
      //           });
      //         });
      //
      //       }
      //     })
      //   }
      //
      //
      //
      //
      //   // if (data.kena_pajak > 0) {
      //
      //   //   if (mode != 'penjualan') {
      //   //     $('#kena_pajak_retur_pembelian_add_retur_pembelian').prop("checked", true);
      //   //     if (data.termasuk_pajak != null) {
      //   //       $('#dengan_pajak_pesanan_pembelian').prop("checked", true);
      //   //     }
      //   //   } else {
      //   //     $('#kena_pajak_retur_penjualan_add_retur_penjualan').prop("checked", true);
      //   //     if (data.termasuk_pajak != null) {
      //   //       $('#dengan_pajak_retur_penjualan_add_retur_penjualan').prop("checked", true);
      //   //     }
      //   //   }
      //
      //   //   if (valueOfElement.kode_pajak_id != null) {
      //   //     $(`.kodePajakElePrevious${indexInArray}`).selectpicker('val', valueOfElement.kode_pajak_id['id']);
      //   //     $(`.kodePajakElePrevious${indexInArray}`).selectpicker('refresh');
      //   //   }
      //
      //   // }
      //
      //   // if (mode == 'pembelian') {
      //   //   $('#gudang-return-pembelian').selectpicker('val', data.gudang_id);
      //   // }
      //
      //
      //
      // }

    } else {
      notice('Data Faktur Pembelian Belum di Pilih', 'warning')
    }

  })

  this.previousTransactions = function (tablename, url, type, vendorType) {
    var vendorValue = '';

    if (vendorType == 'pemasok') {
      vendorValue = 'pemasok';
    } else {
      vendorValue = 'pelanggan';
    }

    $(`#${tablename} thead tr`).first().clone(false).appendTo(`#${tablename} thead`);
    $(`#${tablename} thead tr:eq(1) th`).each(function (i) {
      var title = $(this).text();
      if (title == 'ID') {
        $(this).html('');
      } else {
        $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
      }

      // $('input', this).on('keypress  ', function (e) {
      //   if (e.which == 13) {
      //     table
      //       .column(i)
      //       .search(this.value)
      //       .draw();
      //   }
      // });

      $('input', this).on('keyup', function (e) {
        //if (e.which == 13) {
        table
              .column(i)
              .search(this.value)
              .draw();
        //}
      });
    });

    table = $(`#${tablename}`).DataTable({
      orderCellsTop: true,
      dom: "tpr",
      rowId: 'id',
      pageLength: 5,
      processing: true,
      serverSide: true,
      ajax: {
        url: host + '/' + url,
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        async: true,
        data: function (d) {
          d.id = $(type).val();
          d.type = 'pemasok_id';
        },
        error: function (res) {
          $('.dataTables_processing').hide();
          notice(res.responseJSON.message, 'error');
        }
      },
      deferRender: true,
      responsive: !0,
      select: {
        style: 'single'
      },
      sorting: [
        [1, "asc"]
      ],
      pagingType: "full_numbers",
      language: {
        "zeroRecords": "Data tidak ditemukan...",
        "processing": '<span class="text-danger">Mengambil Data....</span>'
      },
      lengthMenu: [
        [10, 40, 50, 100],
        [10, 20, 50, 100]
      ],
      columns: [{
          data: 'id'
        },
        {
          data: 'nomor'
        },
        {
          data: 'tanggal'
        },
        {
          data: `${vendorValue}`
        },
        {
          data: 'kuantitas'
        }
      ],
      columnDefs: [{
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

    this.addDataRelations = function (tblJadwal, syaratPengirimanElement, hargaJasaTable, urlDetail, syaratPengirimanListElement, elementOptional, kodePajakElement, typeData, downPayment, tblUangMuka, typeSubData, denganPajak, kenaPajak, syaratPengirimanValueList, listUlSyaratPengiriman, mode, type, modules, gudangElement, gudangList, valVendors, typeTransaksi) {
    //  console.log('dsfdsc');
      data = this.tableInit.row(".selected").data();
      var params = {
        url: urlDetail,
        data: {
          'id_detail': data['id']
        },
        status: 'previousTransactions',
        var: {
          'tblJadwal': tblJadwal,
          'syaratPengirimanElement': syaratPengirimanElement,
          'hargaJasaTable': hargaJasaTable,
          'urlDetail': urlDetail,
          'syaratPengirimanListElement': syaratPengirimanListElement,
          'elementOptional': elementOptional,
          'kodePajakElement': kodePajakElement,
          'typeData': typeData,
          'downPayment': downPayment,
          'tblUangMuka': tblUangMuka,
          'typeSubData': typeSubData,
          'denganPajak': denganPajak,
          'kenaPajak': kenaPajak,
          'syaratPengirimanValueList': syaratPengirimanValueList,
          'listUlSyaratPengiriman': listUlSyaratPengiriman,
          'mode': mode,
          'type': type,
          'modules': modules,
          'gudangElement': gudangElement,
          'gudangList': gudangList,
          'valVendors': valVendors,
          'typeTransaksi': typeTransaksi
        }
      }
      this.ajaxGroup(params);

      // $.ajaxSetup({
      //   headers: {
      //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   }
      // });

      var time = 500;


    }
  }

  this.ControlSN = function (HargaJasaTable, uangMuka) {
    this.table = HargaJasaTable;
  //  console.log(uangMuka)
    if (uangMuka != undefined) {
      this.tableUangMuka = uangMuka
    }

  //  console.log(this.tableUangMuka);

  }

  this.addBarangDetail = function (data, hargaJasaId) {

    //BarangForShipping[hargaJasaId] = data;
    console.log(modulAct);
    console.log(detailExpedisi[modulAct]);
    var idh = 'b-'+hargaJasaId.toString();
    detailExpedisi[modulAct][idh] = data;
    $('#modalBarang').modal('hide');
  }

  this.addModalBarang = function (thisBarang, url, dataParams, vendors, mainTab,tanggal,nomor) {

    valueIndex = this.table.tableInit.row(thisBarang).index();
    valueData  = this.table.tableInit.row(thisBarang).data();
     console.log(valueData);
    // console.log(modulAct);
  
    let paket = '';
    let jadwalPengiriman = '';
    let hargaJasaId  = this.table.tableInit.cell(valueIndex, 6).nodes().to$().find('input').val();
    let kuantitas    = this.table.tableInit.cell(valueIndex, 9).nodes().to$().find('input').val();
    let IdVendors    = $(vendors).val();
    let no_identitas = nomor +'-';
    console.log(pageAct);
    console.log(hargaJasaId);
    if(pageAct == 'ReturPembelian'  || pageAct == 'ReturPenjualan'){ hargaJasaId = this.table.tableInit.cell(valueIndex, 3).nodes().to$().find('input').val(); }
    // console.log(dataParams);
    // console.log(hargaJasaId);

    if (mainTab == 'penjualan_pengiriman_pesanan' || mainTab == 'pembelian_pengiriman_pembelian') {
      paket = valueData[12];
    } else {
      paket = valueData[15];
    }

    if (dataParams != null && _this.SNdata.length == 0) {
      //BarangForShipping = dataParams;
    }

    if (valueData[3] != null) {
      jadwalPengiriman = {
        'nomor': valueData[3][7],
        'asal': valueData[3][9],
        'tujuan': valueData[3][10],
        'etd_asal': valueData[3][16],
        'etd_tujuan': valueData[3][17],
        'voyage': valueData[3][12],
      }
    }
    let dataDetailx = 0;
    var keyb = 'b-'+hargaJasaId;


    if (dataParams !== undefined || dataParams !== null){

      //console.log(dataParams[keyb]);
      if(dataParams[keyb] !== undefined){
        dataDetailx = dataParams[keyb];
      }

    }
    // else{
    //     if(dataParams.length > 0){
    //
    //     }
    // }
    console.log(dataDetailx);
    console.log()
    var params = {
      url: url,
      data: {
        'dataBarang': dataDetailx,
        'hargaJasaId': hargaJasaId,
        'kuantitas': kuantitas,
        'paket': paket,
        'vendors': IdVendors,
        'jadwalPengiriman': jadwalPengiriman,
        'tanggal' :tanggal,
        'identitas': no_identitas,
        'modul': modulAct
        //'dataSebelum' : dataSebelum,
        //'dataBarangEx' : dataBarangx,
      },
      modal: '#modalBarang',
      status: 'modalShow'
    }
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    this.ajaxGroup(params);

  //   var dataBarang;
  //   if (BarangForShipping[hargaJasaId] == undefined) {
  //     dataBarang = 0;
  //     //console.log(BarangForShipping);
  //     if(BarangForShipping instanceof Object){
  //       if(BarangForShipping.length > 0){
  //         $.each(BarangForShipping, function(index, value) {
  //           console.log(value);
  //           if (value != undefined){
  //             if (value.tanda_kemasan.length == kuantitas){
  //               dataBarang = value;
  //             }
  //           }
  //
  //         });
  //       }
  //     }else{
  //       BarangForShipping.forEach(myFunction);
  //       function myFunction(item, index) {
  //         if (item['tanda_kemasan'].length == kuantitas){
  //           dataBarang = item;
  //         }
  //       }
  //     }
  //   }
  //   else{
  //     dataBarang = BarangForShipping[hargaJasaId];
  //   }
  //
  // // Data Barang X
  //   //console.log(detailExpedisi);
  //   var dataBarangx;
  //   if (detailExpedisi[g_transaksi][hargaJasaId] == undefined) {
  //     dataBarangx = 0;
  //     console.log(detailExpedisi);
  //     detailExpedisi[g_transaksi].forEach(myFunction);
  //     function myFunction(item, index) {
  //       if (item != undefined){
  //         if (item['tanda_kemasan'].length == kuantitas){
  //           console.log(item);
  //           dataBarangx = item;
  //         }
  //       }
  //     }
  //   }
  //   else{
  //     dataBarangx = detailExpedisi[g_transaksi][hargaJasaId];
  //   }

    // Data Barang X

    //var dataSebelum = detailExpedisi[g_transaksi];//BarangForShipping;



    // if (BarangForShipping[hargaJasaId] == undefined) {
    //   $.ajaxSetup({
    //     headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    //   });
    //
    //   var params = {
    //     url: url,
    //     data: {
    //       'dataBarang': 0,
    //       'hargaJasaId': hargaJasaId,
    //       'kuantitas': kuantitas,
    //       'paket': paket,
    //       'vendors': IdVendors,
    //       'jadwalPengiriman': jadwalPengiriman,
    //       'tanggal' :tanggal,
    //       'identitas': no_identitas,
    //       'penerima': penerima,
    //     },
    //     modal: '#modalBarang',
    //     status: 'modalShow'
    //   }
    //   this.ajaxGroup(params);
    // }
    // else {
    // //  console.log(BarangForShipping[hargaJasaId]);
    //   $.ajaxSetup({
    //     headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    //   });
    //   var params = {
    //     url: url,
    //     data: {
    //       'dataBarang': BarangForShipping[hargaJasaId],
    //       'hargaJasaId': hargaJasaId,
    //       'kuantitas': kuantitas,
    //       'paket': paket,
    //       'vendors': IdVendors,
    //       'jadwalPengiriman': jadwalPengiriman,
    //       'tanggal' :tanggal,
    //       'identitas': no_identitas,
    //       'penerima': penerima,
    //     },
    //     modal: '#modalBarang',
    //     status: 'modalShow'
    //   }
    //   this.ajaxGroup(params);
    // }
  }

  this.print_delivery_invoice = function (index, data, pengirim) {
    console.log(data)
    var result_data = {
      'index': index,
      'result': data,
      'dataShipper': pengirim,
      // 'penerima': penerima,
      // 'penerima_x': penerimax,
    }

    console.log(result_data);

    var params = {
      status: 'printDO',
      url: `penjualan/pengiriman_pesanan/print_delivery_goods`,
      data: result_data,
    }
    this.ajaxGroup(params);

    // page_print_delivery('penjualan_pengiriman_pesanan', `quotation_${index}`, `penjualan/pengiriman_pesanan/print_delivery_goods`, 'Quotation', result_data);
    // page_print_delivery(`penjualan/pengiriman_pesanan/print_delivery_goods/${result_data}`);
  }

  this.addSerialNumberPenjualan = function (thisEle, url, dataParamsAdditional) {
    // console.log(this.table.tableInit.rows().data().toArray());
    var indexHargaJasa = this.table.tableInit.row(thisEle).index();
    var id_Tables = this.table.tableInit.tables().nodes().to$().attr('id');
    var stokTersedia = this.table.tableInit.cell(indexHargaJasa, 4).data();
    var dataSN = this.table.tableInit.cell(indexHargaJasa, 1).data();
    var stokById = '';
    // console.log(dataSN);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    if (dataSN != null) {
      stokById = dataSN;
    } else {
      stokById = 0;
    }

    var params = {
      url: url,
      data: {
        'stokTersedia': stokTersedia,
        'indexHargaJasa': indexHargaJasa,
        'id_Tables': id_Tables,
        'stokById': stokById,
      },
      modal: '#ModalSN',
      status: 'modalShow'
    }
    this.ajaxGroup(params);
  }

  this.addSerialNumber = function (thisEle, url, dataParamsAdditional) {
    var index = this.table.tableInit.row(thisEle).index();
    var qty = this.table.tableInit.cell(index, 6).nodes().to$().find('input').val();
    var id_Tables = this.table.tableInit.tables().nodes().to$().attr('id');
    var dataSN = this.table.tableInit.cell(index, 1).data();
    var hargaJasaId = this.table.tableInit.cell(index, 6).nodes().to$().find('input').val();
    var stokById = '';
    // console.log(this.table.tableInit.row(thisEle).data());
    if (dataSN != null) {
      stokById = dataSN;
    } else {
      stokById = 0;
    }

    var params = {
      url: url,
      data: {
        'index': index,
        'kuantitas': qty,
        'SNbyId': stokById,
        'id_Tables': id_Tables,
        'hargaJasaId': hargaJasaId
      },
      modal: '#ModalSN',
      status: 'modalShow'
    }
    this.ajaxGroup(params);

  }

  this.totalHarga = function (thisEle) {

    var html = '';
    let ttl_per_row = 0;

    index = this.table.tableInit.row(thisEle).index();
    var qty = this.table.tableInit.cell(index, 9).nodes().to$().find('input').val();
    var valuePrice = this.table.tableInit.cell(index, 11).nodes().to$().find('input').val();
    html = qty * valuePrice.replace(/,/g, "");
    // if(html.includes('.')){
    //
    // }
    ttl_per_row += parseInt(html);
    console.log(ttl_per_row);
    this.table.tableInit.cell(index, 12).nodes().to$().find('span').html(ttl_per_row.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

  }

  this.totalHargaUangMuka = function (thisEle, type) {
    index = this.tableUangMuka.tableInit.row(thisEle).index();
    // console.log(this.tableUangMuka.tableInit.rows().data().toArray())
    // constan Uang Muka Nominal
    const sisaFlat = this.tableUangMuka.tableInit.cell(index, 5).nodes().to$().find('input').val();
    var sisa = this.tableUangMuka.tableInit.cell(index, 11).nodes().to$().find('input').val();
    var nominal = this.tableUangMuka.tableInit.cell(index, 12).nodes().to$().find('input').val();
    var result;
    var result2;

    // console.log(sisaFlat)

    if (type == 'add') {

      result = sisaFlat.replace(/,/g, "") - nominal.replace(/,/g, "");
      result2 = nominal.replace(/,/g, "") + sisa.replace(/,/g, "");

      if (nominal.replace(/,/g, "") == 0) {
        this.tableUangMuka.tableInit.cell(index, 11).nodes().to$().find('input').val(sisaFlat.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
      }

      // console.log(result);

      if (result > 0) {
        this.tableUangMuka.tableInit.cell(index, 11).nodes().to$().find('input').val(result.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
      } else {
        //console.log('else result : ' + result);
        this.tableUangMuka.tableInit.cell(index, 11).nodes().to$().find('input').val(result.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        if (result < 0) {
          this.tableUangMuka.tableInit.cell(index, 11).nodes().to$().find('input').val(result.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
          notice('Nominal Melebihi', 'warning');
        }
      }

    } else {
      result = sisaFlat.replace(/,/g, "") - nominal.replace(/,/g, "");
      // console.log('totalHarga : ' + sisaFlat);
      // console.log('totalHarga : ' + nominal);
      // console.log('hasilnya : ' + result);
      this.tableUangMuka.tableInit.cell(index, 8).nodes().to$().find('input').val(result.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
    }

  }

  this.tampungSN = function (data) {
    _this.SNdata = data;
  }

  this.tampungBarang = function (data) {
    //console.log(data);
    console.log(modulAct);
   // BarangForShipping = data;
    detailExpedisi[modulAct] =[];
    $.each(data, function (key, value) {
      var newKey = 'b-'+key;
      detailExpedisi[modulAct][newKey] = value;
    });
  }

  this.tampungJadwal = function (params) {
    dataJadwalArray = params;
  }

  this.tampungSyarat = function (params) {
    dataSyaratArrayPengiriman = params;
  }

  this.addSN = function (data, tables, index) {
    $(`#${tables}`).DataTable().cell(index, 1).data(data);
    $('#ModalSN').modal('hide');
  }

  this.addSyarat = function (data, index, tabels) {
    if (data.length > 0) {
      $(`#${tabels}`).DataTable().cell(index, 2).data(data);
      notice('Data Berhasil di Tambahkan', 'success');
      // console.log($(`#${tabels}`).DataTable().rows().data().toArray());
      $('#ModalSyaratPengiriman').modal('hide');
    } else {
      notice('Syarat Pengiriman Belum di Pilh', 'warning');
    }

  }

  this.postData = function (hargaJasaTable, UangMukaTable) {
    this.hargaJasaTable = hargaJasaTable;
    this.UangMukaTable = UangMukaTable;
    var detail;
    // ControlSN(hargaJasaTable);    
  }

  this.store = function (btnElement, url, form, table, modul, mode) {
    var dataArray = this.hargaJasaTable.tableInit.rows().data().toArray();
    // console.log(dataArray);
    // console.log(modulAct);
    console.log(_this.SNdata);
    var respon;
    var uang_muka_val;
    var tampungSN = Object.assign({}, _this.SNdata);
    //var tampungBarangforShipping = Object.assign({}, BarangForShipping);
    //var dataDetailPengiriman = Object.assign({}, detailExpedisi);
    var syaratValue = Object.assign({}, dataSyaratArrayPengiriman);
    var jadwalValue = Object.assign({}, dataJadwalArray);
    var detail_count = this.hargaJasaTable.tableInit.rows().count();
    var beban = [];
    var dataDetailPengiriman = null;
    var dataDetailPengiriman2 = {};
    var oldExpedisi = [];

    if (this.hargaJasaTable.tableInit == null){
      alert('Tabel Harga Jasa Tidak Ditemukan')
    }

    if (detail_count > 0) {
      detail = this.hargaJasaTable.tableInit.rows().data().toArray();
      for (let index = 0; index < detail.length; index++) {
        detail[index][5] = this.hargaJasaTable.tableInit.cell(index, 5).nodes().to$().find('input').val();
        detail[index][6] = this.hargaJasaTable.tableInit.cell(index, 6).nodes().to$().find('input').val();
        detail[index][8] = this.hargaJasaTable.tableInit.cell(index, 8).nodes().to$().find('input').val();
        detail[index][9] = this.hargaJasaTable.tableInit.cell(index, 9).nodes().to$().find('input').val();
        detail[index][10] = this.hargaJasaTable.tableInit.cell(index, 10).nodes().to$().find('select').val();
        detail[index][11] = this.hargaJasaTable.tableInit.cell(index, 11).nodes().to$().find('input').val();

      }

      // Handle Data Uang Muka Faktur
      if (this.UangMukaTable != null) {
        var uangMukaCount = this.UangMukaTable.tableInit.rows().count();
        if (uangMukaCount > 0) {
          uang_muka_val = this.UangMukaTable.tableInit.rows().data().toArray();
          for (let index = 0; index < uang_muka_val.length; index++) {
            uang_muka_val[index][5] = this.UangMukaTable.tableInit.cell(index, 5).nodes().to$().find('input').val()
            uang_muka_val[index][6] = this.UangMukaTable.tableInit.cell(index, 6).nodes().to$().find('input').val()
            uang_muka_val[index][11] = this.UangMukaTable.tableInit.cell(index, 11).nodes().to$().find('input').val()
            uang_muka_val[index][12] = this.UangMukaTable.tableInit.cell(index, 12).nodes().to$().find('input').val()
          }
        }
      }

      // Handle Data Beban Faktur
      if (this.tabelBebanFaktur != null){
        if( this.tabelBebanFaktur.rows().count() > 0){
          beban = [];
          for (let index = 0; index < this.tabelBebanFaktur.rows().count(); index++) {

            var akunBeban = this.tabelBebanFaktur.cell(index, 0).nodes().to$().find('select').val();
            var nilaiBeban = this.tabelBebanFaktur.cell(index, 1).nodes().to$().find('input').val();
            var keteranganBeban = this.tabelBebanFaktur.cell(index, 2).nodes().to$().find('input').val();

            var baris = [akunBeban,nilaiBeban,keteranganBeban];
            beban.push(baris);
          }
        }
      }
      var dataHeader            = JSON.stringify($(`#${form}`).serializeArray());
      var dataDetail            = JSON.stringify(detail);
      var dataBeban             = JSON.stringify(beban);
      var dataUangMuka          = JSON.stringify(uang_muka_val);
      var collectExpedisi = [];

      if( detailExpedisi[modulAct] !== undefined){
        console.log('ada');
        dataDetailPengiriman = Object.assign({}, detailExpedisi[modulAct]);
        $.each(dataDetailPengiriman, function (idc, ev) {
          console.log(idc);
          collectExpedisi[idc] = {
            'nomor' : ev.nomor,
            'nomor_segel' : ev.nomor_segel,
            'tanda_kemasan' : ev.tanda_kemasan,
            'paket' : ev.paket,
            'asal_barang' : ev.asal_barang,
            'tujuan_barang' : ev.tujuan_barang,
            'pembayar' : ev.pembayar,
            'penerima' : ev.penerima,
            'jenis_barang' : ev.jenis_barang,
            'alat_transportasi' : ev.alat_transportasi,
          }
        })
        dataDetailPengiriman  = Object.assign({}, collectExpedisi);
      }

       KTUtil.btnWait(btnElement, "spinner spinner-right spinner-white pr-15", "Please wait");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
      $.ajax({
        type: "POST",
        async: true,
        timeout: 50000,
        url: host + '/' + url,
        data: {
          'header': dataHeader,
          'detail': dataDetail,
          'jadwalPengiriman': jadwalValue,
          'syaratPengiriman': syaratValue,
          'beban': dataBeban,
          //'barangDetail': tampungBarangforShipping,
          'detailPengiriman': dataDetailPengiriman,
          //'detailP': dataDetailPengiriman2,
          'SN': tampungSN,
          'uang_muka_val': dataUangMuka,
          'modul': modulAct,

        },
        success: function (res) {
          // console.log(res);
          var data = JSON.parse(res);
          KTUtil.btnRelease(btnElement);
          if (data.status !== false) {
            close_content_tab(`${modul}`, `${mode}`);
            Swal.fire('Berhasil!', data.message, 'success')
            reload_table(`${table}`);
            _this.SNdata = [];
            BarangForShipping = [];
            BarangForShipping.length = 0;
            BarangForShipping.splice(0, BarangForShipping.length);
            //delete detailExpedisi[modulAct];

          } else {
            notice(`${data.message}`, 'warning');
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
    }
    else {
      KTUtil.btnRelease(btnElement);
      notice('Harga Jasa belum di pilih', 'warning');
    }


  }

  this.downPayment = function (url, form, table, modul, mode, urlRedirect, labelUangMuka) {

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

        var dataArray = this.hargaJasaTable.tableInit.rows().data().toArray();
        var respon;
       // console.log(dataArray);
        var uang_muka_val;

        var detail_count = this.hargaJasaTable.tableInit.rows().count();
        if (detail_count > 0) {
          var detail = this.hargaJasaTable.tableInit.rows().data().toArray();

          for (let index = 0; index < detail.length; index++) {
            detail[index][5] = this.hargaJasaTable.tableInit.cell(index, 5).nodes().to$().find('input').val();
            detail[index][6] = this.hargaJasaTable.tableInit.cell(index, 6).nodes().to$().find('input').val();
            detail[index][9] = this.hargaJasaTable.tableInit.cell(index, 9).nodes().to$().find('input').val();
            detail[index][10] = this.hargaJasaTable.tableInit.cell(index, 10).nodes().to$().find('select').val();
            detail[index][11] = this.hargaJasaTable.tableInit.cell(index, 11).nodes().to$().find('input').val();
          }

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type: "POST",
            async: true,
            timeout: 50000,
            url: host + '/' + url,
            data: {
              'header': JSON.stringify($(`#${form}`).serializeArray()),
              'detail': JSON.stringify(detail),
            },
            success: function (res) {

              data_value = JSON.parse(res);
              if (data_value.status !== false) {
                notice('Transaksi berhasil di buat', 'success');
                reload_table(`${table}`);
                // setTimeout(function name(params) {
                add_content_tab(`${modul}`, 'uang_muka', `${urlRedirect}` + data_value.data['id'] + '', `${labelUangMuka}`, '', 'GET');
                close_content_tab(`${modul}`, `${mode}`);
                // },2500)
              } else {
                notice(`${data_value.message}`, 'warning');
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
          // KTUtil.btnRelease(btnElement_pembelian_pesanan_pembelian);
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

  this.printTransaction = function (btnElement, url, form, table, modul, mode, modules, types) {
    // console.log('Btn Element : ' + btnElement);
    // console.log('Url : ' + url);
    // console.log('Form : ' + form);
    // console.log('Table : ' + table);
    // console.log('modul : ' + modul);
    // console.log('mode : ' + mode);
    // console.log('modules : ' + modules);
    // console.log('types : ' + types);

    if (types != 'create') {

      let id = types.substring(7)
      // console.log(id)
      add_content_tab(`${modul}`, 'quotation', `struk/${id}/nota/${modules}`, 'Quotation')
      close_content_tab(`${modul}`, `${mode}`);

    } else {

      var uang_muka_val;

      var tampungSN = Object.assign({}, _this.SNdata);
      var tampungBarangforShipping = Object.assign({}, BarangForShipping);
      // console.log(transaksiIni);
      // console.log(detailExpedisi[transaksiIni]);
      var tampungBarangforShippingx = Object.assign({}, detailExpedisi);

      var detail_count = this.hargaJasaTable.tableInit.rows().count();
      if (detail_count > 0) {
        detail = this.hargaJasaTable.tableInit.rows().data().toArray();
        for (let index = 0; index < detail.length; index++) {
          detail[index][5] = this.hargaJasaTable.tableInit.cell(index, 5).nodes().to$().find('input').val();
          detail[index][6] = this.hargaJasaTable.tableInit.cell(index, 6).nodes().to$().find('input').val();
          detail[index][9] = this.hargaJasaTable.tableInit.cell(index, 9).nodes().to$().find('input').val();
          detail[index][8] = this.hargaJasaTable.tableInit.cell(index, 8).nodes().to$().find('input').val();
          detail[index][10] = this.hargaJasaTable.tableInit.cell(index, 10).nodes().to$().find('select').val();
          detail[index][11] = this.hargaJasaTable.tableInit.cell(index, 11).nodes().to$().find('input').val();
        }

        if (this.UangMukaTable != null) {

          var uangMukaCount = this.UangMukaTable.tableInit.rows().count();
          if (uangMukaCount > 0) {
            uang_muka_val = this.UangMukaTable.tableInit.rows().data().toArray();
            for (let index = 0; index < uang_muka_val.length; index++) {
              uang_muka_val[index][5] = this.UangMukaTable.tableInit.cell(index, 5).nodes().to$().find('input').val()
              uang_muka_val[index][6] = this.UangMukaTable.tableInit.cell(index, 6).nodes().to$().find('input').val()
              uang_muka_val[index][11] = this.UangMukaTable.tableInit.cell(index, 11).nodes().to$().find('input').val()
              uang_muka_val[index][12] = this.UangMukaTable.tableInit.cell(index, 12).nodes().to$().find('input').val()
            }
          }

        }

        KTUtil.btnWait(btnElement, "spinner spinner-right spinner-white pr-15", "Please wait");
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "POST",
          async: true,
          timeout: 50000,
          url: host + '/' + url,
          data: {
            'barangDetail': tampungBarangforShipping,
            'barangDetailx': tampungBarangforShippingx,
            'header': JSON.stringify($(`#${form}`).serializeArray()),
            'detail': JSON.stringify(detail),
            'uang_muka_val': JSON.stringify(uang_muka_val),
          },
          success: function (res) {
            KTUtil.btnRelease(btnElement);
            data_value = JSON.parse(res);
            if (data_value.status !== false) {
              // console.log(types);
              notice('Transaksi berhasil di buat', 'success');
              reload_table(`${table}`);
              add_content_tab(`${modul}`, 'quotation', `struk/${data_value.data['id']}/nota/${modules}`, 'Quotation')
              close_content_tab(`${modul}`, `${mode}`);
            } else {
              notice(`${data_value.message}`, 'warning');
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

  }

  this.ShowPiutangGet = function (table, element) {
    var params = {
      url: 'penjualan/penerimaan-penjualan/getpiutang',
      data: {
        'value': $(`#${element}`).val()
      },
      status: 'showPiutang',
      var: {
        'table': table
      }
    }
    this.ajaxGroup(params);
  }

  this.show_hutang_list = function (table, type) {
    var params = {
      url: 'pembelian/pembayaran-pembelian/get/hutang',
      data: {
        'value': $(`#pemasok_pembayaran_pembelian_${type}`).val()
      },
      status: 'showHutang',
      var: {
        'table': table
      }
    }
    this.ajaxGroup(params);
  }

  this.showStokBarangJasa = function (id, kode) {
    var params = {
      url: 'master-data/harga-jasa/stok_per_gudang',
      data: {
        'id': id,
        'kode': kode
      },
      modal: '#stokbarang',
      status: 'modalShow'
    }
    this.ajaxGroup(params);
    // console.log(id);
    // console.log(kode);
    // $.ajaxSetup({
    //   headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //   }
    // });
    // $.ajax({
    //   type: "POST",
    //   timeout: 50000,
    //   url : host+'/master-data/harga-jasa/stok_per_gudang',
    //   async: true,
    //   data: {
    //       'id' : id,
    //       'kode' : kode
    //   },
    //   success: function (res) {
    //     $('#stokbarang .modal-dialog').html('');
    //     $('#stokbarang .modal-dialog').html(res);
    //     $('#stokbarang').modal('show');
    //   }
    // });
  }

  this.uangMukaFaktur = function (table, url, vendors) {
    if ($(vendors).val() !== '') {
      var params = {
        url: url,
        data: {
          'table': table,
          'vendorsElement': vendors,
          'vendorsValue': $(vendors).val()
        },
        modal: '#modal_uang_muka',
        status: 'modalShow'
      }
      this.ajaxGroup(params);
    } else {
      notice('Data Pemasok / Pelanggan Belum Dipilih !!!', 'warning');
    }
  }

  this.rowAddUangMukaFaktur = function (tableData, tblUangMuka) {
    var produk_layanan = 'Uang Muka';
    // $(tblUangMuka).DataTable().clear().draw();
    data = $(tableData).DataTable().row(".selected").data();
    // console.log(data);
    $(tblUangMuka).DataTable().row.add([
      null,
      null,
      null,
      null,
      null,
      `<input type="hidden" value="` + data.sisa_uang_muka + `">`,
      `<input type="text" value="${data.faktur_pembelian_header_id}">`,
      data.nomor,
      `Uang Muka`,
      data.tanggal,
      `<span>${data.uang_muka.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span>`,
      `<input type="text" value="` + data.sisa_uang_muka + `" class="form-control harga_nominal form-control-solid" id="sisaUangMuka">`,
      `<input type="text" name="nominal_uang_muka" id="nominalUangMuka" class="form-control harga_nominal" value="0"/>`,
      `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="deleteUangMuka">
                      <span class="svg-icon svg-icon-md">
                          <i class="flaticon2-trash text-danger"></i>
                      </span>
                    </a>`
    ]).draw();
    price_format_class('harga_nominal');
    notice('Uang Muka Telah di Tambahkan', 'success');
    $('#modal_uang_muka').modal('hide');
  }

  this.uangMukaSisa = function (tablename, url, vendors) {

    $(`#${tablename} thead tr`).first().clone(false).appendTo(`#${tablename} thead`);
    $(`#${tablename} thead tr:eq(1) th`).each(function (i) {
      var title = $(this).text();
      if (title == 'ID') {
        $(this).html('');
      } else {
        $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
      }

      // $('input', this).on('keypress', function (e) {
      //   if (e.which == 13) {
      //     table
      //       .column(i)
      //       .search(this.value)
      //       .draw();
      //   }
      // });

      $('input', this).on('keyup', function (e) {
        // if (e.which == 13) {
          table
              .column(i)
              .search(this.value)
              .draw();
        // }
      });
    });

    table = $(`#${tablename}`).DataTable({
      dom: "tpr",
      rowId: 'id',
      pageLength: 5,
      processing: true,
      serverSide: true,
      ajax: {
        url: host + '/' + url,
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        async: true,
        data: {
          'vendors_id': $(vendors).val()
        },
        error: function (res) {
          $('.dataTables_processing').hide();
          notice(res.responseJSON.message, 'error');
        }
      },
      deferRender: true,
      responsive: !0,
      select: {
        style: 'single'
      },
      sorting: [
        [1, "asc"]
      ],
      pagingType: "full_numbers",
      language: {
        "zeroRecords": "Data tidak ditemukan...",
        "processing": '<span class="text-danger">Mengambil Data....</span>'
      },
      columns: [{
          data: 'id'
        },
        {
          data: 'nomor'
        },
        {
          data: 'produk_layanan'
        },
        {
          data: 'tanggal'
        },
        {
          data: 'uang_muka'
        },
        {
          data: 'sisa_uang_muka'
        },
      ],
      columnDefs: [{
          "defaultContent": "-",
          "targets": "_all"
        },
        {
          targets: 0,
          orderable: false,
          searchable: false,
          visible: false,
        },
        {
          targets: [4, 5],
          "render": function (data, type, row) {
            return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }
        },
      ]
    });
  }

  this.setting_column_all = function (table, type, value_type, row_pajak, row_qty, row_harga, title) {

    var harga = [],
      pajak = []
    var grand_total = 0;
    var total = 0;
    var totalPajak = 0;
    var nilai_pajak;
    let element = '';
    let val_pajak_second = [];
    let val_pajak_one = [];

    var intVal = function (i) {
      return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
    };
    $(`.${title}-pajak-box_${type}_${value_type}`).remove();
    $(`.${title}_beban_${type}_${value_type}`).remove();
    var totalHarga = 0;
    var grandTotal = 0;
    var nilaiPajakAkhir = 0;
    var totalBeban = 0;



    if (this.tabelBebanFaktur != null){
      if( this.tabelBebanFaktur.rows().count() > 0){
        console.log(title+type+value_type)
        $(`#bottom_table_${title}_${type}_${value_type}`).prepend(`
          <div class="alert alert-warning mb-5 p-5 ml-5 mt-5 ${title}_beban_${type}_${value_type}" role="alert" id="">
            <strong>Beban</strong>
            <div class="border-bottom border-white opacity-20 mb-5"></div>
            <h4 class="alert-heading">Rp. <span class="float-right ml-2" id="nilai_beban_${title}_${type}_${value_type}">0</span></h4>
          </div>
        `);

        for (let index = 0; index < this.tabelBebanFaktur.rows().count(); index++) {
          var nilaiBeban = this.tabelBebanFaktur.cell(index, 1).nodes().to$().find('input').val();
          totalBeban += parseInt(nilaiBeban.replace(/,/g, ""));
        }
        $(`#nilai_beban_${title}_${type}_${value_type}`).html(totalBeban.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
      }
    }

    $(table).DataTable().rows().every(function (rowIdx, tableLoop, rowLoop) {
      var cell_kode_pajak = $(table).DataTable().cell({
        row: rowIdx,
        column: row_pajak
      }).node();
      var cell_harga = $(table).DataTable().cell({
        row: rowIdx,
        column: row_harga
      }).node();
      var cell_qty = $(table).DataTable().cell({
        row: rowIdx,
        column: row_qty
      }).node();
      var val_pajak = $('option:selected', cell_kode_pajak).attr('nilai');
      var type_pajak = $('option:selected', cell_kode_pajak).text();
      var sum_harga = 0;
      var nilaiPajak = 0;

      var nHarga = $('input', cell_harga).val().replace(/,/g, "");
      var nkt = $('input', cell_qty).val();
      var hargaPerRow = nHarga * nkt;
      //var hargaPerRow = $('input', cell_harga).val().replace(/,/g, "") * $('input', cell_qty).val();

      totalHarga += hargaPerRow;
      grandTotal = totalHarga+totalBeban;

      if ($(`#kena_pajak_${title}_${type}_${value_type}`).prop("checked") == true){
        if ($(`#dengan_pajak_${title}_${type}_${value_type}`).prop("checked") == true){
          nilaiPajak = hargaPerRow - hargaPerRow / ((parseFloat(val_pajak) + 100) / 100);
        }
        else{
          nilaiPajak = (parseFloat(val_pajak) / 100) * hargaPerRow;
          if (isNaN(nilaiPajak)){
            nilaiPajak = 0;
          }
          totalPajak += nilaiPajak;
          grandTotal += totalPajak;

        }

        if (nilaiPajak != 0){
          element = document.getElementById(`pajak_${title}_${type}_${type_pajak.split(" ").join("_").replace(/[%.]/gi, "")}_${value_type}`);
          if (element == null) {
            pajak[type_pajak] = nilaiPajak;
            var np = pajak[type_pajak].toString().split(".");
            if(np.length > 1) {
              if (np[1].toString().length > 2) {
                np[1] = np[1].toString().substring(0, 2);
                pajak[type_pajak] = parseFloat(np.join("."));
              }
            }
            var nilaiFPajak = 0
            if (preferensi['format_opsi_desimal'] == 0) { nilaiFPajak = Math.floor(pajak[type_pajak]); }
            else{ nilaiFPajak = pajak[type_pajak]; }
            $(`#bottom_table_${title}_${type}_${value_type}`).prepend(`
              <div class="alert alert-success mb-5 p-5 ml-5 mt-5 ${title}-pajak-box_${type}_${value_type}" role="alert" id="pajak_${title}_${type}_${type_pajak.split(" ").join("_").replace(/[%.]/gi, "")}_${value_type}">
                <strong>${type_pajak}</strong>
                <div class="border-bottom border-white opacity-20 mb-5"></div>
                <h4 class="alert-heading">Rp. <span class="float-right ml-2" id="pajak_${title}_${type}_${value_type}_val_${type_pajak.split(" ").join("_").replace(/[%.]/gi, "")}">${nilaiFPajak.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span></h4>
              </div>
            `);
          }
          else {
            pajak[type_pajak] += nilaiPajak;
            var np = pajak[type_pajak].toString().split(".");
            if(np.length > 1) {
              if (np[1].toString().length > 2) {
                np[1] = np[1].toString().substring(0, 2);
                pajak[type_pajak] = parseFloat(np.join("."));
              }
            }
            var nilaiFPajak = 0;
            if (preferensi['format_opsi_desimal'] == 0) { nilaiFPajak = Math.floor(pajak[type_pajak]); }
            else{ nilaiFPajak = pajak[type_pajak]; }
            $(`#pajak_${title}_${type}_${value_type}_val_${type_pajak.split(" ").join("_").replace(/[%.]/gi, "")}`).html(nilaiFPajak.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
          }
        }
      }
      if (preferensi['format_opsi_desimal'] == 0) { grandTotal = Math.floor(grandTotal); }
      $(`#grand_total_${title}_${type}_${value_type}`).html(grandTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));


    });
  }

  this.jurnalOtomatis = function (data, label, modal) {
    var params = {
      url: 'accounting/jurnal/otomatis',
      data: {
        'id': data,
        'transaksi': label
      },
      modal: `#${modal}`,
      status: 'modalShow'
    }
    // console.log(params);
    this.ajaxGroup(params);
  }

  this.show_log_activity = function (transaksi, id, modal, url) {
    var params = {
      url: url,
      data: {
        'transaksi': transaksi,
        'id': id
      },
      modal: `#${modal}`,
      status: 'modalShow'
    }
    this.ajaxGroup(params);
  }

  this.redirectToModule = function (mode, id, nomor) {


    if (mode == 'hargajasa') {
      add_page('master_data_harga_jasa', 'master-data/harga-jasa', 'Harga Jasa');
      add_content_tab('master_data_harga_jasa', `edit_data_${id}`, `master-data/harga-jasa/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'penawaran_penjualan') {
      add_page('penjualan_penawaran_penjualan', 'penjualan/penawaran-penjualan', 'Penawaran Penjualan');
      add_content_tab('penjualan_penawaran_penjualan', `edit_data_${id}`, `penjualan/penawaran-penjualan/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'pesanan_penjualan') {
      add_page('penjualan_pesanan_penjualan', 'penjualan/pesanan-penjualan', 'Pesanan Penjualan')
      add_content_tab('penjualan_pesanan_penjualan', `edit_data_${id}`, `penjualan/pesanan-penjualan/edit/${id}`, 'Edit Data', `${nomor}`);
    }
    else if (mode == 'pengiriman_pesanan') {
      add_page('penjualan_pengiriman_pesanan', 'penjualan/pengiriman-pesanan', 'Pengiriman Pesanan');
      add_content_tab('penjualan_pengiriman_pesanan', `edit_data_${id}`, `penjualan/pengiriman-pesanan/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'faktur_penjualan') {
      add_page('penjualan_faktur_penjualan', 'penjualan/faktur-penjualan', 'Faktur Penjualan');
      add_content_tab('penjualan_faktur_penjualan', `edit_data_${id}`, `penjualan/faktur-penjualan/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'penerimaan_penjualan') {
      add_page('penjualan_penerimaan_penjualan', 'penjualan/penerimaan-penjualan', 'Penerimaan Penjualan');
      add_content_tab('penjualan_penerimaan_penjualan', `edit_data_${id}`, `penjualan/penerimaan-penjualan/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'retur_penjualan') {
      add_page('penjualan_retur_penjualan', 'penjualan/retur-penjualan', 'Retur Penjualan');
      add_content_tab('penjualan_retur_penjualan', `edit_data_${id}`, `penjualan/retur-penjualan/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'permintaan_pembelian') {
      add_page('pembelian_permintaan_pembelian', 'pembelian/permintaan-pembelian', 'Permintaan Pembelian');
      add_content_tab('pembelian_permintaan_pembelian', `edit_data_${id}`, `pembelian/permintaan-pembelian/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'pesanan_pembelian') {
      add_page('pembelian_pesanan_pembelian', 'pembelian/pesanan-pembelian', 'Pesanan Pembelian');
      add_content_tab('pembelian_pesanan_pembelian', `edit_data_${id}`, `pembelian/pesanan-pembelian/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'pengiriman_pembelian') {
      add_page('pembelian_pengiriman_pembelian', 'pembelian/pengiriman-pembelian', 'Pengiriman Pembelian');
      add_content_tab('pembelian_pengiriman_pembelian', `edit_data_${id}`, `pembelian/pengiriman-pembelian/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'faktur_pembelian') {
      add_page('pembelian_faktur_pembelian', 'pembelian/faktur-pembelian', 'Faktur Pembelian');
      add_content_tab('pembelian_faktur_pembelian', `edit_data_${id}`, `pembelian/faktur-pembelian/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'pembayaran_pembelian') {
      add_page('pembelian_pembayaran_pembelian', 'pembelian/pembayaran-pembelian', 'Pembayaran Pembelian');
      add_content_tab('pembelian_pembayaran_pembelian', `edit_data_${id}`, `pembelian/pembayaran-pembelian/edit/${id}`, 'Edit Data', `${nomor}`)
    }
    else if (mode == 'retur_pembelian') {
      add_page('pembelian_retur_pembelian', 'pembelian/retur-pembelian', 'Retur Pembelian');
      add_content_tab('pembelian_retur_pembelian', `edit_data_${id}`, `pembelian/retur-pembelian/edit/${id}`, 'Edit Data', `${nomor}`)
    }
  }

  this.addrowDetailPengirimanSubTable = function (mode, table, data) {
    let dataOpt = '';
    $.each(data, function (indexInArray, valueOfElement) {
      dataOpt += `<option value="${valueOfElement['id']}">${valueOfElement['keterangan']}</option>`;
    });

    let dataSelect = '';
    if (mode == 'barang') {
      dataSelect = `<select class="form-control selectpicker barangSel" data-size="7" data-live-search="true" title="Pilih ${mode}" data-toggle="ajax" data-container="body">${dataOpt}</select>`;

      $(`#${table}`).DataTable().row.add([
        null,
        null,
        dataSelect,
        //`<select class="form-control selectpicker barangSel" data-size="7" data-live-search="true" title="Pilih" data-toggle="ajax" data-container="body"></select>`,
        `<input type="number" class="form-control" value="0">`,
        `<input type="number" class="form-control" value="0">`,
        `<input type="number" class="form-control" value="0">`,
        `<input type="text" class="form-control">`,
        `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="deleteBarang">
        <i class="fas fa-trash text-danger"></i>
      </a>`
      ]).draw();
      // $('.barangSel').html('');
      // $.each(data, function (indexInArray, valueOfElement) {
      //   $('.barangSel').append(`<option value="${valueOfElement['id']}">${valueOfElement['keterangan']}</option>`)
      // });
      $('.barangSel').selectpicker();
    } else {
      dataSelect = `<select class="form-control selectpicker transSelect" data-size="7" data-live-search="true" title="Pilih ${mode}" data-toggle="ajax" data-container="body">${dataOpt}</select>`;

      $(`#${table}`).DataTable().row.add([
        null,
        null,
        dataSelect,
        //`<select class="form-control selectpicker transSelect " data-size="7" data-live-search="true" title="Pilih" data-toggle="ajax" data-container="body"></select>`,
        `<input type="text" class="form-control" readonly value="">`,
        `<input type="text" class="form-control" >`,
        `<input type="text" class="form-control" >`,
        `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="deleteTrans">
        <i class="fas fa-trash text-danger"></i>
      </a>`
      ]).draw();

      $('.transSelect').selectpicker();
    }

  }

  this.getTipePengiriman = function (index, value, idTable) {
    let array = [];
    array.push(index)
    // console.log(idTable);
    // console.log('ini value nya' + value);
    if (value != '') {
      var params = {
        status: 'getTipePengiriman',
        url: `master-data/alat-transportasi/getType/${value}`,
        index: array[0],
        table: idTable
      }
      this.ajaxGroup(params);
    }
  }

  this.moduleStoreData = function (idButton, validation, KTUtil, url, form, tabelIndex, mainTab, mode) {
    var params = {
      idButton: idButton,
      validation: validation,
      KTUtil: KTUtil,
      url: url,
      form: form,
      tabelIndex: tabelIndex,
      mainTab: mainTab,
      mode: mode,
      status: 'ModuleStore'
    }
    this.ajaxGroup(params);
  }

  this.BarangJasaStore = function (url, form, mainTab, mode, table) {
    var params = {
      url: url,
      form: form,
      mainTab: mainTab,
      table: table,
      mode: mode,
      status: 'barangJasa'
    }
    this.ajaxGroup(params);
  }

  this.dateFilterDatatable = function (table, begin, end, tableContent, url, columnSetting) {
    var tanggal_awal = $(begin).val();
    var tanggal_akhir = $(end).val();

    if (tanggal_awal != '' && tanggal_akhir != '') {
      tableContent.content.url = url;
      tableContent.status = 'filterTanggal';
      tableContent.parameter = {
        'tanggal_awal': tanggal_awal,
        'tanggal_akhir': tanggal_akhir
      };
      tableContent.columnSetting = columnSetting;
      this.ajaxGroup(tableContent);
    } else {
      notice('Paramater Tanggal Belum Lengkap', 'warning');
    }
  }

  this.resetFilterDataTable = function (table, params, url, begin, end) {
    $(begin).val('');
    $(end).val('');
    $(`${table}`).DataTable().destroy();
    params.content.url = url;
    params.status = 'indexAjaxList';
    params.desc = 'reset';
    this.ajaxGroup(params);
  }

  this.return_transaction = function (vendors, url, table, vendors, subType, mode, type, elementHeaderRetur) {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var params = {
      url: url,
      data: {
        'table': table,
        'valVendors': $(vendors).val(),
        'subType': subType,
        'vendorElement': vendors,
        'mode': mode,
        'type': type,
        'elementHeaderRetur': elementHeaderRetur
      },
      modal: '#modalhargaJasaList',
      status: 'returList_'
    }
    this.ajaxGroup(params);

    // if ($(vendors).val() != '') {


    // } else {
    //   notice('Data Pemasok / Pelanggan Belum Dipilih !!!', 'warning');
    // }
  }


  this.element = {
    'table': {
      'jadwalPengiriman': '',
      'barangJasa': '',
      'uangMuka': '',
      'index': ''
    },
    'jadwalPengirimanAdd': {
      'addButton': '',
      'showModalButton': '',
      'tableDataJadwalPengiriman': '',
      'modal': '',
      'modalButtonAdd': '',
      'SaveToArray': '',
      'urlJadwalPengiriman': '',
      'tableDataSelect': '',
      'inisiasi': '',
      'data': ''
    },
    'addBarangJasa': {
      'addButton': '',
      'params1': '',
      'params2': '',
      'params3': '',
      'params4': '',
      'mode': '',
      'additional': ''
    },
    'RowaddBarangJasa': {
      'addButton': '',
      'type': '',
      'subType': '',
      'hargajasaList': '',
      'table': '',
      'kodePajakElement': '',
      'additional': ''
    },
    'deleteRowJadwal': {
      'idButton': '',
    },
    'deleteRowBarangJasa': {
      'table': '',
      'idButton': '',
    },
    'previousTransaction': {
      'idButton': '',
      'url': '',
      'idPemasok': '',
      'idGudangEle': '',
      'valVendors': ''
    },
    'addDataRelations': {
      'idButton': '',
      'idSyaratPengiriman': '',
      'url': '',
      'listElementSyaratPengiriman': '',
      'mainTab': '',
      'kodePajak': '',
      'type1': '',
      'type2': '',
      'type3': '',
      'type4': '',
      'type5': '',
      'syaratPengirimanListValue': '',
      'gudang': ''
    },
    'store': {
      'idButton': '',
      'validation': '',
      'KTUtil': '',
      'url': '',
      'form': '',
      'tabelIndex': '',
      'mainTab': '',
      'mode': '',
    },
    'downPayment': {
      'idButton': '',
      'url': '',
      'form': '',
      'tabelIndex': '',
      'mainTab': '',
      'mode': '',
      'subUrl': '',
      'title': ''
    },
    'nomorSeri': {
      'idButton': '',
      'url': '',
      'dataAdditional': '',
      'type': ''
    },
    'barangForShip': {
      'idButton': '',
      'url': '',
      'dataAdditional': '',
      'tanggal' : '',
      'nomor' : ''
    },
    'syaratPengiriman': {
      'idSelect': '',
      'listElement': '',
      'addButton': '',
      'modalButton': ''
    },
    'storeSN': {
      'idButton': '',
      'formData': '',
      'hargaJasaId': ''
    },
    'interactive': {
      'idPrice': '',
      'idQty': '',
      'mode': '',
      'module': '',
      'type': '',
      'denganPajak': '',
      'kenaPajak': '',
      'kodePajakElement': ''
    },
    'interactiveDownPayment': {
      'idNominal': '',
      'sisa': '',
      'type': '',
      'buttonDelete': ''
    },
    'uangMukaFaktur': {
      'idButton': '',
      'url': ''
    },
    'rowAdduangMukaFaktur': {
      'idButton': '',
      'tableData': ''
    },
    'printTransaksi': {
      'idButton': '',
      'KTUtil': '',
      'mode': '',
      'type': ''
    },
    'barangTable': {
      'table': '',
      'deleteButton': ''
    },
    'transportasiTable': {
      'table': '',
      'deleteButton': ''
    },
    'moduleStore': {
      'idButton': '',
      'validation': '',
      'KTUtil': '',
      'url': '',
      'form': '',
      'tabelIndex': '',
      'mainTab': '',
      'mode': '',
    },
    'dateFilter': {
      'begin': '',
      'end': '',
      'search': '',
      'reset': '',
      'url': '',
      'datatableParams': '',
      'columnSetting': ''
    },
    'dropdownEvent': {
      'class': '',
      'docs': '',
      'subClass': '',
      'childClass': ''
    },
    'returList': {
      'idButton': '',
      'url': '',
      'mode': '',
      'type': '',
      'header': ''
    },
    'rowaddreturn': {
      'tabelValue': '',
      'addButton': '',
      'table': '',
      'vendors': '',
      'kodePajakElement': '',
      'atributeVendors': '',
      'mode': '',
      'type': '',
      'elementHeader': ''
    },
  }


  this.bindDOMEvent = function () {

    if (_this.element.rowaddreturn.addButton != '') {
      $(_this.element.rowaddreturn.addButton).on('click', function (e) {
        //console.log(_this.element.rowaddreturn);
        _this.rowadd_return(_this.element.rowaddreturn.tabelValue, _this.element.rowaddreturn.table, _this.element.rowaddreturn.vendors, _this.element.RowaddBarangJasa.subType, _this.element.rowaddreturn.kodePajakElement, _this.element.rowaddreturn.atributeVendors, _this.element.rowaddreturn.mode, _this.element.rowaddreturn.type, _this.element.rowaddreturn.elementHeader);
      })
    }


    if (_this.element.returList.url != '') {
      $(_this.element.returList.idButton).on('click', function (e) {
        _this.return_transaction(_this.element.returList.idButton, _this.element.returList.url, _this.element.table.barangJasa, _this.element.previousTransaction.idPemasok, _this.element.addBarangJasa.params3, _this.element.returList.mode, _this.element.returList.type, _this.element.returList.header);
      })
    }


    if (_this.element.dropdownEvent.class != '') {
      $(_this.element.dropdownEvent.class).on('click', function (e) {
        $(this).next().toggle("fast");
      })
    }

    if (_this.element.dropdownEvent.docs != '') {
      $(_this.element.dropdownEvent.docs).on('click', function (event) {
        var $trigger = $(_this.element.dropdownEvent.subClass);
        if ($trigger !== event.target && !$trigger.has(event.target).length) {
          $(_this.element.dropdownEvent.childClass).slideUp("fast");
        }
      })
    }


    // Range Filter Tanggal
    if (_this.element.dateFilter.search != '') {
      $(_this.element.dateFilter.search).on('click', function () {
        _this.dateFilterDatatable(_this.element.table.index, _this.element.dateFilter.begin, _this.element.dateFilter.end, _this.element.dateFilter.datatableParams, _this.element.dateFilter.url, _this.element.dateFilter.columnSetting);
      })
    }

    // Reset Filter Tanggal
    if (_this.element.dateFilter.reset.id_button != '') {
      $(_this.element.dateFilter.reset.id_button).on('click', function () {
        _this.resetFilterDataTable(_this.element.table.index, _this.element.dateFilter.reset.params, _this.element.dateFilter.reset.url, _this.element.dateFilter.begin, _this.element.dateFilter.end);
      })
    }

    // Store Data Module
    if (_this.element.moduleStore.idButton != '') {
      $(_this.element.moduleStore.idButton).on('click', function () {
        _this.moduleStoreData(_this.element.moduleStore.idButton, _this.element.moduleStore.validation, _this.element.moduleStore.KTUtil, _this.element.moduleStore.url, _this.element.moduleStore.form, _this.element.moduleStore.tabelIndex, _this.element.moduleStore.mainTab, _this.element.moduleStore.mode);
      })
    }
    // Add Jadwal Pengiriman
    if (_this.element.jadwalPengirimanAdd.addButton != '') {
      $(_this.element.jadwalPengirimanAdd.addButton).on('click', function (e) {
        e.preventDefault();
        var thisEle = $(this).closest('tr');
        _this.show_jadwal_JadwalPengiriman(thisEle, _this.element.table.jadwalPengiriman, _this.element.jadwalPengirimanAdd.modal);
      })
    }

    // Delete Table Barang detail pengiriman
    if (_this.element.barangTable.deleteButton != '') {
      $(_this.element.barangTable.table).on("click", _this.element.barangTable.deleteButton, function () {
        $(_this.element.barangTable.table).DataTable().row($(this).parents('tr')).remove().draw(false);
      });
    }

    // Delete Table Transportasi detail pengiriman
    if (_this.element.transportasiTable.deleteButton != '') {
      $(_this.element.transportasiTable.table).on("click", _this.element.transportasiTable.deleteButton, function () {
        $(_this.element.transportasiTable.table).DataTable().row($(this).parents('tr')).remove().draw(false);
      });
    }

    if (_this.element.jadwalPengirimanAdd.showModalButton != '') {
      $(_this.element.table.barangJasa).on("click", `td ${_this.element.jadwalPengirimanAdd.showModalButton}`, function () {
        var thisEle = $(this).closest('tr');
        _this.showModalJadwal(thisEle, _this.element.table.barangJasa);
      });
    }

    if (_this.element.jadwalPengirimanAdd.SaveToArray != '') {
      $(_this.element.jadwalPengirimanAdd.SaveToArray).on('click', function () {
        _this.saveToArrayJadwalPengiriman(_this.element.table.jadwalPengiriman, _this.element.table.index, _this.element.jadwalPengirimanAdd.data, _this.element.table.barangJasa);
      })
    }

    // Show Modal Jadwal Pengiriman
    if (_this.element.jadwalPengirimanAdd.modalButtonAdd != '') {
      $(_this.element.jadwalPengirimanAdd.modalButtonAdd).on('click', function (e) {
        e.preventDefault();
        _this.rowAddTableJadwalPengiriman(_this.element.jadwalPengirimanAdd.tableDataSelect, _this.element.jadwalPengirimanAdd.table, _this.element.jadwalPengirimanAdd.modal);
      })
    }

    //  Show Syarat Pengiriman 
    if (_this.element.syaratPengiriman.addButton != '') {
      $(_this.element.table.barangJasa).on('click', `td ${_this.element.syaratPengiriman.addButton}`, function () {
        var thisEle = $(this).closest('tr');
        _this.showModalSyaratPengiriman(thisEle, _this.element.table.barangJasa);
      })
    }

    if (_this.element.syaratPengiriman.modalButton != '') {
      $(_this.element.table.barangJasa).on('click', `td ${_this.element.syaratPengiriman.modalButton}`, function () {
        _this.addDataSyaratPengiriman(_this.element.table.index);
      })
    }

    // Show Modal Barang Jasa
    if (_this.element.addBarangJasa.addButton != '') {
      $(_this.element.addBarangJasa.addButton).on('click', function (e) {
        e.preventDefault();
      //  console.log(_this.element.table.barangJasa);
        _this.showAddBarangJasa(_this.element.table.barangJasa, _this.element.addBarangJasa.params2, _this.element.addBarangJasa.params3, _this.element.addBarangJasa.mode, _this.element.previousTransaction.idPemasok, _this.element.addBarangJasa.params4, _this.element.addBarangJasa.additional);
      })
    }

    // Add Barang Jasa
    if (_this.element.RowaddBarangJasa.addButton != '') {
      $(_this.element.RowaddBarangJasa.addButton).on('click', function (e) {
        e.preventDefault();
        _this.rowAddBarangJasaList(_this.element.RowaddBarangJasa.hargajasaList, _this.element.RowaddBarangJasa.table, _this.element.RowaddBarangJasa.type, _this.element.RowaddBarangJasa.kodePajakElement, _this.element.RowaddBarangJasa.subType, _this.element.addBarangJasa.mode, _this.element.previousTransaction.valVendors, _this.element.addBarangJasa.params4, _this.element.RowaddBarangJasa.additional);
      })
    }

    // Delete Jadwal Pengiriman Row Table
    if (_this.element.deleteRowJadwal.idButton != '') {
      $(_this.element.table.jadwalPengiriman).on("click", _this.element.deleteRowJadwal.idButton, function () {
        $(_this.element.table.jadwalPengiriman).DataTable().row($(this).parents('tr')).remove().draw(false);
      });
    }

    // Delete Barang jasa Row Table
    if (_this.element.deleteRowBarangJasa.idButton != '') {
      // console.log(_this.element.deleteRowBarangJasa.idButton);
      $(_this.element.table.barangJasa).on("click", _this.element.deleteRowBarangJasa.idButton, function (event) {
        event.preventDefault();
        $(_this.element.table.barangJasa).DataTable().row($(this).parents('tr')).remove().draw(false);
      });
    }

    // Store Data
    if (_this.element.store.idButton != '') {
      $(_this.element.store.idButton).on('click', function () {
        var validation = _this.element.store.validation;
        validation.validate().then(function (status) {
          if (status == 'Valid') {
            _this.store(_this.element.store.KTUtil, _this.element.store.url, _this.element.store.form, _this.element.store.tabelIndex, _this.element.store.mainTab, _this.element.store.mode);
          }
        });
      })
    }

    // Show Modal Previous Transaction
    $(_this.element.previousTransaction.idButton).on('click', function () {
      _this.choiceHeader(_this.element.previousTransaction.url, _this.element.previousTransaction.idPemasok, _this.element.table.jadwalPengiriman, _this.element.table.barangJasa, _this.element.interactive.kenaPajak, _this.element.interactive.denganPajak, _this.element.interactive.type, _this.element.interactive.mode, null, _this.element.interactive.module, _this.element.syaratPengiriman.listElement, _this.element.previousTransaction.idGudangEle);
    })

    // Row Add Previous Transaction
    if (_this.element.addDataRelations.idButton != '') {
      $(_this.element.addDataRelations.idButton).on('click', function () {
        _this.addDataRelations(_this.element.table.jadwalPengiriman, _this.element.addDataRelations.idSyaratPengiriman, _this.element.table.barangJasa, _this.element.addDataRelations.url, _this.element.addDataRelations.listElementSyaratPengiriman, _this.element.addDataRelations.mainTab, _this.element.addDataRelations.kodePajak, _this.element.addDataRelations.type1, _this.element.addDataRelations.type2, _this.element.addDataRelations.type3, _this.element.addDataRelations.type4, _this.element.interactive.kenaPajak, _this.element.interactive.denganPajak, _this.element.addDataRelations.syaratPengirimanListValue, _this.element.syaratPengiriman.listElement, _this.element.interactive.mode, _this.element.interactive.type, _this.element.interactive.module, _this.element.previousTransaction.idGudangEle, _this.element.addDataRelations.gudang, _this.element.previousTransaction.valVendors, _this.element.addDataRelations.type5);
      })
    }

    // Add Down Payment
    $(_this.element.downPayment.idButton).on('click', function (e) {
      e.preventDefault();
      _this.downPayment(_this.element.downPayment.url, _this.element.downPayment.form, _this.element.downPayment.tabelIndex, _this.element.downPayment.mainTab, _this.element.downPayment.mode, _this.element.downPayment.subUrl, _this.element.downPayment.title);
    })

    // Print Page Transaksi

    if (_this.element.printTransaksi.idButton != '') {
      $(_this.element.printTransaksi.idButton).on('click', function () {
        var validation = _this.element.store.validation;
        validation.validate().then(function (status) {
          if (status == 'Valid') {
            _this.printTransaction(_this.element.printTransaksi.KTUtil, _this.element.store.url, _this.element.store.form, _this.element.store.tabelIndex, _this.element.store.mainTab, _this.element.store.mode, _this.element.printTransaksi.mode, _this.element.printTransaksi.type);
          }
        });
      })
    }

    // Add SeriaL Number
    $(`${_this.element.table.barangJasa} tbody`).on('click', `td ${_this.element.nomorSeri.idButton}`, function (e) {
      e.preventDefault();

      var thisElement = $(this).closest('tr');
      if (_this.element.nomorSeri.type == 'pembelian') {
        _this.addSerialNumber(thisElement, _this.element.nomorSeri.url, _this.element.nomorSeri.dataAdditional);
      }

      if (_this.element.nomorSeri.type == 'penjualan') {
        _this.addSerialNumberPenjualan(thisElement, _this.element.nomorSeri.url, _this.element.nomorSeri.dataAdditional);
      }

    })

    // Add Barang
    if (_this.element.barangForShip.idButton != '') {
      $(`${_this.element.table.barangJasa} tbody`).on('click', `td ${_this.element.barangForShip.idButton}`, function () {
        var thisElement = $(this).closest('tr');
        // _this.addModalBarang(thisElement, _this.element.barangForShip.url, _this.element.barangForShip.dataAdditional, _this.element.previousTransaction.idPemasok, _this.element.store.mainTab,_this.element.barangForShip.tanggal,_this.element.barangForShip.nomor);
        _this.addModalBarang(thisElement, _this.element.barangForShip.url, detailExpedisi[modulAct], _this.element.previousTransaction.idPemasok, _this.element.store.mainTab,_this.element.barangForShip.tanggal,_this.element.barangForShip.nomor);
      })
    }
    // Store SN
    // $(_this.element.storeSN.idButton).on('click', function () {
    //     var data = $(_this.element.storeSN.formData).serializeArray();
    //   console.log(data);
    //   console.log(_this.element.storeSN.hargaJasaId);
    //   _this.addSN(data,_this.element.storeSN.hargaJasaId);
    // })

    if (_this.element.interactive.idQty != '') {
      // console.log(_this.element.interactive.idQty);
      $(`${_this.element.table.barangJasa} tbody`).on('keyup', `td ${_this.element.interactive.idQty}`, function () {
        // console.log('asdsad')
        _this.setting_column_all(_this.element.table.barangJasa, _this.element.interactive.mode, _this.element.interactive.type, 10, 9, 11, _this.element.interactive.module);
        var thisElement = $(this).closest('tr');
        _this.totalHarga(thisElement);
      })
    }

    // Keys

    if (_this.element.interactive.idPrice != '') {
      // console.log(_this.element.interactive.idPrice);
      $(`${_this.element.table.barangJasa} tbody`).on('keyup', `td ${_this.element.interactive.idPrice}`, function () {
        // console.log('asdsad')
        _this.setting_column_all(_this.element.table.barangJasa, _this.element.interactive.mode, _this.element.interactive.type, 10, 9, 11, _this.element.interactive.module);
        var thisElement = $(this).closest('tr');
        _this.totalHarga(thisElement);
      })
    }

    if (_this.element.interactiveDownPayment.idNominal) {
      $(`${_this.element.table.uangMuka} tbody`).on('keyup', `td ${_this.element.interactiveDownPayment.idNominal}`, function () {
        var thisElement = $(this).closest('tr');
        _this.totalHargaUangMuka(thisElement, _this.element.interactiveDownPayment.type);
      })
    }

    if (_this.element.interactive.idPrice != '') {
      $(`${_this.element.table.barangJasa} tbody`).on('change', `td ${_this.element.interactive.kodePajakElement}`, function () {

        _this.setting_column_all(_this.element.table.barangJasa, _this.element.interactive.mode, _this.element.interactive.type, 10, 9, 11, _this.element.interactive.module);
      })
    }

    if (_this.element.interactive.mode != '') {
      $(_this.element.interactive.kenaPajak).on('change', function () {
        // console.log('keyup kena pajak')
        _this.setting_column_all(_this.element.table.barangJasa, _this.element.interactive.mode, _this.element.interactive.type, 10, 9, 11, _this.element.interactive.module);
      })
    }

    if (_this.element.interactive.mode != '') {
      $(_this.element.interactive.denganPajak).on('change', function () {
        _this.setting_column_all(_this.element.table.barangJasa, _this.element.interactive.mode, _this.element.interactive.type, 10, 9, 11, _this.element.interactive.module);
      })
    }



    if (_this.element.uangMukaFaktur.idButton != '') {
      $(_this.element.uangMukaFaktur.idButton).on('click', function () {
        _this.uangMukaFaktur(_this.element.table.uangMuka, _this.element.uangMukaFaktur.url, _this.element.previousTransaction.idPemasok);
      })
    }

    if (_this.element.rowAdduangMukaFaktur.idButton != '') {
      $(_this.element.rowAdduangMukaFaktur.idButton).on('click', function () {
        _this.rowAddUangMukaFaktur(_this.element.rowAdduangMukaFaktur.tableData, _this.element.table.uangMuka);
      })
    }

    if (_this.element.interactive.mode != '') {
      _this.setting_column_all(_this.element.table.barangJasa, _this.element.interactive.mode, _this.element.interactive.type, 10, 9, 11, _this.element.interactive.module);
    }

    if (_this.element.interactiveDownPayment.buttonDelete != '') {
      $(_this.element.table.uangMuka).on('click', _this.element.interactiveDownPayment.buttonDelete, function (event) {
        event.preventDefault();
        $(_this.element.table.uangMuka).DataTable().row($(this).parents('tr')).remove().draw(false);
      })
    }

  }

  this.ajaxGroup = function (params) {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "GET",
      url: host + '/auth/check',
      success: function (res) {
        let filter = JSON.parse(res);
        if (filter.status_code != 500) {

          if (params.status == 'modalShow') {
            $.ajax({
              type: "POST",
              timeout: 50000,
              url: host + '/' + params.url,
              async: true,
              data: params.data,
              success: function (res) {
                $(`${params.modal} .modal-dialog`).html('');
                $(`${params.modal} .modal-dialog`).html(res);
                $(`${params.modal}`).modal('show');
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
          else if (params.status == 'previousTransactions') {

            $.ajax({
              type: "POST",
              timeout: 50000,
              url: host + '/' + params.url,
              async: true,
              data: {
                id_detail: data['id']
              },
              success: function (res) {
                var snD = null;
                var produkServis = '';
                var paket = '';
                var asal = '';
                var tujuan = '';
                var harga_pembelian;
                var x;
                var number = 1;
                var cellAction = '';
                var totalHarga = 0;
                var keyJadwal = [];
                var columnShippingStok = [];
                var valSelectedSp = [];
                var rowHargaValue = 0;
                var jadwalPengirimanRow;
                var checkDataHargaJasa = $(params.var['hargaJasaTable']).DataTable().rows().data().toArray();
                $(params.var['tblJadwal']).DataTable().clear().draw();
                // console.log(res.data);
                $(params.var['syaratPengirimanElement']).empty();
                $(params.var['syaratPengirimanListElement']).empty();
                dataJadwalArray.length = 0;
                var dataSyaratGroup = [];
                var tampsSyarat = [];
                var SubdetailPengiriman = [];
                var detail_pengiriman = [];
                var headDP1 = [];
                var headDP2 = [];
                var headDP3 = [];
                var headDP4 = [];
                var headDP5 = [];
                var headDP6 = [];
                var headDP7 = [];
                var headDP8 = [];
                var headDP9 = [];
                var headDP10 = [];
                var nomorPengirimanDt = [];
                var tanda_kemasanDt = [];
                var nomor_segelDt = [];
                var paketDt = [];
                var asal_textDt = [];
                var tujuan_textDt = [];
                var asal_valueDt = [];
                var tujuan_valueDt = [];
                var pembayarDt = [];
                var penerimaDt = [];
                // field jenis barang
                var jb_jenisBarangid = [];
                var jb_jml_barang = [];
                var jb_keterangan = [];
                var jb_beratBersih = [];
                var jb_beratKotor = [];
                // 
                // tabel jenis barang
                var tableJb_jenisBarang = [];
                var tableJb_jmlBarang = [];
                var tableJb_keterangan = [];
                var tableJb_beratBersih = [];
                var tableJb_beratKotor = [];
                // 
                // field trans
                var trans_alat_transportasi_id = [];
                var trans_keterangan = [];
                var trans_kurir = [];
                var trans_tipe_pengiriman = [];
                // 
                // table trans
                var tableTrans_alatTransportasiId = [];
                var tableTrans_keterangan = [];
                var tableTrans_kurir = [];
                var tableTrans_tipePengiriman = [];
                // 
                // result detail pengiriman
                var resultJenisBarang = [];
                var resultTransportasi = [];
                let stokTerpakai = [];
                $.each(res.data, function (key, value) {

                  // console.log('ini sub data : ' + params.var['typeSubData']);

                  if (value['detail_pengiriman'] != undefined) {
                    if (value['detail_pengiriman']['length'] != 0) {
                      for (let x = 0; x < value['detail_pengiriman']['length']; x++) {
                        SubdetailPengiriman[key] = value['detail_pengiriman'];
                      }
                      headDP1 = [];
                      headDP2 = [];
                      headDP3 = [];
                      headDP4 = [];
                      headDP5 = [];
                      headDP6 = [];
                      headDP7 = [];
                      headDP8 = [];
                      headDP9 = [];
                      headDP10 = [];
                      // destroy array tb jenisBarang
                      tableJb_jenisBarang = [];
                      tableJb_jmlBarang = [];
                      tableJb_keterangan = [];
                      tableJb_beratBersih = [];
                      tableJb_beratKotor = [];
                      // 

                      // destory array tb trans
                      tableTrans_alatTransportasiId = [];
                      tableTrans_keterangan = [];
                      tableTrans_kurir = [];
                      tableTrans_tipePengiriman = [];
                      // 

                      for (let b = 0; b < SubdetailPengiriman[key]['length']; b++) {
                        // console.log(SubdetailPengiriman[key][b]['asal_barang']['id']);
                        headDP1[b] = SubdetailPengiriman[key][b]['nomor'];
                        headDP2[b] = SubdetailPengiriman[key][b]['tanda_kemasan'];
                        headDP3[b] = SubdetailPengiriman[key][b]['nomor_segel'];
                        headDP4[b] = SubdetailPengiriman[key][b]['paket'];
                        SubdetailPengiriman[key][b]['asal_barang'] != null ? headDP5[b] = SubdetailPengiriman[key][b]['asal_barang']['id'] : headDP5[b] = null;
                        SubdetailPengiriman[key][b]['tujuan_barang'] != null ? headDP6[b] = SubdetailPengiriman[key][b]['tujuan_barang']['id'] : headDP6[b] = null;
                        SubdetailPengiriman[key][b]['asal_barang'] != null ? headDP7[b] = SubdetailPengiriman[key][b]['asal_barang']['provinsi'] + ' ' + SubdetailPengiriman[key][b]['asal_barang']['kabupaten'] + ' ' + SubdetailPengiriman[key][b]['asal_barang']['kecamatan'] + ' ' + SubdetailPengiriman[key][b]['asal_barang']['kelurahan'] + ' ' + SubdetailPengiriman[key][b]['asal_barang']['kodepos'] : headDP7[b] = null;
                        SubdetailPengiriman[key][b]['tujuan_barang'] != null ? headDP8[b] = SubdetailPengiriman[key][b]['tujuan_barang']['provinsi'] + ' ' + SubdetailPengiriman[key][b]['tujuan_barang']['kabupaten'] + ' ' + SubdetailPengiriman[key][b]['tujuan_barang']['kecamatan'] + ' ' + SubdetailPengiriman[key][b]['tujuan_barang']['kelurahan'] + ' ' + SubdetailPengiriman[key][b]['tujuan_barang']['kodepos'] : headDP8[b] = null;
                        headDP9[b] = SubdetailPengiriman[key][b]['pembayar'];
                        headDP10[b] = SubdetailPengiriman[key][b]['penerima'];
                        // destroy Array jenis barang
                        jb_jenisBarangid = [];
                        jb_jml_barang = [];
                        jb_keterangan = [];
                        jb_beratBersih = [];
                        jb_beratKotor = [];
                        // 
                        // destoy array trans
                        trans_alat_transportasi_id = [];
                        trans_keterangan = [];
                        trans_kurir = [];
                        trans_tipe_pengiriman = [];
                        // 

                        // Loop Detail jenis barang
                        for (let hh = 0; hh < SubdetailPengiriman[key][b]['detail_jenis_barang']['length']; hh++) {
                          jb_jenisBarangid[hh] = SubdetailPengiriman[key][b]['detail_jenis_barang'][hh]['jenis_barang_id'];
                          jb_jml_barang[hh] = SubdetailPengiriman[key][b]['detail_jenis_barang'][hh]['jumlah_barang'];
                          jb_keterangan[hh] = SubdetailPengiriman[key][b]['detail_jenis_barang'][hh]['keterangan'];
                          jb_beratBersih[hh] = SubdetailPengiriman[key][b]['detail_jenis_barang'][hh]['berat_bersih'];
                          jb_beratKotor[hh] = SubdetailPengiriman[key][b]['detail_jenis_barang'][hh]['berat_kotor'];
                          // jb_jenisBarangid[hh] = 0;
                        }
                        // 
                        // Loop detail alat transportasi
                        for (let xx = 0; xx < SubdetailPengiriman[key][b]['detail_alat_transportasi']['length']; xx++) {
                          trans_alat_transportasi_id[xx] = SubdetailPengiriman[key][b]['detail_alat_transportasi'][xx]['alat_transportasi_id'];
                          trans_keterangan[xx] = SubdetailPengiriman[key][b]['detail_alat_transportasi'][xx]['keterangan'];
                          trans_kurir[xx] = SubdetailPengiriman[key][b]['detail_alat_transportasi'][xx]['kurir'];
                          trans_tipe_pengiriman[xx] = SubdetailPengiriman[key][b]['detail_alat_transportasi'][xx]['alat_transportasi']['tipe_pengiriman']['keterangan'];
                        }
                        // 
                        // Array Push Jenis Barang
                        tableJb_jenisBarang[b] = jb_jenisBarangid;
                        tableJb_jmlBarang[b] = jb_jml_barang;
                        tableJb_keterangan[b] = jb_keterangan;
                        tableJb_beratBersih[b] = jb_beratBersih;
                        tableJb_beratKotor[b] = jb_beratKotor;
                        // 
                        // Array Push Alat Transportasi
                        tableTrans_alatTransportasiId[b] = trans_alat_transportasi_id;
                        tableTrans_keterangan[b] = trans_keterangan;
                        tableTrans_kurir[b] = trans_kurir;
                        tableTrans_tipePengiriman[b] = trans_tipe_pengiriman;
                      }

                      // console.log(tableJb_jenisBarang);

                      nomorPengirimanDt[key] = headDP1;
                      tanda_kemasanDt[key] = headDP2;
                      nomor_segelDt[key] = headDP3;
                      paketDt[key] = headDP4;
                      asal_valueDt[key] = headDP5;
                      tujuan_valueDt[key] = headDP6;
                      asal_textDt[key] = headDP7;
                      tujuan_textDt[key] = headDP8;
                      pembayarDt[key] = headDP9;
                      penerimaDt[key] = headDP10;

                      resultJenisBarang[key] = {
                        'id': tableJb_jenisBarang,
                        'jumlah_barang': tableJb_jmlBarang,
                        'keterangan': tableJb_keterangan,
                        'berat_bersih': tableJb_beratBersih,
                        'berat_kotor': tableJb_beratKotor
                      }

                      resultTransportasi[key] = {
                        'id': tableTrans_alatTransportasiId,
                        'keterangan': tableTrans_keterangan,
                        'kurir': tableTrans_kurir,
                        'tipe_pengiriman': tableTrans_tipePengiriman,
                      }

                      // console.log(resultJenisBarang);


                      //  console.log(mainJb_jenisBarangId);
                      // nomorPengiriman['nomor'] = tamps[key];
                      // tanda_kemasanDt['tanda_kemasan'] = tamps2[key];
                      // nomor_segelDt['nomor_segel'] = tamps3[key];
                      // paketDt['paket'] = tamps4[key];

                      // $.each(, function (cs, lu) { 
                      //    console.log(lu)
                      // });


                      detail_pengiriman[value['harga_jasa_id']['id']] = {
                        'nomor': nomorPengirimanDt[key],
                        'tanda_kemasan': tanda_kemasanDt[key],
                        'nomor_segel': nomor_segelDt[key],
                        'paket': paketDt[key],
                        'jenis_barang': resultJenisBarang[key],
                        'alat_transportasi': resultTransportasi[key],
                        'asal_barang': asal_valueDt[key],
                        'tujuan_barang': tujuan_valueDt[key],
                        'asal_text': asal_textDt[key],
                        'tujuan_text': tujuan_textDt[key],
                        'pembayar': pembayarDt[key],
                        'penerima': penerimaDt[key],
                      }

                    }
                  }

                  if (value['jadwal_pengiriman_id'] != null) {
                    dataJadwalArray.push({
                      0: null,
                      1: null,
                      2: null,
                      3: null,
                      4: null,
                      5: null,
                      6: value['jadwal_pengiriman_id']['id'],
                      7: value['jadwal_pengiriman_id']['nomor'],
                      8: value['jadwal_pengiriman_id']['alat_transportasi']['keterangan'],
                      9: value['jadwal_pengiriman_id']['asal']['provinsi'] + ',' + value['jadwal_pengiriman_id']['asal']['kabupaten'] + ',' + value['jadwal_pengiriman_id']['asal']['kecamatan'] + ',' + value['jadwal_pengiriman_id']['asal']['kelurahan'] + ',' + value['jadwal_pengiriman_id']['asal']['kodepos'],
                      10: value['jadwal_pengiriman_id']['tujuan']['provinsi'] + ',' + value['jadwal_pengiriman_id']['tujuan']['kabupaten'] + ',' + value['jadwal_pengiriman_id']['tujuan']['kecamatan'] + ',' + value['jadwal_pengiriman_id']['tujuan']['kelurahan'] + ',' + value['jadwal_pengiriman_id']['tujuan']['kodepos'],
                      11: "<a href=javascript:; class=btn btn-sm btn-clean btn-icon title=Delete id=deleteJadwalPengiriman><span class=svg-icon svg-icon-md><i class=flaticon2-trash text-danger></i></span></a>",
                      12: value['jadwal_pengiriman_id']['voyage_flight_trip'],
                      13: value['jadwal_pengiriman_id']['tanggal_pembukaan'],
                      14: value['jadwal_pengiriman_id']['tanggal_penutupan'],
                      15: value['jadwal_pengiriman_id']['eta_asal'],
                      16: value['jadwal_pengiriman_id']['etd_asal'],
                      17: value['jadwal_pengiriman_id']['eta_tujuan'],
                    });
                  } else {
                    dataJadwalArray.push(null);
                  }

                  if (value['syarat_pengiriman']['length'] > 0) {
                    var inner = [];
                    $.each(value['syarat_pengiriman'], function (indexes, resX) {
                      inner[indexes] = resX['syarat_pengiriman_id'];
                    });
                    tampsSyarat[key] = inner;
                  }

                  if (tampsSyarat[key] != undefined) {
                    syaratPengirimanRow = tampsSyarat[key];
                  } else {
                    syaratPengirimanRow = null;
                  }

                  if (dataJadwalArray[key] != undefined) {
                    jadwalPengirimanRow = dataJadwalArray[key];
                  } else {
                    jadwalPengirimanRow = null;
                  }


                  if (value['harga'] != null || value['harga'] != undefined) {
                    totalHarga = value['harga'] * value['kuantitas'];
                  }

                  if (value['harga_jasa_id']['produk_servis_id'] != null) {
                    produkServis = value['harga_jasa_id']['produk_servis_id']['keterangan'];
                  }

                  if (value['harga_jasa_id']['paket_id'] != null) {
                    paket = value['harga_jasa_id']['paket_id']['keterangan'];
                  }

                  if (value['harga_jasa_id']['asal_id'] != null) {
                    asal = normalizeLokasi(value['harga_jasa_id']['asal_id']);
                        //value['harga_jasa_id']['asal_id']['provinsi'] + ' , ' + value['harga_jasa_id']['asal_id']['kabupaten'] + ' , ' + value['harga_jasa_id']['asal_id']['kecamatan'] + ' , ' + value['harga_jasa_id']['asal_id']['kelurahan'] + ', ' + value['harga_jasa_id']['asal_id']['kodepos']
                  }

                  if (value['harga_jasa_id']['tujuan_id'] != null) {
                    tujuan = normalizeLokasi(value['harga_jasa_id']['tujuan_id']);
                        //value['harga_jasa_id']['tujuan_id']['provinsi'] + ' , ' + value['harga_jasa_id']['tujuan_id']['kabupaten'] + ' , ' + value['harga_jasa_id']['tujuan_id']['kecamatan'] + ' , ' + value['harga_jasa_id']['tujuan_id']['kelurahan'] + ', ' + value['harga_jasa_id']['tujuan_id']['kodepos']
                  }

                  var btnSyarat = getBtn('syarat');
                      //`<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Syarat" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a>`;
                  var btnJadwal = getBtn('jadwal');
                      //`<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Jadwal" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> `;
                  var btnDelete = getBtn('delete')
                      //`<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete"><i class="fas fa-trash text-danger"></i></a>`;
                  var btnDetailBarang = getBtn('expedisi');
                      //`<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"> <i class="flaticon2-plus mr-n1"></i></a>`;
                  var btnSn = getBtn('sn');
                      //`<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a>`;
                  var arrConc = [];

                  // if (value['harga_jasa_id']['tipe'] == 1 && params.var['typeSubData'] == 'generalPembelian') {
                  //   cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                  //   <i class="fas fa-trash text-danger"></i>
                  // </a>`;
                  //   $('body .formGudang').css('display', 'block');
                  //   $('body .formGudang').attr('data-id', 'gudangValidate')
                  // }
                  // if (value['harga_jasa_id']['tipe'] == 1 && value['harga_jasa_id']['menggunakan_nomor_seri'] == 1 && params.var['typeSubData'] == 'general') {
                  //   cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                  //     <i class="fas fa-trash text-danger"></i>
                  //   </a>`;
                  //   $('body .formGudang').css('display', 'block');
                  //   $('body .formGudang').attr('data-id', 'gudangValidate');
                  // }
                  // if (value['harga_jasa_id']['tipe'] == 1 && params.var['typeSubData'] == 'detailPengiriman') {
                  //   if (value['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
                  //     cellAction = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                  //       <i class="fas fa-trash text-danger"></i>
                  //     </a>`;
                  //     $('body .formGudang').css('display', 'block');
                  //     $('body .formGudang').attr('data-id', 'gudangValidate')
                  //   } else {
                  //     cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                  //       <i class="fas fa-trash text-danger"></i>
                  //     </a>`;
                  //   }
                  // }
                  // if (value['harga_jasa_id']['tipe'] == 1 && params.var['typeSubData'] == 'nomorSeri') {
                  //   if (value['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
                  //     cellAction = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                  //     <i class="fas fa-trash text-danger"></i>
                  //   </a>`;
                  //   } else {
                  //     cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal">
                  //                     <i class="far fa-calendar text-primary"></i>
                  //                  </a>
                  //                 <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                  //                   <i class="fas fa-trash text-danger"></i>
                  //                 </a>`;
                  //   }
                  //
                  //   $('body .formGudang').css('display', 'block');
                  //   $('body .formGudang').attr('data-id', 'gudangValidate')
                  // }
                  // if (value['harga_jasa_id']['tipe'] == 1) {
                  //   if (value['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
                  //     cellAction = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                  //     <i class="fas fa-trash text-danger"></i>
                  //   </a>`;
                  //   } else {
                  //     cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                  //     <i class="fas fa-trash text-danger"></i>
                  //   </a>`;
                  //   }
                  //   $('body .formGudang').css('display', 'block');
                  //   $('body .formGudang').attr('data-id', 'gudangValidate')
                  // }
                  if (value['harga_jasa_id']['tipe'] == 1){
                      $('body .formGudang').css('display', 'block');
                      $('body .formGudang').attr('data-id', 'gudangValidate')
                    cellAction = btnJadwal + btnDelete;
                    console.log(params.var['typeSubData']);
                    if(value['harga_jasa_id']['menggunakan_nomor_seri'] == 1){
                      if(params.var['typeSubData'] == 'nomorSeri' || params.var['typeSubData'] == 'generalPembelian' || params.var['typeSubData'] == 'barang' || params.var['typeSubData'] == 'detailPengiriman'){
                        cellAction = btnSn + btnJadwal + btnDelete;
                      }
                    }
                  }
                  else if (value['harga_jasa_id']['tipe'] == 3){
                    if (params.var['typeSubData'] == 'general'){
                      cellAction = btnSyarat + btnJadwal + btnDelete;
                    }
                    else if(params.var['typeSubData'] == 'detailPengiriman' || params.var['typeSubData'] == 'nomorSeri' || params.var['typeSubData'] == 'generalPembelian' || params.var['typeSubData'] == 'barang' ){
                      cellAction = btnDetailBarang + btnSyarat + btnJadwal + btnDelete;

                    }
                    else{
                      //console.log('type sub data yang lain?');
                    }

                  }

                  if (params.var['typeData'] == 'nonShipping') {

                    if (value['header_pajak'] != undefined) {

                      if (value['header_pajak']['kena_pajak'] == 1) {
                        if (params.var['kenaPajak'] != '') {
                          $(params.var['kenaPajak']).prop("checked", true);
                        }
                      }

                      if (value['header_pajak']['termasuk_pajak'] == 1) {
                        if (params.var['denganPajak'] != '') {
                          $(params.var['denganPajak']).prop("checked", true);
                        }
                      }

                    }

                    if (params.var['typeTransaksi'] == 'transaksi_awal') {
                      if (params.var['urlDetail'].slice(0, 9) == 'pembelian') {
                        if (value['harga_jasa_id']['informasi_pembelian'] != null) {
                          $.each(value['harga_jasa_id']['informasi_pembelian'], function (keys, values) {
                            if (values.pemasok_id == params.var['valVendors']) {
                              rowHargaValue = values.harga_pembelian;
                            }
                          });
                        }
                      } else {
                        if (value['harga_jasa_id']['informasi_penjualan'] != null) {
                          $.each(value['harga_jasa_id']['informasi_penjualan'], function (keys, values) {
                            if (values.pelanggan_id == params.var['valVendors']) {
                              rowHargaValue = values.harga_penjualan;
                            }
                          });
                        }
                      }
                    }
                    else {
                      if (value['harga'] != null || value['harga'] != undefined) {
                        rowHargaValue = value['harga'];
                      } else {
                        rowHargaValue = 0;
                      }

                    }

                    if (params.var['elementOptional'] == 'faktur_penjualan') {
                      console.log(value);
                      console.log('faktur Penjualan')

                      let penawaran_penjualan = '';
                      let pesanan_penjualan = '';
                      let pengiriman_penjualan = '';
                      let row_second = '';


                      if (value.penawaran_penjualan_detail != null) {
                        penawaran_penjualan = `<a href="#" onclick="showModule('penawaran_penjualan','${value.penawaran_penjualan_detail['header']['id']}','${value.penawaran_penjualan_detail['header']['nomor']}')"><u>${value.penawaran_penjualan_detail['header']['nomor']}</u></a>`;
                      } else {
                        penawaran_penjualan = '-';
                      }

                      if (value.pesanan_penjualan_header != null) {
                        pesanan_penjualan = `<a href="#" onclick="showModule('pesanan_penjualan','${value.pesanan_penjualan_header['id']}','${value.pesanan_penjualan_header['nomor']}')"><u>${value.pesanan_penjualan_header['nomor']}</u></a>`;
                      } else {
                        pesanan_penjualan = '-';
                      }

                      if (value.pengiriman_penjualan_header != null) {
                        pengiriman_penjualan = `<a href="#" onclick="showModule('pengiriman_pesanan','${value.pengiriman_penjualan_header['id']}','${value.pengiriman_penjualan_header['nomor']}')"><u>${value.pengiriman_penjualan_header['nomor']}</u></a>`;
                      } else {
                        pengiriman_penjualan = '-';
                      }

                      var tempAr = [];
                      if (value['harga_jasa_id']['stok_tersedia']['length'] > 0) {
                        $.each(value['harga_jasa_id']['stok_tersedia'], function (indexInArray, valueOfElement) {
                          columnShippingStok.push(valueOfElement.nomor_seri);
                        });
                      } else {
                        columnShippingStok = [];
                      }

                      if (value['detail_sn']['length'] > 0) {
                        $.each(value['detail_sn'], function (t, v) {
                          //
                          columnShippingStok.push(v.nomor_seri);
                          tempAr.push({name : t, value : v.nomor_seri});
                        });
                        stokTerpakai[key] = tempAr;
                        //columnShippingStok = tempAr;
                      }

                      if (value['harga_jasa_id']['tipe'] == 1) {
                        if (stokTerpakai[key] != undefined) {
                          row_second = stokTerpakai[key];
                        } else {
                          row_second = null;
                        }
                      } else {
                        row_second = syaratPengirimanRow;
                      }

                      console.log(row_second);
                      console.log(columnShippingStok);

                      $(params.var['hargaJasaTable']).DataTable().row.add([
                        value['harga_jasa_id']['tipe'],
                        row_second,
                        syaratPengirimanRow,
                        jadwalPengirimanRow,
                        columnShippingStok,
                        `<input type="number" value="` + value['id_detail'] + `" readonly/>`,
                        `<input type="number" value="` + value['harga_jasa_id']['id'] + `" readonly/>`,
                        value['harga_jasa_id']['kode'],
                        value['harga_jasa_id']['keterangan'],
                        `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="${value['kuantitas']}"/>`,
                        `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious kodePajakElePrevious${key}" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
                        `<input type="text" id="priceElement" class="form-control hargaElement" value="${rowHargaValue}"/>`,
                        `<span id="totalharga_">${totalHarga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span>`,
                        cellAction,
                        produkServis,
                        paket,
                        asal,
                        tujuan,
                        `${penawaran_penjualan}`,
                        `${pesanan_penjualan}`,
                        `${pengiriman_penjualan}`
                      ]).draw();
                    }
                    else if (params.var['elementOptional'] == 'faktur_pembelian') {

                      let permintaan_pembelian = '';
                      let pesanan_pembelian = '';
                      let pengiriman_pembelian = '';
                      if (value.permintaan_pembelian_detail != null) {
                        permintaan_pembelian = `<a href="#" onclick="showModule('permintaan_pembelian','${value.permintaan_pembelian_detail['header']['id']}','${value.permintaan_pembelian_detail['header']['nomor']}')"><u>${value.permintaan_pembelian_detail['header']['nomor']}</u></a>`;
                      }

                      if (value.pesanan_pembelian_header != null) {
                        pesanan_pembelian = `<a href="#" onclick="showModule('pesanan_pembelian','${value.pesanan_pembelian_header['id']}','${value.pesanan_pembelian_header['nomor']}')"><u>${value.pesanan_pembelian_header['nomor']}</u></a>`;
                      }

                      if (value.pengiriman_pembelian_header_id != null) {
                        pengiriman_pembelian = `<a href="#" onclick="showModule('pengiriman_pembelian','${value.pengiriman_pembelian_header_id['id']}','${value.pengiriman_pembelian_header_id['nomor']}')"><u>${value.pengiriman_pembelian_header_id['nomor']}</u></a>`;
                        snD = value.detail_sn.map(nSeri);
                        function nSeri(e) {
                          return e.nomor_seri;
                        }
                      }

                      $(params.var['hargaJasaTable']).DataTable().row.add([
                        value['harga_jasa_id']['tipe'],
                        snD,
                        syaratPengirimanRow,
                        jadwalPengirimanRow,
                        null,
                        `<input type="number" value="` + value['id_detail'] + `" readonly/>`,
                        `<input type="number" value="` + value['harga_jasa_id']['id'] + `" readonly/>`,
                        value['harga_jasa_id']['kode'],
                        value['harga_jasa_id']['keterangan'],
                        `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="${value['kuantitas']}"/>`,
                        `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious kodePajakElePrevious${key}" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
                        `<input type="text" id="priceElement" class="form-control hargaElement" value="${rowHargaValue}"/>`,
                        `<span id="totalharga_">${totalHarga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span>`,
                        cellAction,
                        produkServis,
                        paket,
                        asal,
                        tujuan,
                        `${permintaan_pembelian}`,
                        `${pesanan_pembelian}`,
                        `${pengiriman_pembelian}`
                      ]).draw();
                    }
                    else if (params.var['elementOptional'] == 'pengiriman_pembelian') {

                      $(params.var['hargaJasaTable']).DataTable().row.add([
                        value['harga_jasa_id']['tipe'],
                        null,
                        syaratPengirimanRow,
                        jadwalPengirimanRow,
                        null,
                        `<input type="number" value="` + value['id_detail'] + `" readonly/>`,
                        `<input type="number" value="` + value['harga_jasa_id']['id'] + `" readonly/>`,
                        value['harga_jasa_id']['kode'],
                        value['harga_jasa_id']['keterangan'],
                        `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="${value['kuantitas']}"/>`,
                        `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious kodePajakElePrevious${key}" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
                        `<input type="text" id="priceElement" class="form-control hargaElement" value="${rowHargaValue}"/>`,
                        `<span id="totalharga_">${totalHarga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span>`,
                        cellAction,
                        produkServis,
                        paket,
                        asal,
                        tujuan,
                        `-`,
                        `-`
                      ]).draw();
                    }
                    else {
                      //console.log(cellAction);
                      $(params.var['hargaJasaTable']).DataTable().row.add([
                        value['harga_jasa_id']['tipe'],
                        null,
                        syaratPengirimanRow,
                        jadwalPengirimanRow,
                        null,
                        `<input type="number" value="` + value['id_detail'] + `" readonly/>`,
                        `<input type="number" value="` + value['harga_jasa_id']['id'] + `" readonly/>`,
                        value['harga_jasa_id']['kode'],
                        value['harga_jasa_id']['keterangan'],
                        `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="${value['kuantitas']}"/>`,
                        `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious kodePajakElePrevious${key}" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
                        `<input type="text" id="priceElement" class="form-control hargaElement" value="${rowHargaValue}"/>`,
                        `<span id="totalharga_">${totalHarga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span>`,
                        cellAction,
                        produkServis,
                        paket,
                        asal,
                        tujuan
                      ]).draw();

                    }

                    $.each(params.var['kodePajakElement'], function (indexInArray, valueOfElement) {
                      $('.selectpickerPrevious').append(`<option value="${valueOfElement['id']}" nilai="${valueOfElement['nilai']}">${valueOfElement['nama']}</option>`)
                    });

                    if (value['detail_pajak'] != null) {
                      if (value['detail_pajak']['kode_pajak_id'] != null) {
                        $(`.kodePajakElePrevious${key}`).selectpicker('val', value['detail_pajak']['kode_pajak_id']['id']);
                        $(`.kodePajakElePrevious${key}`).selectpicker('refresh');
                      }
                    }

                    number++;

                    _this.setting_column_all(params.var['hargaJasaTable'], params.var['mode'], params.var['type'], 10, 9, 11, params.var['modules']);

                    price_format_class('hargaElement')
                    $('.selectpickerPrevious').selectpicker();
                  }
                  else if (params.var['typeData'] == 'shippingStok') {

                    let penawaran_penjualan = '';
                    let pesanan_penjualan = '';

                    if (value.penawaran_penjualan_detail != null) {
                      penawaran_penjualan = `<a href="#" onclick="showModule('penawaran_penjualan','${value.penawaran_penjualan_detail['header']['id']}','${value.penawaran_penjualan_detail['header']['nomor']}')"><u>${value.penawaran_penjualan_detail['header']['nomor']}</u></a>`;
                    } else {
                      penawaran_penjualan = '-';
                    }

                    if (value.pesanan_penjualan_header != null) {
                      pesanan_penjualan = `<a href="#" onclick="showModule('pesanan_penjualan','${value.pesanan_penjualan_header['id']}','${value.pesanan_penjualan_header['nomor']}')"><u>${value.pesanan_penjualan_header['nomor']}</u></a>`;
                    } else {
                      pesanan_penjualan = '-';
                    }


                    if (value['harga_jasa_id']['stok_tersedia']['length'] > 0) {
                      $.each(value['harga_jasa_id']['stok_tersedia'], function (indexInArray, valueOfElement) {
                        columnShippingStok.push(valueOfElement.nomor_seri);
                      });
                    } else {
                      columnShippingStok = null;
                    }

                    $(params.var['hargaJasaTable']).DataTable().row.add([
                      value['harga_jasa_id']['tipe'],
                      null,
                      syaratPengirimanRow,
                      jadwalPengirimanRow,
                      columnShippingStok,
                      `<input type="number" value="` + value['id_detail'] + `" readonly/>`,
                      `<input type="number" value="` + value['harga_jasa']['id'] + `" readonly/>`,
                      value['harga_jasa_id']['kode'],
                      value['harga_jasa_id']['keterangan'],
                      `<input type="number" class="form-control kuantitas_pembelian" value="` + value['kuantitas'] + `"/>`,
                      cellAction,
                      produkServis,
                      paket,
                      asal,
                      tujuan,
                      penawaran_penjualan,
                      pesanan_penjualan
                    ]).draw();
                    columnShippingStok = [];
                  }
                  else {

                    let permintaan_pembelian = '';
                    let pesanan_pembelian = '';

                    if (value.permintaan_pembelian_detail != null) {
                      permintaan_pembelian = `<a href="#" onclick="showModule('permintaan_pembelian','${value.permintaan_pembelian_detail['header']['id']}','${value.permintaan_pembelian_detail['header']['nomor']}')"><u>${value.permintaan_pembelian_detail['header']['nomor']}</u></a>`;
                    } else {
                      permintaan_pembelian = '-';
                    }

                    if (value.pesanan_pembelian_header != null) {
                      pesanan_pembelian = `<a href="#" onclick="showModule('pesanan_pembelian','${value.pesanan_pembelian_header['id']}','${value.pesanan_pembelian_header['nomor']}')"><u>${value.pesanan_pembelian_header['nomor']}</u></a>`;
                    } else {
                      pesanan_pembelian = '-';
                    }

                    console.log(value);
                    $(params.var['hargaJasaTable']).DataTable().row.add([
                      value['harga_jasa_id']['tipe'],
                      null,
                      syaratPengirimanRow,
                      jadwalPengirimanRow,
                      columnShippingStok,
                      `<input type="number" value="` + value['id_detail'] + `" readonly/>`,
                      `<input type="number" value="` + value['harga_jasa_id']['id'] + `" readonly/>`,
                      value['harga_jasa_id']['kode'],
                      value['harga_jasa_id']['keterangan'],
                      `<input type="number" class="form-control kuantitas_pembelian" value="` + value['kuantitas'] + `"/>`,
                      cellAction,
                      produkServis,
                      paket,
                      asal,
                      tujuan,
                      permintaan_pembelian,
                      pesanan_pembelian
                    ]).draw();

                  }

                })

                detail_pengiriman.forEach(myFunction);
                function myFunction(item, index) {
                  if (item != undefined){
                      detailExpedisi[modulAct]['b-'+index]=item;
                  }
                }

                // detailExpedisi[g_transaksi].push(detail_pengiriman);
                //console.log(detailExpedisi[g_transaksi]);
                // _this.tampungBarang(detail_pengiriman);

                if (params.var['downPayment'] == 'useDP') {

                  $.each(res.data[0]['faktur_uang_muka'], function (indexInArray, valueOfElement) {
                    $(params.var['tblUangMuka']).DataTable().row.add([
                      null,
                      null,
                      null,
                      null,
                      null,
                      `<input type="hidden" value="` + valueOfElement.sisa_uang_muka + `">`,
                      `<input type="text" value="${valueOfElement.faktur_pembelian_header_id}">`,
                      valueOfElement.nomor,
                      `Uang Muka`,
                      valueOfElement.tanggal,
                      `<span>${valueOfElement.uang_muka.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span>`,
                      `<input type="text" value="` + valueOfElement.sisa_uang_muka + `" class="form-control  harga_nominal form-control-solid" id="sisaUangMuka">`,
                      `<input type="text" name="nominal_uang_muka" id="nominalUangMuka" class="form-control harga_nominal" value="0"/>`,
                      `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="deleteUangMuka">
                            <span class="svg-icon svg-icon-md">
                                <i class="flaticon2-trash text-danger"></i>
                            </span>
                          </a>`
                    ]).draw();
                    price_format_class('harga_nominal');
                  });

                }

                // Syarat Pengiriman Area

                // End

                if (res.data[0]['gudang_id'] != null) {
                  $(params.var['gudangElement']).selectpicker('val', res.data[0]['gudang_id']);
                  $(params.var['gudangElement']).selectpicker('refresh');
                }

                $('.selectpicker').selectpicker();
                $('#previousTransaksi').modal('hide');
              },
              error: function (res, textstatus) {
                if (textstatus === "timeout") {
                  notice('Response Time Out', 'error');
                } else {
                  notice(res.responseJSON.message, 'error');
                }
                time += 500;
              }
            });

          }
          else if (params.status == 'showPiutang') {
            $.ajax({
              type: "POST",
              async: true,
              timeout: 50000,
              url: host + '/' + params.url,
              data: params.data,
              success: function (res) {
                var jadwalP = '';
                if (res.recordsTotal > 0) {
                  $(`#${params.var['table']}`).DataTable().clear().draw();
                  $.each(res.data, function (key, value) {
                    if (value.jadwal_pengiriman != null) {
                      jadwalP = value.jadwal_pengiriman['nomor']
                    }
                    var nominal = "penerimaan_" + value.faktur_penjualan_header_id['id'];
                    $(`#${params.var['table']}`).DataTable().row.add([
                      null,
                      null,
                      null,
                      null,
                      null,
                      null,
                      `<input type="number" value="${value.faktur_penjualan_header_id['id']}">`,
                      `<a href="#" onclick="showModule('faktur_penjualan','${value.faktur_penjualan_header_id['id']}','${value.faktur_penjualan_header_id['nomor']}')"><u>${value.faktur_penjualan_header_id['nomor']}</u></a>`,
                      `<input type="text" class="form-control harga" id="${nominal}" value="0" placeholder="0" onkeyup="getTotalPembayaran()"/>`,
                      `<input type="text" class="form-control" value="${value.sisa_piutang}">`,
                      value.nominal_faktur_penjualan,
                      value.nominal_faktur_penjualan_uang_muka,
                    ]).draw();
                    price_format(nominal);
                    faktur[value.faktur_penjualan_header_id['id']] = value.nominal_faktur_penjualan;
                    uang_muka[value.faktur_penjualan_header_id['id']] = value.nominal_faktur_penjualan_uang_muka;
                    sisa_piutang_awal[value.faktur_penjualan_header_id['id']] = value.sisa_piutang;
                  })
                  price_format_class('harga');
                  notice('Data Faktur Di Tambahkan', 'success');
                } else {
                  notice('Tidak Ada Data!', 'warning');
                  $(`#${table}`).DataTable().clear().draw();
                }
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
          else if (params.status == 'showHutang') {
            $.ajax({
              type: "POST",
              async: true,
              timeout: 50000,
              url: host + '/' + params.url,
              data: params.data,
              success: function (res) {
                var indexs = 0;
                var jadwalP = '';
                if (res.recordsTotal > 0) {
                  $(`#${params.var['table']}`).DataTable().clear().draw();
                  $.each(res.data, function (key, value) {
                    if (value.faktur_pembelian_header_id['jadwal_pengiriman_id'] != null) {
                      jadwalP = value.faktur_pembelian_header_id['jadwal_pengiriman_id']['nomor'];
                    }
                    nominal = "nominal" + value.faktur_pembelian_header_id;
                    $(`#${params.var['table']}`).DataTable().row.add([
                      null,
                      null,
                      null,
                      null,
                      null,
                      null,
                      `<input type="number" value="` + value.faktur_pembelian_header_id + `">`,
                      `<a href="#" onclick="showModule('faktur_pembelian','${value.faktur_pembelian_header_id}','${value.nomor}')"><u>${value.nomor}</u></a>`,
                      `<input type="text" class="form-control nominal nominal_bayar${indexs}" id="${nominal}" value="0" placeholder="0" min="1" onkeyup="getTotalPembayaran();"/>`,
                      `<input type="text" class="form-control nominal" readonly value="${value.sisa_hutang}">`,
                      value.nominal_faktur_pembelian,
                      value.nominal_faktur_pembelian_uang_muka
                    ]).draw();
                    indexs++;
                    price_format_class('nominal');
                    faktur[value.faktur_pembelian_header_id] = value.nominal_faktur_pembelian;
                    uang_muka[value.faktur_pembelian_header_id] = value.nominal_faktur_pembelian_uang_muka;
                    sisa_utang_awal[value.faktur_pembelian_header_id] = value.sisa_hutang;
                    pembayaran_awal[value.faktur_pembelian_header_id] = value.nominal_pembayaran_pembelian;

                  })
                  notice('Data Faktur Di Tambahkan', 'success');
                } else {
                  notice('Tidak Ada Data!', 'warning');
                  $(`#${table}`).DataTable().clear().draw();
                }

              },
              error: function () {

              }
            });

          }
          else if (params.status == 'ModuleStore') {

            $.ajax({
              type: "POST",
              timeout: 50000,
              url: host + '/' + params.url,
              data: $(`${params.form}`).serialize(),
              success: function (res) {
                //console.log(res);
                KTUtil.btnRelease(params.KTUtil);
                Swal.fire('Berhasil!', res, 'success')
                close_content_tab(`${params.mainTab}`, `${params.mode}`);
                reload_table(`${params.tabelIndex}`);
              },
              error: function (res, textstatus) {
                KTUtil.btnRelease(params.KTUtil);
                if (textstatus === "timeout") {
                  notice('Response Time Out.', 'error');
                } else {
                  notice(res.responseJSON.message, 'error');
                }
              }
            });
          }
          else if (params.status == 'barangJasa') {
            $.ajax({
              type: "POST",
              async: true,
              timeout: 50000,
              url: host + '/' + params.url,
              data: new FormData($(`${params.form}`)[0]),
              contentType: false,
              cache: false,
              processData: false,
              success: function (res) {
                var data = JSON.parse(res);
                if (data.status !== false) {
                  close_content_tab(`${params.mainTab}`, `${params.mode}`);
                  Swal.fire('Berhasil!', `${data.message}`, 'success');
                  reload_table(`${params.table}`);
                } else {
                  notice(`${data.message}`, 'warning');
                }
              }
            });
          }
          else if (params.status == 'indexAjaxList') {

            if (params.desc == undefined) {
              $(`#${params.content.table} thead tr`).clone(false).appendTo(`#${params.content.table} thead`);
              $(`#${params.content.table} thead tr:eq(1) th`).each(function (i) {
                var title = $(this).text();
                if (title == 'ID') {
                  $(this).html('');
                } else if (title == 'Actions') {
                  $(this).html('');
                } else {
                  $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
                }

                // $('input', this).on('keypress', function (e) {
                //   if (e.which == 13) {
                //
                //     tabelIndex
                //       .column(i)
                //       .search(this.value)
                //       .draw();
                //   }
                // });

                $('input', this).on('keyup', function (e) {
                  //if (e.which == 13) {
                    tabelIndex
                        .column(i)
                        .search(this.value)
                        .draw();
                  //}
                });
              });
            } else {
              $(`#${params.content.table} thead tr:eq(1) th`).empty();
              $(`#${params.content.table} thead tr:eq(1) th`).each(function (i) {
                var title = $(this).text();
                if (title == 'ID') {
                  $(this).html('');
                } else if (title == 'Actions') {
                  $(this).html('');
                } else {
                  $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
                }

                // $('input', this).on('keypress', function (e) {
                //   if (e.which == 13) {
                //     tabelIndex
                //       .column(i)
                //       .search(this.value)
                //       .draw();
                //   }
                // });

                $('input', this).on('keyup', function (e) {
                  // if (e.which == 13) {
                    tabelIndex
                        .column(i)
                        .search(this.value)
                        .draw();
                  // }
                });

              });
            }


            var buttonCommon = {
              exportOptions: {
                        columns: getExportOptions(),
                         modifier: { 
                           order: 'index',
                           page : 'all',
                           search: 'applied',
                          },
                          stripHtml:true,

              }
          };
            function getExportOptions(){
	              return [function ( idx, data, node ) {
                    if($(node).text() === 'Actions' || $(node).hasClass('col-dt-hidden'))
                      { return false; }
                      return true;
                    }
	              ];
            }
            var tabelIndex = $(`#${params.content.table}`).DataTable({
              orderCellsTop: true,
              fixedHeader: true,
              "deferRender": true,
              dom: "Btplir",
              buttons: [
                  $.extend( true, {}, buttonCommon, {
                    extend: 'excelHtml5',
                    SelectedOnly: true,
                    customize: function(xlsx){
                      var table = xlsx.xl.worksheets['sheet1.xml'];
                      var kolom=['A','B','C','D','E','F','G','H','I','J'];
                      var j = 3;
                      for (var i = 0; i < tabelIndex.columns().count(); i++){
                        if( $(tabelIndex.column(i).header()).text() == 'Tanggal' || $(tabelIndex.column(i).header()).text() == 'Tanggal Jurnal' || $(tabelIndex.column(i).header()).text() == 'Tanggal Pembayaran'){
                          var test1 = $(tabelIndex.column(i).data()).toArray();
                          test1.forEach(test);
                          function test(item) {
                            var sementara = item.substr(90,101);
                            $(`c[r^= ${kolom[i]}${j}] t`, table).text(sementara);
                            j++;

                          }
                        }
                      }                     
                    }
                  }
                 ),

                $.extend( true, {}, buttonCommon, {
                  extend: 'pdfHtml5',
                  orientation:'landscape',
                  pageSize: 'LEGAL',
                  
              } ),
                
                // 'excelHtml5',
                // 'pdfHtml5'
              ],
              
              rowId: 'id',
              pageLength: 20,
              processing: true,
              serverSide: true,
              ajax: {
                url: host + '/' + params.content.url,
                async: true,
                error: function (res) {
                  $('.dataTables_processing').hide();
                  notice(res.responseJSON.message, 'error');
                }
              },
              deferRender: true,
              select: !1,
              colReorder: !0,
              sorting: [
                [1, "asc"]
              ],
              pagingType: "full_numbers",
              stateSave: !1,
              language: {
                "zeroRecords": "Data tidak ditemukan...",
                "processing": '<span class="text-danger">Mengambil Data....</span>'
              },
              lengthMenu: [
                [20, 50, 100, 200,-1],
                [20, 50, 100, 200,'All']
              ],
              columns: params.content.columns,
              headerCallback: function (thead, data, start, end, display) {
                thead.getElementsByTagName('th')[0].innerHTML = `
                            <label class="checkbox checkbox-single">
                                    <input type="checkbox" value="" class="group-checkable"/>
                                    <span></span>
                            </label>`;
              },
              columnDefs: params.content.columnDefs
            });

            // tabelIndex.on('page.dt', function () {
            //   console.log('Saat Pindah Page');
            //   console.log(tabelIndex.page.info());
            // });
            tabelIndex.on('change', '.group-checkable', function () {
              var set = $(this).closest('table').find('td:first-child .checkable');
              var checked = $(this).is(':checked');

              $(set).each(function () {
                if (checked) {
                  $(this).prop('checked', true);
                  $(this).closest('tr').addClass('active');
                } else {
                  $(this).prop('checked', false);
                  $(this).closest('tr').removeClass('active');
                }
              });
            });

            tabelIndex.on('change', 'tbody tr .checkbox', function () {
              $(this).parents('tr').toggleClass('active');
            });

            return tabelIndex;

          }
          else if (params.status == 'filterTanggal') {
            $(`#${params.content.table}`).DataTable().destroy();

            $(`#${params.content.table} thead tr:eq(1) th`).empty();
            $(`#${params.content.table} thead tr:eq(1) th`).each(function (i) {

              var title = $(this).text();
              if (title == 'ID') {
                $(this).html('');
              } else if (title == 'Actions') {
                $(this).html('');
              } else {
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
              }

              // $('input', this).on('keypress', function (e) {
              //   if (e.which == 13) {
              //     tabelIndex
              //       .column(i)
              //       .search(this.value)
              //       .draw();
              //   }
              // });

              $('input', this).on('keyup', function (e) {
                // if (e.which == 13) {
                  tabelIndex
                      .column(i)
                      .search(this.value)
                      .draw();
                // }
              });

            });
            var buttonCommon = {
              exportOptions: {
                columns: getExportOptions(),
                 modifier: {
                   order: 'index',
                   page : 'all',
                   search: 'applied',
                 },
                  stripHtml:true,
              }
          };
          function getExportOptions(){
            return [function ( idx, data, node )
                {
              if($(node).text() === 'Actions' || $(node).hasClass('col-dt-hidden'))
                {
              return false;
                  }
                return true;
              }
              ];
          }
            var tabelIndex = $(`#${params.content.table}`).DataTable({
              orderCellsTop: true,
              fixedHeader: true,
              // dom: "tpir",
              dom: "Btplir",
              "deferRender": true,
              buttons: [
                  $.extend( true, {}, buttonCommon, {
                    extend: 'excelHtml5',
                    customize: function(xlsx){
                      var table = xlsx.xl.worksheets['sheet1.xml'];
                      var kolom=['A','B','C','D','E','F','G','H','I','J'];
                      var j = 3;
                      for (var i = 0; i < tabelIndex.columns().count(); i++){
                        if( $(tabelIndex.column(i).header()).text() == 'Tanggal' || $(tabelIndex.column(i).header()).text() == 'Tanggal Jurnal' || $(tabelIndex.column(i).header()).text() == 'Tanggal Pembayaran'){
                          var test1 = $(tabelIndex.column(i).data()).toArray();
                          test1.forEach(test);
                          function test(item) {
                            var sementara = item.substr(90,101);
                            $(`c[r^= ${kolom[i]}${j}] t`, table).text(sementara);
                            j++;
                          }
                        }
                      }                     
                    }
                  }
                ), 
                $.extend( true, {}, buttonCommon, {
                  extend: 'pdfHtml5',
                  orientation:'landscape',
                  pageSize: 'LEGAL',
                  
              } ),
                
                // 'excelHtml5',
                // 'pdfHtml5'
              ],
              rowId: 'id',
              pageLength: 20,
              processing: true,
              serverSide: true,
              ajax: {
                type: "POST",
                url: host + '/' + params.content.url,
                data: {
                  'tgl_awal': params.parameter['tanggal_awal'],
                  'tgl_akhir': params.parameter['tanggal_akhir']
                },
              },
              deferRender: true,
              select: !1,
              colReorder: !0,
              sorting: [
                [1, "asc"]
              ],
              pagingType: "full_numbers",
              stateSave: !1,
              language: {
                "zeroRecords": "Data tidak ditemukan...",
                "processing": '<span class="text-danger">Mengambil Data....</span>'
              },
              lengthMenu: [
                [20, 50, 100, 200, -1],
                [20, 50, 100, 200, "All"]
              ],
              columns: params.content.columns,
              headerCallback: function (thead, data, start, end, display) {
                thead.getElementsByTagName('th')[0].innerHTML = `
                              <label class="checkbox checkbox-single">
                                      <input type="checkbox" value="" class="group-checkable"/>
                                      <span></span>
                              </label>`;
              },
              columnDefs: params.content.columnDefs
            });
            params.columnSetting.table = tabelIndex;
            params.columnSetting.status = 'after_search';
            _this.checkAllColumn(params.columnSetting);

          }
          else if (params.status == 'getTipePengiriman') {

            $.ajax({
              type: "GET",
              timeout: 50000,
              url: params.url,
              async: true,
              success: function (res) {

                if (res.tipe_pengiriman != undefined && res.tipe_pengiriman != null) {
                  $(params.table).DataTable().cell(params.index, 3).nodes().to$().find('input').val(res.tipe_pengiriman['keterangan']);
                } else {
                  notice('tipe pengiriman tidak ada', 'warning');
                }
              },
              error: function (res, textstatus) {

              }
            });
          }
          else if (params.status == 'printDO') {
            $.ajax({
              type: "GET",
              timeout: 50000,
              url: params.url,
              data: params.data,
              async: true,
              success: function (res) {
                //console.log(res)
              },
              error: function (res, textstatus) {

              }
            });
          }
          else if (params.status == 'returList_') {
            $.ajax({
              type: "POST",
              timeout: 50000,
              url: host + '/' + params.url,
              async: true,
              data: params.data,
              success: function (res) {
                $(`${params.modal} .modal-dialog`).html('');
                $(`${params.modal} .modal-dialog`).html(res);
                $(`${params.modal}`).modal('show');
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

        } else {

          $.ajax({
            type: "GET",
            url: host + '/refresh-token',
            success: function (response) {

              if (response.status_code != 500) {
                $(`#loginModal .modal-dialog`).html('');
                $(`#loginModal .modal-dialog`).html(response.body);
                $(`#loginModal`).modal('show');
              }


            },
            error: function () {
              alert('error refresh');
            }
          });
        }

      }
    });
  }

  this.ajaxList = function (data) {
    this.ajaxGroup(data.params);
  }

  this.checkAllColumn = function (data) {
    let table = '';
    //console.log(data.params);
    if (data.status != 'after_search') {
      table = this.ajaxGroup(data.params);
    } else {
      table = data.table;
    }
    var test = data.columnName;
    if (test.length !== undefined){
    for (let index = 0; index < test.length; index++) {
      
      $(`#${data.classCheck}_${test[index]}`).prop('checked', true);
    }
  }

    $.each(data.columnIndex, function (indexInArray, valueOfElement) {
      $(`#${data.classCheck}_${valueOfElement}`).prop('checked', false);
      table.column(valueOfElement).visible(false);
    });
  }

  this.editMultipleData = function(data,table,path){
    var oData = data;
    console.log(oData);
      $.each(oData,function(index,value){
        if ("nomor"in value){
        add_content_tab(table,`edit_data_${value.id}`,`${path}/${value.id}`, 'Edit Data', `${value.nomor}`)
        }else if ("kode"in value){
          add_content_tab(table,`edit_data_${value.id}`,`${path}/${value.id}`, 'Edit Data', `${value.kode}`)
          }else if ( !("nomor"in value) && !("kode"in value)){
            add_content_tab(table,`edit_data_${value.id}`,`${path}/${value.id}`, 'Edit Data', `${value.keterangan}`)
            }
      })   
  }

  this.deleteMultipleData = function(data,table,path){
    var oData = data;
  //   if (value.kode!=undefined){
  //   $.each(oData,function(index,value){
  //     add_content_tab(this().tabel,`edit_data_${value.id}`,`${path}/${value.id}`, 'Edit Data', `${value.nomor}`)
  //   })   
  // }else if (value.nomor!=undefined){
  //   $.each(oData,function(index,value){
  //     add_content_tab(this().tabel,`edit_data_${value.id}`,`${path}/${value.id}`, 'Edit Data', `${value.kode}`)
  //   })
  // }else if (value.kode!=undefined && value.nomor!=undefined){
  //   $.each(oData,function(index,value){
  //     add_content_tab(this().tabel,`edit_data_${value.id}`,`${path}/${value.id}`, 'Edit Data', `${value.keterangan}`)
  //   })
  // }
  }

  this.columnshowHideDinamically = function (table, cols, id) {

    var table = $(`#${table}`).DataTable();

    var manual = id.replace("Checkboxes","menu");
    var not_check = [];
    $("input[type='checkbox'][class='"+manual+"']:not(:checked)").each(function(){
      not_check.push($(this).val());
    });

    var indexcol = [];
    table.columns().every(function(){
      indexcol.push(this.header().textContent.toString().replaceAll(" ", "_").replaceAll("/","_"));
    
    })


    var columns = table.settings().init().columns;
    table.columns().every(function(index) { 
        var ind = indexcol.indexOf(this.header().textContent.toString().replaceAll(" ", "_").replaceAll("/","_"))
        if(not_check.includes(this.header().textContent.toString().replaceAll(" ", "_").replaceAll("/","_"))){
             console.log(this.header().textContent.toString());
          table.column(ind).visible(false);
        } else {
          table.column(ind).visible(true);
        }
    })

  }

  this.runCalculate = function (){
    _this.setting_column_all(_this.element.table.barangJasa, _this.element.interactive.mode, _this.element.interactive.type, 10, 9, 11, _this.element.interactive.module);
  }
}

showModule = (mode, id, nomor) => {
  let transaksi = new transaksiInit;
  transaksi.redirectToModule(mode, id, nomor);
}

forwardModule = (page, id, nomor) => {
  let splitPage = page.split(' ');
  add_page(`${splitPage[0]}_${splitPage[1]}_${splitPage[2]}`, `${splitPage[0]}/${splitPage[1]}-${splitPage[2]}`, `${splitPage[1]} ${splitPage[2]}`);
  add_content_tab(`${splitPage[0]}_${splitPage[1]}_${splitPage[2]}`,'tambah_data',`${splitPage[0]}/${splitPage[1]}-${splitPage[2]}/create`, 'Tambah Data')
}

function copyData(data) {
  let cData = data;
  copiedAllData = cData;
}

function pasteData() {
  let expData = {};
  expData = copiedAllData;
  return expData;
  //return copiedData;
}

function copySyarat(data) {
  copiedSyarat = data;
}

function pasteSyarat() {
  return copiedSyarat;
}

function normalizeLokasi(lokasi) {
  return lokasi['provinsi']+', '+lokasi['kabupaten']+', '+lokasi['kecamatan']+', '+lokasi['kelurahan']+', '+lokasi['kodepos'];
}

function addDetailFaktur(tabel, data, ads) {

  $.each(data, function (idx, val) {
    let stokterpakaiRow = syaratPengirimanRow = jadwalPengirimanRow = barangVal = kol2 = kol5 = pengirimanId = null;
    var id = null;
    if (ads['tipe'] == 'pembelian'){
      // Kolom 2 Barang Value
      // Kolom 5 null
      if (ads['barang'][idx] != undefined) {
        barangVal = ads['barang'][idx];
        kol2 = barangVal;
      }
      console.log(barangVal);
      id = val.faktur_pembelian_header_id;
    }
    else if(ads['tipe'] == 'penjualan'){
      // Kolom 2 Stok Terpakai
      // Kolom 5 Stok
      let stok = ads['stok'];
        kol5 = stok[idx];
      if (ads['stokTerpakai'][idx] != undefined) {
        kol2 = ads['stokTerpakai'][idx];
      }
      id = val.faktur_penjualan_header_id;

    }

    let selectPajak = getPajakFaktur(idx,id,ads['pajak'],ads['tipe'],val['kode_pajak_id']);
    let prev = getPreFaktur(ads['tipe'],val);
    let actionBtn = getFakturActionBtns(ads['tipe'],val.harga_jasa_id)
    var totalsHarga = val.harga * val.kuantitas;

    let barangJasa = normalizeBarangJasa(val.harga_jasa_id);
    let idBarangJasa  = barangJasa['id'];
    let kode          = barangJasa['kode'];
    let keterangan    = barangJasa['keterangan'];
    let produkServis  = barangJasa['produk_servis'];
    let paket         = barangJasa['paket'];
    let asal          = barangJasa['asal'];
    let tujuan        = barangJasa['tujuan'];
    let tipe          = barangJasa['tipe']

    let kuantitas = `<input type="number" class="form-control" value="${val.kuantitas}" id="qtyElement">`;
    let harga     = `<input type="text" id="priceElement" class="form-control harga_edit_pembelian${val.id} harga" value="${val.harga}" placeholder="20000"/>`;
    let total     = `<span>${totalsHarga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</span>`;

    if (ads['syarat'][idx] != undefined) {
      syaratPengirimanRow = ads['syarat'][idx];
    }

    if (ads['jadwal'][idx] != undefined) {
      jadwalPengirimanRow = ads['jadwal'][idx];
    }

    $(tabel).DataTable().row.add([
      tipe, //val.harga_jasa_id['tipe'],
      kol2,
      syaratPengirimanRow,
      jadwalPengirimanRow,
      kol5,
      `<input type="text" value="${prev['p3_id']}">`,
      `<input type="text" value="${idBarangJasa}">`,
      kode,
      keterangan,
      kuantitas, //`<input type="number" class="form-control" value="${val.kuantitas}" id="qtyElement">`,
      selectPajak, //`<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpicker kodePajakFakturPenjualan${idx}_${id}" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
      harga, //`<input type="text" id="priceElement" class="form-control harga_edit_pembelian${val.id} harga" value="${val.harga}" placeholder="20000"/>`,
      total, //`<span>${totalsHarga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</span>`,
      actionBtn,
      produkServis,
      paket,
      asal,
      tujuan,
      prev['p1'],//penawaran,
      prev['p2'],//pesanan,
      prev['p3'],//pengiriman
    ]).draw();

    $('.selectpicker').selectpicker();
    price_format_class('harga');
  });
}

function addDataBebanFaktur(tabel, data, akun) {
  $.each(data, function (idx, val) {
    var dataListAkun = '';
    $.each(akun, function (index, value) {
      if (index == val['akun_id']){
        dataListAkun += `<option value="${index}" selected>${value}</option>`;
      }else{
        dataListAkun += `<option value="${index}">${value}</option>`;
      }

    });
    $(tabel).DataTable().row.add([
      `<select class="form-control selectpicker beban " data-size="7" data-live-search="true" title="Pilih" data-toggle="ajax" data-container="body">${dataListAkun}</select>`,
      `<input type="text" class="form-control harga" value="${val['harga']}" >`,
      `<input type="text" class="form-control" value="${val['keterangan']}" >`,
      `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="deleteBeban">
           <i class="fas fa-trash text-danger"></i></a>`
    ]).draw();
    price_format_class('harga');
    $('.beban').selectpicker();
  });
}

function addDataPelunasanFaktur(tabel, data, totalf, tipe) {
  let totalp = 0;
  let splitTabel = tabel.split('_');
  let id = splitTabel[splitTabel.length - 1];
  if(tipe == 'penjualan'){
    $.each(data, function (idx, val) {
      $(tabel).DataTable().row.add([
        `<a href="#" onclick="showModule('penerimaan_penjualan','${val['header']['id']}','${val['header']['nomor']}')"><u>${val['header']['nomor']}</u></a>`,
        `<span class="harga">${val['nominal_penjualan']}</span>`
      ]).draw();
      price_format_class('harga');
      totalp += val['nominal_penjualan'];

    });
    if (totalp >= totalf){
      $(`#paid_${id}`).show();
    }
  }
  else if(tipe == 'pembelian'){
    $.each(data, function (idx, val) {
      $(tabel).DataTable().row.add([
        `<a href="#" onclick="showModule('pembayaran_pembelian','${val['header']['id']}','${val['header']['nomor']}')"><u>${val['header']['nomor']}</u></a>`,
        `<span class="harga">${val['nominal_pembayaran']}</span>`
      ]).draw();
      price_format_class('harga');
      totalp += val['nominal_pembayaran'];

    });
    if (totalp >= totalf){
      $(`#lunas_${id}`).show();
    }
  }

}

function addDetailRetur(tabel, data, ads) {

  let col2 = col5 = [];

  data['sn_mode']   = 'select';
  data['gudang_id'] = ads['gudang_id'];
  let nwData = normalizeRowData(data);

  $(tabel).DataTable().row.add([
    data.harga_jasa_id['tipe'],
    ads['sn_terpilih'],//data.detail_sn.map((e, index) => { return {value :e.nomor_seri};  }),
    null,
    `<input type="number" value="` + data.harga_jasa_id['id'] + `" readonly/>`,//data.harga_jasa_id['id'],
    ads['sn_tersedia'],
    data.pengiriman,//`<input type="number" value="` + data.id_detail + `" readonly/>`,
    data.faktur,//null,
    data.harga_jasa_id['kode'],
    nwData['keterangan'],
    `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="${data.kuantitas}"/>`,
    `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious ${ads['kode_pajak_class']}" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
    `<input type="text" id="priceElement" class="form-control harga_nonPrice harga" value="${nwData['harga']}" placeholder="0" />`,
    `<span id="totalharga_">0</span>`,
    nwData['action'],
    nwData['produkLayanan'],
    nwData['paket'],
    nwData['asal'],
    nwData['tujuan'],
  ]).draw();

  price_format_class('harga');
  let transaksi = new transaksiInit();
  transaksi.runCalculate();


}

function addDetailPengiriman(tabel, data, ads) {
  $.each(data, function (idx, val) {
    val['sn_mode'] = 'input';
    let nwData = normalizeRowData(val);
    let syarat = jadwal = null;
    let snBarang = null;
    let pesananId = null;
    let pesanan_pembelian = '-';
    let permintaan_pembelian = '-';

    if (ads['tipe'] == 'pembelian'){
      if (val['pesanan_pembelian_detail'] != null) {
        pesananId = val.pesanan_pembelian_detail_id;

        if (val['pesanan_pembelian_detail'] != null) {
          pesanan_pembelian = `<a href="#" onclick="showModule('pesanan_pembelian','${val.pesanan_pembelian_detail['header']['id']}','${val.pesanan_pembelian_detail['header']['nomor']}')"><u>${val.pesanan_pembelian_detail['header']['nomor']}</u></a>`;
          if (val['permintaan_pembelian_detail'] != null) {
            permintaan_pembelian = `<a href="#" onclick="showModule('permintaan_pembelian','${val.permintaan_pembelian_detail['header']['id']}','${val.permintaan_pembelian_detail['header']['nomor']}')"><u>${val.permintaan_pembelian_detail['header']['nomor']}</u></a>`;
          }
        }
      }
    }else if(ads['tipe'] == 'penjualan'){
      if(val['pesanan_penjualan_detail'] != null){
        pesananId = val['pesanan_penjualan_detail_id'];

        if (val['pesanan_penjualan_detail'] != null) {
          pesanan_pembelian = `<a href="#" onclick="showModule('pesanan_penjualan','${val.pesanan_penjualan_header['id']}','${val.pesanan_penjualan_header['nomor']}')"><u>${val.pesanan_penjualan_header['nomor']}</u></a>`;
          // if (val['permintaan_pembelian_detail'] != null) {
          //   permintaan_pembelian = `<a href="#" onclick="showModule('permintaan_pembelian','${val.permintaan_pembelian_detail['header']['id']}','${val.permintaan_pembelian_detail['header']['nomor']}')"><u>${val.permintaan_pembelian_detail['header']['nomor']}</u></a>`;
          // }
        }
      }
    }

    if (ads['barang'][idx] != undefined) {
      snBarang = ads['barang'][idx];
    }

    if (ads['syarat'][idx] != undefined) {
      syarat = ads['syarat'][idx];
    }

    if (ads['jadwal'][idx] != undefined) {
      jadwal = ads['jadwal'][idx];
    }
    console.log('start add row')
    console.log($(tabel));
    $(tabel).DataTable().row.add([
      val.harga_jasa_id['tipe'],
      snBarang,
      syarat,
      jadwal,
      null,
      `<input type="text" value="${pesananId}">`,
      `<input type="text" value="${val['harga_jasa_id']['id']}">`,
      val['harga_jasa_id']['kode'],
      nwData['keterangan'],
      `<input class="form-control" value="${val['kuantitas']}">`,
      nwData['action'],
      nwData['produkLayanan'],
      nwData['paket'],
      nwData['asal'],
      nwData['tujuan'],
      permintaan_pembelian,
      pesanan_pembelian
    ]).draw();

  });

}

function normalizeRowData(data) {
  let normData = [];

  //condition ? exprIfTrue : exprIfFalse
  normData['produkLayanan'] = data['harga_jasa_id']['produk_servis_id'] != null ? data['harga_jasa_id']['produk_servis_id']['keterangan'] : '-';
  normData['paket']         = data['harga_jasa_id']['paket_id']         != null ? data['harga_jasa_id']['paket_id']['keterangan'] : '-';
  normData['asal']          = data['harga_jasa_id']['asal_id']          != null ? normalizeLokasi(data['harga_jasa_id']['asal_id']) : '-';
  normData['tujuan']        = data['harga_jasa_id']['tujuan_id']        != null ? normalizeLokasi(data['harga_jasa_id']['tujuan_id']) : '-';
  normData['keterangan']    = data['harga_jasa_id']['keterangan']       != null ? data['harga_jasa_id']['keterangan'] : '-';
  normData['harga']         = data['harga']                             != null ? data['harga']: 0;

  if (data['harga_jasa_id']['tipe'] == 1) {
    $('.selectpicker-gudang').val(data['gudang_id']);
    $('.selectpicker-gudang').selectpicker('refresh');
    $('body .formGudang').css('display', 'block');
    $('body .formGudang').attr('data-id', 'gudangValidate')
    if (data['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
      if(data['sn_mode'] == 'input'){
        normData['action'] = getBtn('snEdit') + getBtn('jadwal') + getBtn('delete');
      }else if(data['sn_mode'] == 'select'){
        normData['action'] = getBtn('sn') + getBtn('jadwal') + getBtn('delete');
      }
    } else {
      normData['action'] = getBtn('jadwal') + getBtn('delete');
    }
  }
  else if (data['harga_jasa_id']['tipe'] == 3) {
    normData['action'] = getBtn('expedisi') + getBtn('syarat') + getBtn('jadwal') + getBtn('delete');
  }

  return normData;
}

function getBtn(nama) {
  let buttons = [];
  let btnJadwal = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal">
                      <i class="far fa-calendar text-primary"></i>
                  </a>`;
  let btnDelete = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                  </a>`;
  let btnDetailPengiriman = `<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Barang">
                        <i class="flaticon2-plus mr-n1"></i>
                  </a>`;
  let btnSyarat = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman">
                        <i class="fas fa-shipping-fast text-warning"></i>
                   </a>`;
  let btnSn = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number">
                    <i class=" fas fa-box-open"></i>
              </a>`;
  let btnInputSn = `<a href="javascript:void(0)" id="serialNumberEdit" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a>`
  buttons['jadwal']   = btnJadwal;
  buttons['delete']   = btnDelete;
  buttons['expedisi'] = btnDetailPengiriman;
  buttons['syarat']   = btnSyarat;
  buttons['snEdit']   = btnInputSn;
  buttons['sn']       = btnSn;

  return buttons[nama];
}

function showSNData(barang,transaksi,id) {
  var tbl_sn = $('#tbl_list_sn').DataTable({ bDestroy : true,});
  tbl_sn.clear().draw();
  $.ajax({
    type: "POST",
    timeout: 50000,
    url: host + '/perusahaan/stok/sn-transaksi',
    async: true,
    data: {
      barang:barang, transaksi:transaksi, id:id
    },
    success: function (res) {
      $.each(res, function (i,el) {
          tbl_sn.row.add([el.nomor_seri,el.nama]).draw();
      });

      $(`#modal_list_sn`).modal('show');
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

function normalizeJadwal(dataJadwal) {
  let jadwal = {};
  return jadwal = {
    0: null,
    1: null,
    2: null,
    3: null,
    4: null,
    5: null,
    6: dataJadwal['id'],
    7: dataJadwal['nomor'],
    8: dataJadwal['alat_transportasi']['keterangan'],
    9: normalizeLokasi(dataJadwal['asal']),//value['jadwal_pengiriman_id']['asal']['provinsi'] + ',' + value['jadwal_pengiriman_id']['asal']['kabupaten'] + ',' + value['jadwal_pengiriman_id']['asal']['kecamatan'] + ',' + value['jadwal_pengiriman_id']['asal']['kelurahan'] + ',' + value['jadwal_pengiriman_id']['asal']['kodepos'],
    10: normalizeLokasi(dataJadwal['tujuan']),//value['jadwal_pengiriman_id']['tujuan']['provinsi'] + ',' + value['jadwal_pengiriman_id']['tujuan']['kabupaten'] + ',' + value['jadwal_pengiriman_id']['tujuan']['kecamatan'] + ',' + value['jadwal_pengiriman_id']['tujuan']['kelurahan'] + ',' + value['jadwal_pengiriman_id']['tujuan']['kodepos'],
    11: "<a href=javascript:; class=btn btn-sm btn-clean btn-icon title=Delete id=deleteJadwalPengiriman><span class=svg-icon svg-icon-md><i class=flaticon2-trash text-danger></i></span></a>",
    12: dataJadwal['voyage_flight_trip'],
    13: dataJadwal['tanggal_pembukaan'],
    14: dataJadwal['tanggal_penutupan'],
    15: dataJadwal['eta_asal'],
    16: dataJadwal['etd_asal'],
    17: dataJadwal['eta_tujuan'],
  };
}

function pesananToPengirimanPenjualan(id){

  try {

  }
  finally {
    $.ajax({
      type: "POST",
      timeout: 50000,
      url: host + '/penjualan/pesanan-penjualan/belum_selesai_detail',
      async: true,
      data: { id_detail:id },
      before : forwardModule('penjualan pengiriman pesanan','',''),
      success: function (res) {
        console.log(res.data);
        let tabel = '#tbl_add_detail_pengiriman_pesanan';
        let data = res.data;
        let ads = [];
        let tbls = $(tabel);

        cekEl('#tbl_add_detail_pengiriman_pesanan');
        ads['jadwal'] = res.data.map((e, index) => { return normalizeJadwal(e.jadwal_pengiriman_id); })
        ads['syarat'] = res.data.map((e, index) => { return e.syarat_pengiriman.map((f, inde) => { return f.syarat_pengiriman_id; }) });
        ads['barang'] = [];
        ads['tipe'] = 'penjualan';
        $(`#pelanggan_pengiriman_penjualan_add`).val(res.data[0]['pelanggan_id']);
        $(`#pelanggan_pengiriman_penjualan_add`).selectpicker('refresh');
        addDetailPengiriman(tabel, data, ads);

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

function cekEl(el) {
  let t0;
  if ($(el).length < 1){
    console.log('tidak ada');
    setTimeout(cekEl(el), 1000);
    //;
    return false;
  }
  clearTimeout(t0);
  console.log('ditemukan');
  return true;
}

function pengirimanToFakturPenjualan(id) {
  forwardModule('penjualan faktur penjualan', 'id', 'nomor');
  $.ajax({
    type: "POST",
    timeout: 50000,
    url: host + '/penjualan/faktur-penjualan/belum_selesai_detail',
    async: true,
    data: { id_detail:id },
    //before : forwardModule('penjualan pengiriman pesanan','',''),
    success: function (res) {
      console.log(res.data);
      let tabel = '#tbl_add_detail_pengiriman_faktur_faktur';
      let data = res.data;
      let ads = [];
      let tbls = $(tabel);

      //cekEl('#tbl_add_detail_pengiriman_pesanan');
      ads['jadwal'] = res.data.map((e, index) => { return e.jadwal_pengiriman_id !== null ? normalizeJadwal(e.jadwal_pengiriman_id) : []; })
      ads['syarat'] = res.data.map((e, index) => { return e.syarat_pengiriman !== null ? e.syarat_pengiriman.map((f, inde) => { return f.syarat_pengiriman_id; }) :null });
      ads['barang'] = [];
      ads['stok']   = [];
      ads['stokTerpakai']   = [];
      ads['tipe'] = 'penjualan';
      $(`#pelanggan_pengiriman_penjualan_add`).val(res.data[0]['pelanggan_id']);
      $(`#pelanggan_pengiriman_penjualan_add`).selectpicker('refresh');
      addDetailFaktur(tabel, data, ads);

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

function addRowTableFaktur(row){
  $(tabel).DataTable().row.add([
    val.harga_jasa_id['tipe'],
    kol2,
    syaratPengirimanRow,
    jadwalPengirimanRow,
    kol5,
    `<input type="text" value="${pengirimanId}">`,
    `<input type="text" value="${val.harga_jasa_id['id']}">`,
    val.harga_jasa_id['kode'],
    keterangan,
    `<input type="number" class="form-control" value="${val.kuantitas}" id="qtyElement">`,
    selectPajak,
    //`<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpicker kodePajakFakturPenjualan${idx}_${id}" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
    `<input type="text" id="priceElement" class="form-control harga_edit_pembelian${val.id} harga" value="${val.harga}" placeholder="20000"/>`,
    `<span>${totalsHarga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</span>`,
    actionBtn,
    produkServis,
    paket,
    asal,
    tujuan,
    penawaran,
    pesanan,
    pengiriman
  ]).draw();
}

function normalizeBarangJasa(bj) {
  let barangJasa = [];
  barangJasa['id']            =  bj['id'] !== null ? bj['id'] : '';
  barangJasa['kode']          =  bj['kode'] !== null ? bj['kode'] : '';
  barangJasa['tipe']          =  bj['tipe'] !== null ? bj['tipe'] : '';
  barangJasa['keterangan']    =  bj['keterangan'] !== null ? bj['keterangan'] : '';
  barangJasa['produk_servis'] =  bj['produk_servis_id'] !== null ? bj['produk_servis_id']['keterangan'] : '';
  barangJasa['paket']         =  bj['paket_id']  !== null ? bj['paket_id']['keterangan'] : '';
  barangJasa['asal']          =  bj['asal_id']   !== null ? normalizeLokasi(bj['asal_id']) : '';
  barangJasa['tujuan']        =  bj['tujuan_id'] !== null ? normalizeLokasi(bj['tujuan_id']) : '';

  return barangJasa;
}

function getFakturActionBtns(mode,bj) {
  let actions = '';
  if(mode == 'pembelian'){
    if (bj['tipe'] == 1){
      actions = getBtn('jadwal') + getBtn('delete');
      if(bj['menggunakan_nomor_seri'] == 1){
        actions = getBtn('sn') + getBtn('jadwal') + getBtn('delete');
      }
    }else if(bj['tipe'] == 3){
      actions = getBtn('expedisi') + getBtn('syarat') +getBtn('jadwal') + getBtn('delete');
    }
  }
  else if(mode == 'penjualan'){
    if (bj['tipe'] == 1){
      actions = getBtn('jadwal') + getBtn('delete');
      if(bj['menggunakan_nomor_seri'] == 1){
        actions = getBtn('snEdit') + getBtn('jadwal') + getBtn('delete');
      }
    }else if(bj['tipe'] == 3){
      actions = getBtn('expedisi') + getBtn('syarat') +getBtn('jadwal') + getBtn('delete');
    }
  }
  return actions;
}

function getPreFaktur(mode,detail) {
  let pre = [];
  pre['p1'] = '';
  pre['p2'] = '';
  pre['p3'] = '';
  pre['p3_id'] = '';

  if (mode == 'pembelian'){
    if (detail.pengiriman_pembelian_detail_id != null) {
      pre['p3_id'] = detail.pengiriman_pembelian_detail_id;
      pre['p3'] = `<a href="#" onclick="showModule('pengiriman_pembelian','${detail.pengiriman_pembelian_detail['header']['id']}','${detail.pengiriman_pembelian_detail['header']['nomor']}')"><u>${detail.pengiriman_pembelian_detail['header']['nomor']}</u></a>`;
      if (detail.pesanan_pembelian_detail != null) {
        pre['p2'] = `<a href="#" onclick="showModule('pesanan_pembelian','${detail.pesanan_pembelian_detail['header']['id']}','${detail.pesanan_pembelian_detail['header']['nomor']}')"><u>${detail.pesanan_pembelian_detail['header']['nomor']}</u></a>`;
        if (detail.permintaan_pembelian_detail != null) {
          pre['p1'] = `<a href="#" onclick="showModule('permintaan_pembelian','${detail.permintaan_pembelian_detail['header']['id']}','${detail.permintaan_pembelian_detail['header']['nomor']}')"><u>${detail.permintaan_pembelian_detail['header']['nomor']}</u></a>`;
        }
      }
    }
  }
  else if(mode == 'penjualan'){
    if (detail.pengiriman_penjualan_detail_id != null) {
      pre['p3_id'] = detail.pengiriman_penjualan_detail_id;
      let pengirimanHeader = detail.pengiriman_penjualan['header'];
      pre['p3'] = makeShowModul('pengiriman_pesanan',pengirimanHeader['id'],`${pengirimanHeader['nomor']}`);
      if (detail.pesanan_penjualan != null) {
        let pesananHeader = detail.pesanan_penjualan['header'];
        pre['p2'] = makeShowModul('pesanan_penjualan',pesananHeader['id'],`${pesananHeader['nomor']}`);
        if (detail.penawaran_penjualan != null) {
          let penawaranHeader = detail.penawaran_penjualan['header'];
          pre['p1']  = makeShowModul('penawaran_penjualan',penawaranHeader['id'],`${penawaranHeader['nomor']}`);
        }
      }
    }
  }
  return pre;
}

function makeShowModul(modul,id,nomor) {
  return `<a href="#" onclick="showModule('${modul}',${id},'${nomor}')"><u>${nomor}</u></a>`;
}

function getPajakFaktur(idx,id,pajaks,tipe,nilai) {
  let listPajak = '';
  let klas = '';
  let select = '';
  $.each(pajaks, function (key, value) {
    if (nilai != null && nilai['id'] == value['id']) {
      listPajak += `<option value="${value['id']}" nilai="${value['nilai']}" selected>${value['nama']}</option>`;
    }else{
      listPajak += `<option value="${value['id']}" nilai="${value['nilai']}" >${value['nama']}</option>`;
    }
  });
  if(tipe == 'pembelian'){
    klas = `kodePajakFakturPembelian${idx}_${id}`;
  }else if(tipe == 'penjualan'){
    klas = `kodePajakFakturPenjualan${idx}_${id}`;
  }
  select = `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpicker ${klas}" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body">${listPajak}</select>`;

  return select;

}
