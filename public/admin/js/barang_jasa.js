var number = 1;
var key = [];
var result;
var host = $('meta[name="host_url"]').attr('content');
function DatatableBuilderHargaJasa(table) {

  this.tableData =  $(`#${table}`).DataTable({
           dom: 't',
           pageLength: -1,
           autoWidth : false,
           language: {
             "lengthMenu": " _MENU_ ",
             "zeroRecords": "Belum ada data",
           },
           order: [],
           columnDefs: [
             {
               "defaultContent": "-",
               sClass: 'text-center',
               "targets": "_all"
             },
             {
               targets : 0,
               visible : false,
             },
             {
               targets:1,
               width : "50%",
             },
           ],
    });
 
 }

 function DatatablestokBarang(table) {
  $(`#${table}`).DataTable().destroy()
  $(`#${table}`).DataTable({
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
  });

}


function barangJasa() {
  
    this.addRowHargaPembelian = function(tabel,pemasok,target) {
      console.log(tabel);
     var html = '';
      $.each(pemasok, function (indexInArray, valueOfElement) { 
         html+= '<option value="'+indexInArray+'">'+valueOfElement+'</option>';
      });
      tabel.tableData.row.add([
        null,
        '<select name="pemasok_id[]" class="form-control selectpicker" title="Pilih Pemasok" data-size="7" data-live-search="true" id="pemasok_id" data-toggle="ajax" data-container="body">'+html+'</select>',
        `<input class="form-control harga_pembelian_barang" name="harga_pembelian[]" type="text" id="harga">`,
        `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="${target}">
        <span class="svg-icon svg-icon-md">
                <i class="flaticon2-trash text-danger"></i>
        </span>
        </a>`
      ]).draw();
      price_format_class('harga_pembelian_barang');
      $('.selectpicker').selectpicker();

    };
  
  
    this.addRowHargaPenjualan = function (tabel,pelanggan,tipe_pengiriman,jenis_barang,target,mode) {
      console.log(tabel);
      let counter = '';
      var htmlSelectPelanggan = '';
      var htmlSelectTipePengiriman = '';
      var htmlSelectJenisBarang = '';

      if (mode != 'add') {
          counter = tabel.tableData.rows().count() + 1;
      }else{
          counter =  number++;
      }
  
      $.each(pelanggan, function (indexInArray, valueOfElement) { 
         htmlSelectPelanggan += '<option value="'+indexInArray+'">'+valueOfElement+'</option>';
      });
  
      $.each(tipe_pengiriman, function (indexInArray, valueOfElement) { 
         htmlSelectTipePengiriman += '<option value="'+indexInArray+'">'+valueOfElement+'</option>';
      });
  
      $.each(jenis_barang, function (indexInArray, valueOfElement) { 
         htmlSelectJenisBarang += '<option value="'+indexInArray+'">'+valueOfElement+'</option>';
      });
  
      tabel.tableData.row.add([
      null,
      '<select name="pelanggan_id[]" class="form-control selectpicker pelanggan_penjualan'+counter+'" title="Pilih Pemasok" data-size="7" data-live-search="true" id="pelanggan_id" data-toggle="ajax" data-container="body" data-action="'+counter+'">'+htmlSelectPelanggan+'</select>',
      '<select name="jenis_barang_id[]" class="form-control selectpicker" title="Pilih Jenis Barang" data-size="7" data-live-search="true" id="jenis_barang" data-toggle="ajax" data-container="body">'+htmlSelectJenisBarang+'</select>',
      '<select name="tipe_pengiriman_id[]" class="form-control selectpicker" title="Pilih Tipe Pengiriman" data-size="7" data-live-search="true" id="tipe_pengiriman_id" data-toggle="ajax" data-container="body">'+htmlSelectTipePengiriman+'</select>',
      `<div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><i class="icon-sm fas fa-percent"></i></span></div><input type="number" id="persen" name="opsi[]" class="form-control"></div>`,
        `<input type="text" name="harga_penjualan[]"  class="form-control harga_penjualan_for_bj">`,
        `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="${target}">
        <span class="svg-icon svg-icon-md">
                <i class="flaticon2-trash text-danger"></i>
        </span>
        </a>`
      ]).draw();
      price_format_class('harga_penjualan_for_bj');
      $('.selectpicker').selectpicker();

    }

    this.addRowKolom = function (tabel,target) {
        tabel.tableData.row.add([
            null,
            `<input type="text" name="kode_kolom[]" class="form-control">`,
            `<input type="text" name="keterangan_kolom[]" class="form-control">`,
            `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="${target}">
            <span class="svg-icon svg-icon-md">
                    <i class="flaticon2-trash text-danger"></i>
            </span>
            </a>`
        ]).draw();
    }

    this.AddRowKomisi = function (tabel,target) {
        tabel.tableData.row.add([
            null,
            `<input type="text" class="form-control">`,
            `<input type="text" class="form-control">`,
            `<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="${target}">
            <span class="svg-icon svg-icon-md">
                    <i class="flaticon2-trash text-danger"></i>
            </span>
            </a>`
          ]).draw();
    }

    this.AddRowPenjualanTotal = function (tabel,data_action,text_pelanggan,id_pelanggan) {
        console.log(tabel)
        console.log(data_action)
        console.log(text_pelanggan)
        console.log(id_pelanggan)
        
        var tablePenjualatanTotal =  tabel.tableData.row.add([
            id_pelanggan,
            `<span id="text_pelanggan_${data_action}">${text_pelanggan}</span>`,
            `<span id="total_harga_penjualan${id_pelanggan}">0</span>`,
            `<a href="javascript:;" id="informasi_penjualan_show" data-action="${id_pelanggan}" class="btn btn-sm btn-clean btn-icon" title="Detail"><span class="svg-icon svg-icon-md"><i class="text-primary flaticon-edit-1"></i></span></a>`
        ]).draw().node();
        $(tablePenjualatanTotal).attr('id',`detail${data_action}`);
    }

    this.DataTableGetDetailPenjualan = function (tabel) {
      var data = tabel.rows().data().toArray();
      if (data.length > 0) {
        result = {
          data
        }
        notice('Detail Penjualan berhasil di Salin', 'success');
      }else{
        notice('Detail Penjualan Kosong', 'warning');
      }
    }

    this.DataTablePaste = function (tabel) {
      console.log(result);
      if (result !== undefined) {
        if (result.data['length'] > 0 ) {
          console.log(result.data);
          $.each(result.data, function (indexInArray, valueOfElement) { 
            var harga = parseInt(valueOfElement[6]);
            console.log(harga);
            tabel.row.add([
              valueOfElement[0],
              valueOfElement[1],
              valueOfElement[2],
              valueOfElement[3],
              valueOfElement[4],
              valueOfElement[5],
              valueOfElement[6],
              harga,
              null
            ]).draw().node();
          });
          notice('Detail Penjualan berhasil di Tambah', 'success');
        }else{
          notice('Data Kosong', 'warning');
        }
      }else{
        notice('Data Kosong', 'warning');
      }
      console.log(result);
    }

  }
