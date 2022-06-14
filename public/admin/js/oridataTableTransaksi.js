var host = $('meta[name="host_url"]').attr('content');
var SNdata = [];
var BarangForShipping = [];
var value;
var tamps_value_stok = [];
var callShowJadwalPengiriman;
var sisaFlat = '';
var dataJadwalArray = [];
var dataSyaratArrayPengiriman = [];

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

            $('input', this).on('keypress', function (e) {

                if (e.which == 13) {
                    table.column(i).search(this.value).draw();
                }
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

            $('input', this).on('keypress  ', function (e) {
                if (e.which == 13) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
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

            $('input', this).on('keypress  ', function (e) {
                if (e.which == 13) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
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

        // console.log('data tipe : ' + data.tipe);
        // console.log('sub tipe : ' + subType);
        // console.log(data);

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
            asalId = data.asal_id['provinsi'] + ',' + data.asal_id['kabupaten'] + ',' + data.asal_id['kecamatan'] + ',' + data.asal_id['kelurahan'] + ',' + data.asal_id['kodepos'];
        }

        if (data.tujuan_id != null) {
            tujuanId = data.tujuan_id['provinsi'] + ',' + data.tujuan_id['kabupaten'] + ',' + data.tujuan_id['kecamatan'] + ',' + data.tujuan_id['kelurahan'] + ',' + data.tujuan_id['kodepos'];
        }

        if (subType == 'transfer_barang') {
            actionCell = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
      <i class="fas fa-trash text-danger"></i>
    </a>`;
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
            $('#penerima').css('display', 'block');
        }

        if (data.tipe == 1 && data['menggunakan_nomor_seri'] == 1 && subType == 'nomorSeri') {
            actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
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
                actionCell = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
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
            $('#penerima').css('display', 'block');
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


        } else if (type == 'transfer_barang') {

            // console.log(data.id)
            // console.log(gudang)
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
        } else {

            if (modules == 'pembelian') {

                if (data['informasi_pembelian']['length'] > 0) {
                    $.each(data['informasi_pembelian'], function (keys, values) {
                        // console.log(values);
                        if (values.pemasok_id == valVendors) {
                            rowHargaValue = values.harga_pembelian;
                        }
                    });
                }
            } else {

                if (data['informasi_penjualan']['length'] > 0) {
                    $.each(data['informasi_penjualan'], function (keys, values) {
                        // console.log(values);
                        // console.log('pelanggan_id : ' + values.pelanggan_id)
                        // console.log('id pelanggan : ' + valVendors)
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
        // console.log(type)
        // console.log(mode)
        if (data != undefined) {
            $(elementHeader).val(data.id);

            if (type != 1) {

                // $('#retur_header_').val(data.id);
                $.each(data['detail'], function (indexInArray, valueOfElement) {

                    var keterangan = '-';
                    var produkServis = '-';
                    var paketId = '-';
                    var asalId = '-';
                    var tujuanId = '-';
                    var actionCell = '-';
                    var secondColumn = [];
                    var hargaValue = 0;
                    var rowHargaValue = 0;
                    let stokTersedia = [];

                    rowHargaValue += valueOfElement.harga

                    if (valueOfElement['harga_jasa_id']['keterangan'] != null) {
                        keterangan = valueOfElement['harga_jasa_id']['keterangan'];
                    }

                    if (valueOfElement['harga_jasa_id']['kategori'] != null) {
                        kategori = valueOfElement['harga_jasa_id']['kategori'];
                    }

                    if (valueOfElement['harga_jasa_id']['produk_servis_id'] != null) {
                        produkServis = valueOfElement['harga_jasa_id']['produk_servis_id']['keterangan'];
                    }

                    if (valueOfElement['harga_jasa_id']['paket_id'] != null) {
                        paketId = valueOfElement['harga_jasa_id']['paket_id']['keterangan'];
                    }

                    if (valueOfElement['harga_jasa_id']['asal_id'] != null) {
                        asalId = valueOfElement['harga_jasa_id']['asal_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kodepos'];
                    }

                    if (valueOfElement['harga_jasa_id']['tujuan_id'] != null) {
                        tujuanId = valueOfElement['harga_jasa_id']['tujuan_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kodepos'];
                    }

                    if (valueOfElement['harga_jasa_id']['tipe'] == 1) {

                        if (valueOfElement['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
                            actionCell = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
              <i class="fas fa-trash text-danger"></i>
            </a>`;
                            $('body .formGudang').css('display', 'block');
                            $('body .formGudang').attr('data-id', 'gudangValidate')
                        } else {
                            actionCell = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete"><i class="fas fa-trash text-danger"></i></a>`;
                        }


                    }


                    if (valueOfElement['harga_jasa_id']['tipe'] == 3) {
                        actionCell = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
              <i class="fas fa-trash text-danger"></i>
            </a>`;
                        $('#penerima').css('display', 'block');
                    }

                    // NUNU

                    if (mode != 'penjualan') {
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
                                // console.log(response);
                                if (response['length'] > 0) {
                                    $.each(response, function (index, value) {
                                        secondColumn.push(value.nomor_seri);
                                    });
                                } else {
                                    secondColumn = null;
                                }
                            }
                        });
                    } else {
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
                                //  console.log(response);
                                if (response['length'] > 0) {
                                    $.each(response, function (index, value) {
                                        secondColumn.push(value.nomor_seri);
                                    });
                                } else {
                                    secondColumn = null;
                                }
                            }
                        });
                    }

                    $(tabel).DataTable().row.add([
                        valueOfElement.tipe,
                        null,
                        null,
                        valueOfElement['harga_jasa_id']['id'],
                        secondColumn,
                        null,
                        `<input type="number" value="` + valueOfElement.id + `" readonly/>`,
                        valueOfElement['harga_jasa_id']['kode'],
                        keterangan,
                        `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="0"/>`,
                        `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious kodePajakElePrevious${indexInArray}" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
                        `<input type="text" id="priceElement" class="form-control harga_nonPrice" value="${rowHargaValue}" placeholder="0" />`,
                        `<span id="totalharga_">0</span>`,
                        actionCell,
                        produkServis,
                        paketId,
                        asalId,
                        tujuanId,
                    ]).draw();

                    // console.log(kodePajakElement);

                    $.each(kodePajakElement, function (indexInArray, valueOfElement) {
                        $('.selectpickerPrevious').append(`<option value="${valueOfElement['id']}" nilai="${valueOfElement['nilai']}">${valueOfElement['nama']}</option>`)
                    });


                    if (data.kena_pajak > 0) {

                        if (mode != 'penjualan') {
                            $('#kena_pajak_retur_pembelian_add_retur_pembelian').prop("checked", true);
                            if (data.termasuk_pajak != null) {
                                $('#dengan_pajak_pesanan_pembelian').prop("checked", true);
                            }
                        } else {
                            $('#kena_pajak_retur_penjualan_add_retur_penjualan').prop("checked", true);
                            if (data.termasuk_pajak != null) {
                                $('#dengan_pajak_retur_penjualan_add_retur_penjualan').prop("checked", true);
                            }
                        }

                        if (valueOfElement.kode_pajak_id != null) {
                            $(`.kodePajakElePrevious${indexInArray}`).selectpicker('val', valueOfElement.kode_pajak_id['id']);
                            $(`.kodePajakElePrevious${indexInArray}`).selectpicker('refresh');
                        }

                    }

                    if (mode == 'pembelian') {
                        $('#gudang-return-pembelian').selectpicker('val', data.gudang_id);
                    }


                    price_format_class('harga_nonPrice');
                    $('.selectpickerPrevious').selectpicker();

                    if (mode != 'penjualan') {
                        $(attr_vendors).selectpicker('val', data.pemasok_id['id']);
                    } else {
                        $(attr_vendors).selectpicker('val', data.pelanggan_id);
                    }

                    notice('Data Faktu Pembelian di Tambahkan', 'success')
                });
            } else {

                let keterangan_2 = '';
                let harga_2 = 0;
                let action_ = '';
                let produk_layanan_ = '';
                let paket_ = '';
                let asal_ = '';
                let tujuan_ = '';
                let columnSN = [];
                let data_detail = '';
                let stokSelect = [];




                // if (mode != 'penjualan') {
                //   $.ajax({
                //     type: "POST",
                //     timeout: 50000,
                //     url: host + '/pembelian/retur-pembelian/getStokByDetail',
                //     async: true,
                //     data: {
                //       'id': data['id_detail'],
                //       'transaksi' : 'pengiriman'
                //     },
                //     success: function (response) {
                //       console.log(response);
                //       if (response['length'] > 0) {
                //         $.each(response, function (index, value) {
                //           columnSN.push(value.nomor_seri);
                //         });
                //       } else {
                //         columnSN = null;
                //       }
                //     }
                //   });

                // } else {
                //   $.ajax({
                //     type: "POST",
                //     timeout: 50000,
                //     url: host + '/penjualan/retur-penjualan/getStokByDetail',
                //     async: true,
                //     data: {
                //       'id': data['id_detail'],
                //       'transaksi' : 'pengiriman'
                //     },
                //     success: function (response) {
                //       console.log(response);
                //       if (response['length'] > 0) {
                //         $.each(response, function (index, value) {
                //           columnSN.push(value.nomor_seri);
                //         });
                //       } else {
                //         columnSN = null;
                //       }
                //     }
                //   });
                // }

                if (mode != 'penjualan') {
                    // $('#retur_header_pengiriman_pembelian').val(data.pengiriman_pembelian_header_id['id']);

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

                            // console.log(data_detail)

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
                                        //  console.log(response);
                                        let temps = [];
                                        // if (response['length'] > 0) {
                                        $.each(response, function (index, value) {

                                            temps.push(value.nomor_seri)
                                            // value.nomor_seri
                                        });

                                        columnSN[indexInArray] = temps;


                                        if (valueOfElement['harga_jasa_id']['produk_servis_id'] != null) {
                                            produk_layanan_ = valueOfElement['harga_jasa_id']['produk_servis_id']['keterangan'];
                                        }

                                        if (valueOfElement['harga_jasa_id']['paket_id'] != null) {
                                            paket_ = valueOfElement['harga_jasa_id']['paket_id']['keterangan'];
                                        }

                                        if (valueOfElement['harga_jasa_id']['asal_id'] != null) {
                                            asal_ = valueOfElement['harga_jasa_id']['asal_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kodepos'];
                                        }

                                        if (valueOfElement['harga_jasa_id']['tujuan_id'] != null) {
                                            tujuan_ = valueOfElement['harga_jasa_id']['tujuan_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kodepos'];
                                        }

                                        if (valueOfElement['harga_jasa_id']['tipe'] == 1) {

                                            if (valueOfElement['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
                                                action_ = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                                <i class="fas fa-trash text-danger"></i>
                              </a>`;
                                                $('body .formGudang').css('display', 'block');
                                                $('body .formGudang').attr('data-id', 'gudangValidate')
                                            } else {
                                                action_ = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete"><i class="fas fa-trash text-danger"></i></a>`;
                                            }


                                        }


                                        if (valueOfElement['harga_jasa_id']['tipe'] == 3) {
                                            action_ = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                                <i class="fas fa-trash text-danger"></i>
                              </a>`;
                                            $('#penerima').css('display', 'block');
                                        }

                                        if (valueOfElement.harga_jasa_id['keterangan'] != null) {
                                            keterangan_2 = valueOfElement.harga_jasa_id['keterangan'];
                                        }

                                        if (valueOfElement.harga != null) {
                                            harga_2 = valueOfElement.harga
                                        }





                                        $(tabel).DataTable().row.add([
                                            valueOfElement.harga_jasa_id['tipe'],
                                            null,
                                            null,
                                            valueOfElement.harga_jasa_id['id'],
                                            columnSN[indexInArray],
                                            `<input type="number" value="` + valueOfElement.id_detail + `" readonly/>`,
                                            null,
                                            valueOfElement.harga_jasa_id['kode'],
                                            keterangan_2,
                                            `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="0"/>`,
                                            `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious kodePajakElePrevious" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
                                            `<input type="text" id="priceElement" class="form-control harga_nonPrice" value="${harga_2}" placeholder="0" />`,
                                            `<span id="totalharga_">0</span>`,
                                            action_,
                                            produk_layanan_,
                                            paket_,
                                            asal_,
                                            tujuan_,
                                        ]).draw();

                                        $.each(kodePajakElement, function (indexInArray, valueOfElement) {
                                            $('.selectpickerPrevious').append(`<option value="${valueOfElement['id']}" nilai="${valueOfElement['nilai']}">${valueOfElement['nama']}</option>`)
                                        });

                                        price_format_class('harga_nonPrice');
                                        $('.selectpickerPrevious').selectpicker();


                                        // } else {
                                        //   columnSN = null;
                                        // }
                                    }
                                });


                            });

                        }
                    });

                } else {

                    // INI untuk Retur Penjualan


                    // if (data.pengiriman_penjualan_header_id != null) {
                    //   $('#retur_header_pengiriman_penjualan').val(data.pengiriman_penjualan_header_id)
                    // }

                    let columnSN = [];
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

                            //  console.log(data_detail);

                            $.each(data_detail, function (indexInArray, valueOfElement) {
                                //  console.log(valueOfElement['id_detail'])
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
                                        //  console.log(response);
                                        let temps = [];

                                        // if (response['length'] > 0) {

                                        $.each(response, function (index, value) {
                                            temps.push(value.nomor_seri)
                                        });

                                        columnSN[indexInArray] = temps;

                                        //  console.log(columnSN)


                                        if (valueOfElement['harga_jasa_id']['produk_servis_id'] != null) {
                                            produk_layanan_ = valueOfElement['harga_jasa_id']['produk_servis_id']['keterangan'];
                                        }

                                        if (valueOfElement['harga_jasa_id']['paket_id'] != null) {
                                            paket_ = valueOfElement['harga_jasa_id']['paket_id']['keterangan'];
                                        }

                                        if (valueOfElement['harga_jasa_id']['asal_id'] != null) {
                                            asal_ = valueOfElement['harga_jasa_id']['asal_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['asal_id']['kodepos'];
                                        }

                                        if (valueOfElement['harga_jasa_id']['tujuan_id'] != null) {
                                            tujuan_ = valueOfElement['harga_jasa_id']['tujuan_id']['provinsi'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kabupaten'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kecamatan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kelurahan'] + ',' + valueOfElement['harga_jasa_id']['tujuan_id']['kodepos'];
                                        }

                                        if (valueOfElement['harga_jasa_id']['tipe'] == 1) {

                                            if (valueOfElement['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
                                                action_ = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                                <i class="fas fa-trash text-danger"></i>
                              </a>`;
                                                $('body .formGudang').css('display', 'block');
                                                $('body .formGudang').attr('data-id', 'gudangValidate')
                                            } else {
                                                action_ = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete"><i class="fas fa-trash text-danger"></i></a>`;
                                            }


                                        }


                                        if (valueOfElement['harga_jasa_id']['tipe'] == 3) {
                                            action_ = `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                                <i class="fas fa-trash text-danger"></i>
                              </a>`;
                                            $('#penerima').css('display', 'block');
                                        }

                                        if (valueOfElement.harga_jasa_id['keterangan'] != null) {
                                            keterangan_2 = valueOfElement.harga_jasa_id['keterangan'];
                                        }

                                        if (valueOfElement.harga != null) {
                                            harga_2 = valueOfElement.harga
                                        }


                                        //  console.log(stokSelect)

                                        $(tabel).DataTable().row.add([
                                            valueOfElement.harga_jasa_id['tipe'],
                                            null,
                                            null,
                                            valueOfElement.harga_jasa_id['id'],
                                            columnSN[indexInArray],
                                            `<input type="number" value="` + valueOfElement.id_detail + `" readonly/>`,
                                            null,
                                            valueOfElement.harga_jasa_id['kode'],
                                            keterangan_2,
                                            `<input type="number" id="qtyElement" class="form-control kuantitas_add_data" value="0"/>`,
                                            `<select name="kode_pajak_add_data[]" id="kodePajakElement" class="form-control selectpickerPrevious kodePajakElePrevious" data-size="7" data-live-search="true" title="Pilih Kode Pajak" data-toggle="ajax" data-container="body"></select>`,
                                            `<input type="text" id="priceElement" class="form-control harga_nonPrice" value="${harga_2}" placeholder="0" />`,
                                            `<span id="totalharga_">0</span>`,
                                            action_,
                                            produk_layanan_,
                                            paket_,
                                            asal_,
                                            tujuan_,
                                        ]).draw();

                                        $.each(kodePajakElement, function (indexInArray, valueOfElement) {
                                            $('.selectpickerPrevious').append(`<option value="${valueOfElement['id']}" nilai="${valueOfElement['nilai']}">${valueOfElement['nama']}</option>`)
                                        });

                                        price_format_class('harga_nonPrice');
                                        $('.selectpickerPrevious').selectpicker();


                                        // } else {
                                        //   columnSN = null;
                                        // }
                                    }
                                });


                            });

                        }
                    })
                }




                // if (data.kena_pajak > 0) {

                //   if (mode != 'penjualan') {
                //     $('#kena_pajak_retur_pembelian_add_retur_pembelian').prop("checked", true);
                //     if (data.termasuk_pajak != null) {
                //       $('#dengan_pajak_pesanan_pembelian').prop("checked", true);
                //     }
                //   } else {
                //     $('#kena_pajak_retur_penjualan_add_retur_penjualan').prop("checked", true);
                //     if (data.termasuk_pajak != null) {
                //       $('#dengan_pajak_retur_penjualan_add_retur_penjualan').prop("checked", true);
                //     }
                //   }

                //   if (valueOfElement.kode_pajak_id != null) {
                //     $(`.kodePajakElePrevious${indexInArray}`).selectpicker('val', valueOfElement.kode_pajak_id['id']);
                //     $(`.kodePajakElePrevious${indexInArray}`).selectpicker('refresh');
                //   }

                // }

                // if (mode == 'pembelian') {
                //   $('#gudang-return-pembelian').selectpicker('val', data.gudang_id);
                // }



            }

        } else {
            notice('Data Faktu Pembelian Belum di Pilih', 'warning')
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

            $('input', this).on('keypress  ', function (e) {
                if (e.which == 13) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
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

        BarangForShipping[hargaJasaId] = data;
        // console.log(BarangForShipping);
        $('#modalBarang').modal('hide');
    }

    this.addModalBarang = function (thisBarang, url, dataParams, vendors, mainTab,tanggal,nomor) {
        //  console.log(tanggal);
        valueIndex = this.table.tableInit.row(thisBarang).index();
        valueData = this.table.tableInit.row(thisBarang).data();

        let paket = '';
        let jadwalPengiriman = '';
        let hargaJasaId = this.table.tableInit.cell(valueIndex, 6).nodes().to$().find('input').val();
        let kuantitas = this.table.tableInit.cell(valueIndex, 9).nodes().to$().find('input').val();
        let IdVendors = $(vendors).val();
        //console.log(_this.element.previousTransaction.idPemasok);
        console.log(_this.element.previousTransaction.namaPenerima);
        let penerima = {};
        penerima.nama   = $(_this.element.previousTransaction.namaPenerima).val();
        penerima.telp   = $(_this.element.previousTransaction.telpPenerima).val();
        penerima.alamat = $(_this.element.previousTransaction.alamatPenerima).val();
        let penerimax = $(_this.element.previousTransaction.namaPenerima).val();
        console.log(penerima)
        let no_identitas = nomor +'-'+kuantitas;

        if (mainTab == 'penjualan_pengiriman_pesanan') {
            paket = valueData[12];
        } else {
            paket = valueData[15];
        }

        if (dataParams != null && _this.SNdata.length == 0) {
            BarangForShipping = dataParams;
        }

        if (valueData[3] != null) {
            jadwalPengiriman = {
                'nomor': valueData[3][7],
                'asal': valueData[3][9],
                'tujuan': valueData[3][10],
                'etd_asal': valueData[3][16],
                'etd_tujuan': valueData[3][17],
            }
        }

        if (BarangForShipping[hargaJasaId] == undefined) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var params = {
                url: url,
                data: {
                    'dataBarang': 0,
                    'hargaJasaId': hargaJasaId,
                    'kuantitas': kuantitas,
                    'paket': paket,
                    'vendors': IdVendors,
                    'jadwalPengiriman': jadwalPengiriman,
                    'tanggal' :tanggal,
                    'identitas': no_identitas,
                    'penerima': penerima,
                    'penerimax': penerimax,
                },
                modal: '#modalBarang',
                status: 'modalShow'
            }
            this.ajaxGroup(params);
        } else {
            //  console.log(BarangForShipping[hargaJasaId]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var params = {
                url: url,
                data: {
                    'dataBarang': BarangForShipping[hargaJasaId],
                    'hargaJasaId': hargaJasaId,
                    'kuantitas': kuantitas,
                    'paket': paket,
                    'vendors': IdVendors,
                    'jadwalPengiriman': jadwalPengiriman,
                    'tanggal' :tanggal,
                    'identitas': no_identitas,
                    'penerima': penerima,
                    'penerimax': penerimax,
                },
                modal: '#modalBarang',
                status: 'modalShow'
            }
            this.ajaxGroup(params);
        }
    }

    this.print_delivery_invoice = function (index, data, pengirim) {
        //  console.log(data)
        var result_data = {
            'index': index,
            'result': data,
            'dataShipper': pengirim,
            // 'penerima': penerima,
            // 'penerima_x': penerimax,
        }



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
        index = this.table.tableInit.row(thisEle).index();
        var qty = this.table.tableInit.cell(index, 9).nodes().to$().find('input').val();
        var valuePrice = this.table.tableInit.cell(index, 11).nodes().to$().find('input').val();
        html = qty * valuePrice.replace(/,/g, "");
        this.table.tableInit.cell(index, 12).nodes().to$().find('span').html(html.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

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
        BarangForShipping = data;
    }

    this.tampungJadwal = function (params) {
        dataJadwalArray = params;
        // console.log(dataJadwalArray)
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
        var respon;
        var uang_muka_val;
        var tampungSN = Object.assign({}, _this.SNdata);
        var tampungBarangforShipping = Object.assign({}, BarangForShipping);
        var syaratValue = Object.assign({}, dataSyaratArrayPengiriman);
        var jadwalValue = Object.assign({}, dataJadwalArray);
        var detail_count = this.hargaJasaTable.tableInit.rows().count();
        if (detail_count > 0) {
            detail = this.hargaJasaTable.tableInit.rows().data().toArray();
            // console.log(detail);
            for (let index = 0; index < detail.length; index++) {
                detail[index][5] = this.hargaJasaTable.tableInit.cell(index, 5).nodes().to$().find('input').val();
                detail[index][6] = this.hargaJasaTable.tableInit.cell(index, 6).nodes().to$().find('input').val();
                detail[index][8] = this.hargaJasaTable.tableInit.cell(index, 8).nodes().to$().find('input').val();
                detail[index][9] = this.hargaJasaTable.tableInit.cell(index, 9).nodes().to$().find('input').val();
                detail[index][10] = this.hargaJasaTable.tableInit.cell(index, 10).nodes().to$().find('select').val();
                detail[index][11] = this.hargaJasaTable.tableInit.cell(index, 11).nodes().to$().find('input').val();
            }

            // console.log(this.UangMukaTable);

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

            // console.log(tampungBarangforShipping);

            // KTUtil.btnWait(btnElement, "spinner spinner-right spinner-white pr-15", "Please wait");
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
                    'SN': tampungSN,
                    'header': JSON.stringify($(`#${form}`).serializeArray()),
                    'detail': JSON.stringify(detail),
                    'uang_muka_val': JSON.stringify(uang_muka_val),
                    'jadwalPengiriman': jadwalValue,
                    'syaratPengiriman': syaratValue
                },
                success: function (res) {
                    // console.log(res);
                    var data = JSON.parse(res);
                    // console.log(data);
                    KTUtil.btnRelease(btnElement);
                    if (data.status !== false) {
                        close_content_tab(`${modul}`, `${mode}`);
                        Swal.fire('Berhasil!', data.message, 'success')
                        reload_table(`${table}`);
                        _this.SNdata = [];
                        BarangForShipping = [];
                        BarangForShipping.length = 0;
                        BarangForShipping.splice(0, BarangForShipping.length);
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
        } else {
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

            $('input', this).on('keypress  ', function (e) {
                if (e.which == 13) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
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
        var totalHarga = 0;
        var grandTotal = 0;
        var nilaiPajakAkhir = 0;
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

            // if (type_pajak != ''){
            //   console.log('Baris : '+rowIdx+' : '+type_pajak+' : '+val_pajak);
            // }
            var hargaPerRow = $('input', cell_harga).val().replace(/,/g, "") * $('input', cell_qty).val();
            totalHarga += hargaPerRow;
            grandTotal = totalHarga;

            if ($(`#kena_pajak_${title}_${type}_${value_type}`).prop("checked") == true){
                if ($(`#dengan_pajak_${title}_${type}_${value_type}`).prop("checked") == true){
                    nilaiPajak = hargaPerRow - hargaPerRow / ((parseFloat(val_pajak) + 100) / 100);
                }else{
                    nilaiPajak = (parseFloat(val_pajak) / 100) * hargaPerRow;
                    if (isNaN(nilaiPajak)){
                        nilaiPajak = 0;
                    }
                    totalPajak += nilaiPajak;
                    grandTotal += totalPajak;

                }

                if (nilaiPajak != 0){
                    element = document.getElementById(`pajak_${title}_${type}_${type_pajak.split(" ").join("_").replace("%","")}_${value_type}`);
                    // console.log(element);
                    if (element == null) {
                        pajak[type_pajak] = nilaiPajak;
                        var np = pajak[type_pajak].toString().split(".");
                        if(np.length > 1) {
                            if (np[1].toString().length > 2) {
                                np[1] = np[1].toString().substring(0, 2);
                                pajak[type_pajak] = parseFloat(np.join("."));
                            }
                        }
                        $(`#bottom_table_${title}_${type}_${value_type}`).prepend(`
              <div class="alert alert-success mb-5 p-5 ml-5 mt-5 ${title}-pajak-box_${type}_${value_type}" role="alert" id="pajak_${title}_${type}_${type_pajak.split(" ").join("_").replace("%","")}_${value_type}">
                <strong>${type_pajak}</strong>
                <div class="border-bottom border-white opacity-20 mb-5"></div>
                <h4 class="alert-heading">Rp. <span class="float-right ml-2" id="pajak_${title}_${type}_${value_type}_val_${type_pajak.split(" ").join("_").replace("%","")}">${pajak[type_pajak].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span></h4>
              </div>
            `);
                    } else {
                        pajak[type_pajak] += nilaiPajak;
                        var np = pajak[type_pajak].toString().split(".");
                        if(np.length > 1) {
                            if (np[1].toString().length > 2) {
                                np[1] = np[1].toString().substring(0, 2);
                                pajak[type_pajak] = parseFloat(np.join("."));
                            }
                        }
                        // console.log('Nilai Pajak '+type_pajak+' Bertambah Menjadi '+ pajak[type_pajak]);
                        $(`#pajak_${title}_${type}_${value_type}_val_${type_pajak.split(" ").join("_").replace("%","")}`).html(pajak[type_pajak].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                        // pajak[type_pajak].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                    }
                }
            }
            $(`#grand_total_${title}_${type}_${value_type}`).html(grandTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
            // console.log('Baris : '+rowIdx+' : '+type_pajak+' : '+val_pajak+' Nilai Pajak : '+nilaiPajak);
            //
            // (typeof val_pajak != 'undefined') ? val_pajak = val_pajak * $('input', cell_qty).val(): val_pajak = 0;
            // harga.push($('input', cell_harga).val().replace(/,/g, "") * $('input', cell_qty).val());
            //
            // ($(`#kena_pajak_${title}_${type}_${value_type}`).prop("checked") == true && typeof val_pajak != "undefined") ? pajak.push(($('input', cell_harga).val().replace(/,/g, "") * val_pajak / 100)): pajak.push(0);
            //
            // total = harga.reduce((a, b) => intVal(a) + intVal(b), 0);
            // ttl_pajak = pajak.reduce((a, b) => intVal(a) + intVal(b), 0);
            //
            // if ($(`#kena_pajak_${title}_${type}_${value_type}`).prop("checked") == true && type_pajak !== '') {
            //   // sum_harga = $('input', cell_harga).val().replace(/,/g, "") * $('input', cell_qty).val().replace(/,/g, "");
            //   // var pajak_operation = val_pajak / 100;
            //   // nilai_pajak += parseInt(pajak_operation) * parseInt(sum_harga);
            //   nilai_pajak = [];
            //   let obj = {};
            //   obj[type_pajak] = $('option:selected', cell_kode_pajak).attr('nilai');
            //   val_pajak_one.push(obj);
            //
            //   for (let p = 0; p < harga.length; p++) {
            //     //console.log(val_pajak_one[p]);
            //     if (val_pajak_one[p] !== undefined){
            //       if (val_pajak_one[p][type_pajak] !== undefined) {
            //         nilai_pajak[type_pajak] += (parseFloat(val_pajak_one[p][type_pajak]) / 100) * harga[p];
            //       }
            //     }else{
            //       nilai_pajak[type_pajak] = 0;
            //     }
            //   }
            //
            //   if (element === null) {
            //     $(`#bottom_table_${title}_${type}_${value_type}`).prepend(`
            //         <div class="alert alert-success mb-5 p-5 ml-5 mt-5 ${title}-pajak-box_${type}_${value_type}" role="alert" id="pajak_${title}_${type}_${type_pajak}_${value_type}">
            //           <strong>${type_pajak}</strong>
            //           <div class="border-bottom border-white opacity-20 mb-5"></div>
            //           <h4 class="alert-heading">Rp. <span class="float-right ml-2" id="pajak_${title}_${type}_${value_type}_val_${type_pajak}">${nilai_pajak[type_pajak].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span></h4>
            //         </div>
            //       `);
            //   }
            //   else {
            //     $(`#pajak_${title}_${type}_${value_type}_val_${type_pajak}`).html(nilai_pajak[type_pajak].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
            //   }
            // }
            //
            // if ($(`#dengan_pajak_${title}_${type}_${value_type}`).prop("checked") == true && $(`#kena_pajak_${title}_${type}_${value_type}`).prop("checked") == true) {
            //   let obj = {};
            //   obj[type_pajak] = $('option:selected', cell_kode_pajak).attr('nilai');
            //   val_pajak_second.push(obj);
            //   nilai_pajak = 0;
            //
            //   for (let p = 0; p < harga.length; p++) {
            //     if (val_pajak_second[p][type_pajak] != undefined) {
            //       let cek_nilai = harga[p] - harga[p] / ((parseFloat(val_pajak_second[p][type_pajak]) + 100) / 100);
            //       // console.log(cek_nilai);
            //       nilai_pajak += harga[p] - harga[p] / ((parseFloat(val_pajak_second[p][type_pajak]) + 100) / 100);
            //     }
            //   }
            //
            //   $(`#pajak_${title}_${type}_${value_type}_val`).html(nilai_pajak.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
            //   grand_total = intVal(total);
            //
            // } else {
            //   grand_total = intVal(total) + intVal(ttl_pajak);
            // }

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

        if (mode == 'faktur_penjualan') {
            add_page('penjualan_faktur_penjualan', 'penjualan/faktur-penjualan', 'Faktur Penjualan');
            add_content_tab('penjualan_faktur_penjualan', `edit_data_${id}`, `penjualan/faktur-penjualan/edit/${id}`, 'Edit Data', `${nomor}`)
        } else if (mode == 'faktur_pembelian') {
            add_page('pembelian_faktur_pembelian', 'pembelian/faktur-pembelian', 'Faktur Pembelian');
            add_content_tab('pembelian_faktur_pembelian', `edit_data_${id}`, `pembelian/faktur-pembelian/edit/${id}`, 'Edit Data', `${nomor}`)
        } else if (mode == 'hargajasa') {
            add_page('master_data_harga_jasa', 'master-data/harga-jasa', 'Harga Jasa');
            console.log(add_page);
            add_content_tab('master_data_harga_jasa', `edit_data_${id}`, `master-data/harga-jasa/edit/${id}`, 'Edit Data', `${nomor}`)
        } else if (mode == 'pengiriman_pesanan') {
            add_page('penjualan_pengiriman_pesanan', 'penjualan/pengiriman-pesanan', 'Pengiriman Pesanan');
            add_content_tab('penjualan_pengiriman_pesanan', `edit_data_${id}`, `penjualan/pengiriman-pesanan/edit/${id}`, 'Edit Data', `${nomor}`)
        } else if (mode == 'pengiriman_pembelian') {
            add_page('pembelian_pengiriman_pembelian', 'pembelian/pengiriman-pembelian', 'Pengiriman Pembelian');
            add_content_tab('pembelian_pengiriman_pembelian', `edit_data_${id}`, `pembelian/pengiriman-pembelian/edit/${id}`, 'Edit Data', `${nomor}`)
        } else if (mode == 'pesanan_penjualan') {
            add_page('penjualan_pesanan_penjualan', 'penjualan/pesanan-penjualan', 'Pesanan Penjualan')
            add_content_tab('penjualan_pesanan_penjualan', `edit_data_${id}`, `penjualan/pesanan-penjualan/edit/${id}`, 'Edit Data', `${nomor}`);
        } else if (mode == 'penawaran_penjualan') {
            add_page('penjualan_penawaran_penjualan', 'penjualan/penawaran-penjualan', 'Penawaran Penjualan');
            add_content_tab('penjualan_penawaran_penjualan', `edit_data_${id}`, `penjualan/penawaran-penjualan/edit/${id}`, 'Edit Data', `${nomor}`)
        } else if (mode == 'permintaan_pembelian') {
            add_page('pembelian_permintaan_pembelian', 'pembelian/permintaan-pembelian', 'Permintaan Pembelian');
            add_content_tab('pembelian_permintaan_pembelian', `edit_data_${id}`, `pembelian/permintaan-pembelian/edit/${id}`, 'Edit Data', `${nomor}`)
        } else if (mode == 'pesanan_pembelian') {
            add_page('pembelian_pesanan_pembelian', 'pembelian/pesanan-pembelian', 'Pesanan Pembelian');
            add_content_tab('pembelian_pesanan_pembelian', `edit_data_${id}`, `pembelian/pesanan-pembelian/edit/${id}`, 'Edit Data', `${nomor}`)
        }
    }

    this.addrowDetailPengirimanSubTable = function (mode, table, data) {
        // console.log(mode)
        // console.log(table)
        // console.log(data)
        // var dataSelect = `<select class="form-control selectpicker" data-size="7" data-live-search="true" title="Pilih" data-toggle="ajax" data-container="body"></select>`;
        if (mode == 'barang') {
            $(`#${table}`).DataTable().row.add([
                null,
                null,
                `<select class="form-control selectpicker" data-size="7" data-live-search="true" title="Pilih" data-toggle="ajax" data-container="body"></select>`,
                `<input type="number" class="form-control" value="0">`,
                `<input type="number" class="form-control" value="0">`,
                `<input type="number" class="form-control" value="0">`,
                `<input type="text" class="form-control">`,
                `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="deleteBarang">
        <i class="fas fa-trash text-danger"></i>
      </a>`
            ]).draw();
        } else {
            $(`#${table}`).DataTable().row.add([
                null,
                null,
                `<select class="form-control selectpicker transSelect" data-size="7" data-live-search="true" title="Pilih" data-toggle="ajax" data-container="body"></select>`,
                `<input type="text" class="form-control" readonly value="">`,
                `<input type="text" class="form-control" >`,
                `<input type="text" class="form-control" >`,
                `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="deleteTrans">
        <i class="fas fa-trash text-danger"></i>
      </a>`
            ]).draw();
        }

        $.each(data, function (indexInArray, valueOfElement) {
            $('.selectpicker').append(`<option value="${valueOfElement['id']}">${valueOfElement['keterangan']}</option>`)
        });
        $('.selectpicker').selectpicker();

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
                _this.addModalBarang(thisElement, _this.element.barangForShip.url, _this.element.barangForShip.dataAdditional, _this.element.previousTransaction.idPemasok, _this.element.store.mainTab,_this.element.barangForShip.tanggal,_this.element.barangForShip.nomor);
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
                    } else if (params.status == 'previousTransactions') {

                        $.ajax({
                            type: "POST",
                            timeout: 50000,
                            url: host + '/' + params.url,
                            async: true,
                            data: {
                                id_detail: data['id']
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
                                var nomorPengirimanDt = [];
                                var tanda_kemasanDt = [];
                                var nomor_segelDt = [];
                                var paketDt = [];
                                var asal_textDt = [];
                                var tujuan_textDt = [];
                                var asal_valueDt = [];
                                var tujuan_valueDt = [];
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
                                                'tujuan_text': tujuan_textDt[key]
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

                                    // console.log('tipe' + value['harga_jasa_id']['tipe']);
                                    // console.log('nomor seri' + value['harga_jasa_id']['menggunakan_nomor_seri']);
                                    // console.log('type ' + params.var['typeSubData'])

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
                                        asal = value['harga_jasa_id']['asal_id']['provinsi'] + ' , ' + value['harga_jasa_id']['asal_id']['kabupaten'] + ' , ' + value['harga_jasa_id']['asal_id']['kecamatan'] + ' , ' + value['harga_jasa_id']['asal_id']['kelurahan'] + ', ' + value['harga_jasa_id']['asal_id']['kodepos']
                                    }

                                    if (value['harga_jasa_id']['tujuan_id'] != null) {
                                        tujuan = value['harga_jasa_id']['tujuan_id']['provinsi'] + ' , ' + value['harga_jasa_id']['tujuan_id']['kabupaten'] + ' , ' + value['harga_jasa_id']['tujuan_id']['kecamatan'] + ' , ' + value['harga_jasa_id']['tujuan_id']['kelurahan'] + ', ' + value['harga_jasa_id']['tujuan_id']['kodepos']
                                    }

                                    if (value['harga_jasa_id']['tipe'] == 3 && value['harga_jasa_id']['menggunakan_nomor_seri'] == null && params.var['typeSubData'] == 'generalPembelian') {
                                        // console.log('sdfs');
                                        cellAction = `<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="flaticon2-plus mr-n1"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                    </a>`;
                                        $('#penerima').css('display', 'block');
                                    }

                                    if (value['harga_jasa_id']['tipe'] == 1 && params.var['typeSubData'] == 'generalPembelian') {
                                        cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                    <i class="fas fa-trash text-danger"></i>
                  </a>`;
                                        $('body .formGudang').css('display', 'block');
                                        $('body .formGudang').attr('data-id', 'gudangValidate')
                                    }


                                    if (value['harga_jasa_id']['tipe'] == 3 && params.var['typeSubData'] == 'general') {
                                        cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                    </a>`;
                                        $('#penerima').css('display', 'block');
                                    }


                                    if (value['harga_jasa_id']['tipe'] == 3 && value['harga_jasa_id']['menggunakan_nomor_seri'] == null && params.var['typeSubData'] == 'general') {
                                        cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                        <i class="fas fa-trash text-danger"></i>
                      </a>`;
                                        $('#penerima').css('display', 'block');
                                    }

                                    if (value['harga_jasa_id']['tipe'] == 3 && value['harga_jasa_id']['menggunakan_nomor_seri'] == null && params.var['typeSubData'] == 'barang') {
                                        cellAction = `<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="flaticon2-plus mr-n1"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                    </a>`;
                                        $('#penerima').css('display', 'block');
                                    }

                                    if (value['harga_jasa_id']['tipe'] == 3 && value['harga_jasa_id']['menggunakan_nomor_seri'] == null && params.var['typeSubData'] == 'nomorSeri') {
                                        cellAction = `<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="flaticon2-plus mr-n1"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                    </a>`;
                                        $('#penerima').css('display', 'block');
                                    }

                                    if (value['harga_jasa_id']['tipe'] == 3 && params.var['typeSubData'] == 'detailPengiriman') {
                                        cellAction = `<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="flaticon2-plus mr-n1"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                    </a>`;
                                        $('#penerima').css('display', 'block');
                                    }

                                    if (value['harga_jasa_id']['tipe'] == 1 && value['harga_jasa_id']['menggunakan_nomor_seri'] == 1 && params.var['typeSubData'] == 'general') {
                                        cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                    </a>`;
                                        $('body .formGudang').css('display', 'block');
                                        $('body .formGudang').attr('data-id', 'gudangValidate');
                                    }

                                    if (value['harga_jasa_id']['tipe'] == 1 && params.var['typeSubData'] == 'detailPengiriman') {
                                        if (value['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
                                            cellAction = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                        <i class="fas fa-trash text-danger"></i>
                      </a>`;
                                            $('body .formGudang').css('display', 'block');
                                            $('body .formGudang').attr('data-id', 'gudangValidate')
                                        } else {
                                            cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                        <i class="fas fa-trash text-danger"></i>
                      </a>`;
                                        }
                                    }

                                    if (value['harga_jasa_id']['tipe'] == 1 && params.var['typeSubData'] == 'nomorSeri') {
                                        if (value['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
                                            cellAction = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                    </a>`;
                                        } else {
                                            cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                    </a>`;
                                        }

                                        $('body .formGudang').css('display', 'block');
                                        $('body .formGudang').attr('data-id', 'gudangValidate')
                                    }

                                    if (value['harga_jasa_id']['tipe'] == 1) {
                                        if (value['harga_jasa_id']['menggunakan_nomor_seri'] == 1) {
                                            cellAction = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                    </a>`;
                                        } else {
                                            cellAction = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
                      <i class="fas fa-trash text-danger"></i>
                    </a>`;
                                        }
                                        $('body .formGudang').css('display', 'block');
                                        $('body .formGudang').attr('data-id', 'gudangValidate')
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
                                        } else {
                                            if (value['harga'] != null || value['harga'] != undefined) {
                                                rowHargaValue = value['harga'];
                                            } else {
                                                rowHargaValue = 0;
                                            }

                                        }

                                        // console.log('ini optional : ' + params.var['elementOptional']);

                                        if (params.var['elementOptional'] == 'faktur_penjualan') {

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

                                            if (value['detail_sn']['length'] > 0) {
                                                $.each(value['detail_sn'], function (t, v) {
                                                    columnShippingStok.push(v.nomor_seri);
                                                    stokTerpakai[key] = v.nomor_seri;
                                                });
                                            }

                                            // console.log(stokTerpakai);


                                            if (value['harga_jasa_id']['stok_tersedia']['length'] > 0) {
                                                $.each(value['harga_jasa_id']['stok_tersedia'], function (indexInArray, valueOfElement) {
                                                    columnShippingStok.push(valueOfElement.nomor_seri);
                                                });
                                            } else {
                                                columnShippingStok = null;
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

                                            // console.log(row_second);

                                            $(params.var['hargaJasaTable']).DataTable().row.add([
                                                value['harga_jasa_id']['tipe'],
                                                null,
                                                row_second,
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
                                        } else if (params.var['elementOptional'] == 'faktur_pembelian') {

                                            let permintaan_pembelian = '';
                                            let pesanan_pembelian = '';
                                            let pengiriman_pembelian = '';
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

                                            if (value.pengiriman_pembelian_header_id != null) {
                                                pengiriman_pembelian = `<a href="#" onclick="showModule('pengiriman_pembelian','${value.pengiriman_pembelian_header_id['id']}','${value.pengiriman_pembelian_header_id['nomor']}')"><u>${value.pengiriman_pembelian_header_id['nomor']}</u></a>`;
                                            } else {
                                                pengiriman_pembelian = '-';
                                            }



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
                                                `${permintaan_pembelian}`,
                                                `${pesanan_pembelian}`,
                                                `${pengiriman_pembelian}`
                                            ]).draw();
                                        } else if (params.var['elementOptional'] == 'pengiriman_pembelian') {

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
                                        } else {

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
                                    } else if (params.var['typeData'] == 'shippingStok') {

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
                                    } else {

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

                                _this.tampungBarang(detail_pengiriman);

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

                    } else if (params.status == 'showPiutang') {
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
                                            `<input type="text" class="form-control harga" id="${nominal}" value="0" placeholder="0""/>`,
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
                    } else if (params.status == 'showHutang') {
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
                                        nominal = "nominal" + value.faktur_pembelian_header_id['id'];
                                        $(`#${params.var['table']}`).DataTable().row.add([
                                            null,
                                            null,
                                            null,
                                            null,
                                            null,
                                            null,
                                            `<input type="number" value="` + value.faktur_pembelian_header_id['id'] + `">`,
                                            `<a href="#" onclick="showModule('faktur_pembelian','${value.faktur_pembelian_header_id['id']}','${value.faktur_pembelian_header_id['nomor']}')"><u>${value.faktur_pembelian_header_id['nomor']}</u></a>`,
                                            `<input type="text" class="form-control nominal nominal_bayar${indexs}" id="${nominal}" value="0" placeholder="0" min="1"/>`,
                                            `<input type="text" class="form-control nominal" readonly value="${value.sisa_hutang}">`,
                                            value.nominal_faktur_pembelian,
                                            value.nominal_faktur_pembelian_uang_muka
                                        ]).draw();
                                        indexs++;
                                        price_format_class('nominal');
                                        faktur[value.faktur_pembelian_header_id['id']] = value.nominal_faktur_pembelian;
                                        uang_muka[value.faktur_pembelian_header_id['id']] = value.nominal_faktur_pembelian_uang_muka;
                                        sisa_utang_awal[value.faktur_pembelian_header_id['id']] = value.sisa_hutang;
                                        pembayaran_awal[value.faktur_pembelian_header_id['id']] = value.nominal_pembayaran_pembelian;

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

                    } else if (params.status == 'ModuleStore') {

                        $.ajax({
                            type: "POST",
                            timeout: 50000,
                            url: host + '/' + params.url,
                            data: $(`${params.form}`).serialize(),
                            success: function (res) {
                                console.log(res);
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
                    } else if (params.status == 'barangJasa') {
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
                    } else if (params.status == 'indexAjaxList') {

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

                                $('input', this).on('keypress', function (e) {
                                    if (e.which == 13) {

                                        tabelIndex
                                            .column(i)
                                            .search(this.value)
                                            .draw();
                                    }
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

                                $('input', this).on('keypress', function (e) {
                                    if (e.which == 13) {
                                        tabelIndex
                                            .column(i)
                                            .search(this.value)
                                            .draw();
                                    }
                                });
                            });
                        }



                        var tabelIndex = $(`#${params.content.table}`).DataTable({
                            orderCellsTop: true,
                            fixedHeader: true,
                            dom: "Btpir",
                            buttons: [
                                'excelHtml5',
                                'pdfHtml5'
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
                                [10, 20, 50, 100],
                                [10, 20, 50, 100]
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

                    } else if (params.status == 'filterTanggal') {


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

                            $('input', this).on('keypress', function (e) {
                                if (e.which == 13) {
                                    tabelIndex
                                        .column(i)
                                        .search(this.value)
                                        .draw();
                                }
                            });
                        });

                        var tabelIndex = $(`#${params.content.table}`).DataTable({
                            orderCellsTop: true,
                            fixedHeader: true,
                            dom: "tpir",
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
                                [10, 20, 50, 100],
                                [10, 20, 50, 100]
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

                    } else if (params.status == 'getTipePengiriman') {

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
                    } else if (params.status == 'printDO') {
                        $.ajax({
                            type: "GET",
                            timeout: 50000,
                            url: params.url,
                            data: params.data,
                            async: true,
                            success: function (res) {
                                console.log(res)
                            },
                            error: function (res, textstatus) {

                            }
                        });
                    } else if (params.status == 'returList_') {
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
                            // console.log(response);

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
        // console.log(data.params);
        if (data.status != 'after_search') {
            table = this.ajaxGroup(data.params);
        } else {
            table = data.table;
        }

        // console.log(table);

        for (let index = 1; index <= data.count; index++) {
            // console.log(`${data.classCheck}_${index}`);
            $(`#${data.classCheck}_${index}`).prop('checked', true);
        }

        // console.log(data)

        $.each(data.columnIndex, function (indexInArray, valueOfElement) {
            // console.log(`${data.classCheck}_${valueOfElement}`);
            $(`#${data.classCheck}_${valueOfElement}`).prop('checked', false);
            table.column(valueOfElement).visible(false);
        });
    }

    this.columnshowHideDinamically = function (table, cols, id) {

        var colCount = $(`#${table}`).DataTable().columns().header().length;
        var table = $(`#${table}`).DataTable();
        if ($(`#${id+'_'+cols}`).prop('checked') != false) {
            table.column(cols).visible(true);
        } else {
            table.column(cols).visible(false);
        }
        // for (let index = 1; index < colCount; index++) {
        //   if (jQuery.inArray(index.toString(), cols) != -1) {
        //       console.log("ini nol yah :"+index)
        //       // columnss.visible(false);
        //       table.column(index).visible(false);
        //   } else {
        //       console.log("ini mines yah :"+index)
        //       table.column(index).visible(true);
        //   }
        // }
    }

}

showModule = (mode, id, nomor) => {
    var transaksi = new transaksiInit;
    // console.log(mode)
    // console.log(id)
    // console.log(nomor)
    transaksi.redirectToModule(mode, id, nomor);
}

page_print_delivery = (link) => {

    // console.log(link);
    // $.ajaxSetup({
    //   headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //   }
    // });

    // let element = document.getElementById(`tab_${id}_${type}`);
    // $.ajax({
    //   type: method,
    //   timeout: 50000,
    //   url: host + '/' + link,
    //   async: true,
    //   data: {
    //     'result': result
    //   },
    //   success: function (res) {
    //     if (element !== null) {
    //       $(`#tab_${id}_${type}`).tab('show');
    //       return false;
    //     } else {
    //       document.getElementById(`content_tabs_${id}`).innerHTML +=
    //         `<li class="nav-item" id="content_tab_${id}_${type}">` +
    //         `<a class="nav-link" id="tab_${id}_${type}" data-toggle="tab" href="#${id}_${type}"><span class="nav-text">${page}` +
    //         `<i class="ki ki-close icon-xs text-danger ml-3" onclick="close_content_tab('${id}','${type}')"></i>` +
    //         '</li>';
    //       $(res).appendTo(`#content_data_${id}`);
    //       $(`#tab_${id}_${type}`).tab('show');
    //       return false;
    //     }
    //   },
    //   error: function (res, textstatus) {
    //     if (textstatus === "timeout") {
    //       notice("Response Time Out", 'error');
    //     } else {
    //       notice(res.responseJSON.message, 'error');
    //     }
    //   }
    // });
}