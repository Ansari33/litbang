var pageAct = '';
var tabAct  = '';
var modulAct = '';

const add_page = (id, link, page) => {
  //cek();
  "use strict";
  let element = document.getElementById(`tab_${id}`);
  $.ajax({
    type: "GET",
    timeout: 50000,
    url: link,
    async: true,
    beforeSend : function () {
     status = true; 
     // console.log(status)
  },
    success: function (res) {


      if (element !== null) {
        $(`#tab_${id}`).tab('show');
        return false;
      } else {
        document.getElementById("menu_tab").innerHTML +=
          `<li role="presentation" class="nav-item mr-2" id="li_main_tab_${id}">` +
          `<a class="nav-link" id="tab_${id}" data-toggle="tab" role="tab" href="#${id}"><span class="nav-text">${page}` +
          `<button class="btn btn-xs tab-close btn-icon btn-light btn-hover-danger ml-4" onclick="close_main_tabs('${id}')">` +
          `<i class="ki ki-close icon-xs text-muted"></i></button>` +
          '</li>';
        $(res).appendTo('#page_content');
        $(`#tab_${id}`).tab('show');
        $('#menu_tab').scrollingTabs('refresh');
        pageAct = page.replaceAll(" ","");
        $(`#tab_${id}`).on( "click", function() {
          pageAct = page.replaceAll(" ","");
        });
        $(`#tab_${id}`).on( "mouseenter", function() {
          pageAct = page.replaceAll(" ","");
        });
        $(`#${id}`).on( "click", function() {
          pageAct = page.replaceAll(" ","");
        });
        $(`#${id}`).on( "mouseenter", function() {
          pageAct = page.replaceAll(" ","");
        });
        return false;
      }

    },
    error: function (res, event, xhr, textstatus, exception) {
      // console.log(xhr);
      if (textstatus === "timeout") {
        notice("Response Time Out", 'error');
      } else if (textstatus == "Not Found") {
        notice("Not Found", 'error');
      } else {
        notice(res.responseJSON.message, 'error');
      }
    }
  })
}

const close_main_tabs = (id) => {
  $(`#li_main_tab_${id}`).remove();
  $(`.main_tab_content_${id}`).remove();
  $('#menu_tab a:eq(-1)').tab('show');
  $('#menu_tab').scrollingTabs('refresh');
}

const add_content_tab = (id, type, link, page, data = '', method = 'GET') => {

  let element = document.getElementById(`tab_${id}_${type}`);

  $.ajax({
    type: method,
    timeout: 50000,
    url: link,
    async: true,
    success: function (res) {
      if (element !== null) {
        $(`#tab_${id}_${type}`).tab('show');
        return false;
      } else {
        document.getElementById(`content_tabs_${id}`).innerHTML +=
          `<li class="nav-item" id="content_tab_${id}_${type}">` +
          `<a class="nav-link" id="tab_${id}_${type}" data-toggle="tab" href="#${id}_${type}"><span class="nav-text">${page} ${data}` +
          `<i class="ki ki-close icon-xs text-danger ml-3" onclick="close_content_tab('${id}','${type}')"></i>` +
          '</li>';
        $(res).appendTo(`#content_data_${id}`);
        $(`#tab_${id}_${type}`).tab('show');
        tabAct = (page+data).replaceAll(" ","");
        modulAct = getActiveTab();
        $(`#tab_${id}_${type}`).on( "click", function() {
          tabAct = (page+data).replaceAll(" ","");
          modulAct = getActiveTab();
        });
        $(`#tab_${id}_${type}`).on( "mouseenter", function() {
          tabAct = (page+data).replaceAll(" ","");
          modulAct = getActiveTab();
        });
        $(`#${id}_${type}`).on( "click", function() {
          tabAct = (page+data).replaceAll(" ","");
          modulAct = getActiveTab();
        });
        $(`#${id}_${type}`).on( "mouseenter", function() {
          tabAct = (page+data).replaceAll(" ","");
          modulAct = getActiveTab();
        });

        return false;
      }
    },
    error: function (res, textstatus) {
      if (textstatus === "timeout") {
        notice("Response Time Out", 'error');
      } else {
        notice(res.responseJSON.message, 'error');
      }
    }
  });
}

const close_content_tab = (id, type) => {
  // console.log('tes2');
  $(`#content_tab_${id}_${type}`).remove();
  $(`.content_data_${id}_${type}`).remove();
  $(`#content_tabs_${id} a:eq(-1)`).tab('show');
}

const notice = (message, type) => {
  if(type == 'error') {
    type = 'danger';
    delay = 20000;
  } else {
    delay = 5000;
  }
  (message === '') ? message = 'Error':message=message;
  $.notify({
    message: message
  },{
    type: type,
    animate: {enter: 'animate__animated animate__slideInDown', exit: 'animate__animated animate__slideOutRight'},
    newest_on_top: true,
    delay: delay,
    timer: 500,
    spacing: 10,
    offset: 30,
    z_index : 10000
  });
  // swal.fire({
  //   text: message,
  //   icon: type,
  //   buttonsStyling: false,
  //   confirmButtonText: "Ok, got it!",
  //   customClass: {
  //     confirmButton: "btn font-weight-bold btn-light-primary"
  //   }
  // });
}

const modal_lokasi = (name, input_id) => {
  var data = {
    'name': name,
    'input_id': input_id
  };
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type: "POST",
    timeout: 50000,
    data: data,
    async: true,
    url: 'master-data/lokasi/get-lokasi',
    success: function (res) {
      $('#modal_lokasi .modal-dialog').html(res);
      $('#modal_lokasi').modal('show');
    },
    error: function (res, textstatus) {
      KTUtil.btnRelease(btn_save);
      if (textstatus === "timeout") {
        notice('Response Time Out.', 'error');
      } else {
        notice(res.responseJSON.message, 'error');
      }
    }
  });
}

const reload_table = (table) => {
  $(`#${table}`).DataTable().ajax.reload();
}

destroy = (id, val, url, table) => {
  // console.log(url)
  // console.log(id);
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-light-danger',
      cancelButton: 'btn btn-light-dark'
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: 'Apakah anda yakin menghapus data '+ val +' ?',
    text: "Kemungkinan data tidak dapat dikembalikan setelah dihapus!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: 'Ya, Saya Yakin!',
  }).then(function(result) {
    if (result.value) {
      $.ajax({
        type:"GET",
        async: true,
        url: `${url}/delete/${id}`,
        success: function(res){
        //  console.log(res);
          Swal.fire('Berhasil!', res, 'success');
          reload_table(table);
        },
        error: function(res, textstatus){
          if (textstatus === "timeout") {
            notice('Response Time Out.', 'error');
          } else {
            notice(res.responseJSON.message, 'error');
          }
        }
      })
    }
  })
}

const price_format = (input) => {
  $(`#${input}`).priceFormat(
    {
    prefix: '',
    centsLimit:0,
    allowNegative: true
  });
}

const price_format_class = (input) => {
  
  $(`.${input}`).priceFormat(
    {
    prefix: '',
    centsLimit:0,
    allowNegative: true
  });
}

const show_add_jadwal_pengiriman = (table, modal) => {
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type: "POST",
    timeout: 50000,
    url: 'master-data/jadwal-pengiriman/modal-add',
    async: true,
    data: {'table': table, 'modal' : modal},
    success: function (res) {
      $(`#${modal} .modal-dialog`).html('');
      $(`#${modal} .modal-dialog`).html(res);
      $(`#${modal}`).modal('show');
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
const price_to_number = (string) => {
        var isi_nomor = new String(string).split(",");
        var result="";
        for (var i = 0; i < isi_nomor.length; i++) {
           result = result+isi_nomor[i].toString()+"";
        }
        return parseInt(result);
    }
    
    // setting_column = (id,type,table,modul) =>{
    //   if (type == 'add') {
    //     calculate(`${table}`, `${type}`,`${modul}`,'7','6','8',`${modul}`);
    //   }else{
    //     calculate(`${table}`, 'edit',`${id}`,'7','6','8',`${modul}`)
    //   }
    // } 

    // const calculate = (table, type,value_type,row_pajak,row_qty,row_harga,title) => {

    //   console.log(table);

    //   var harga = [], pajak = [];
    //   var intVal = function ( i ) {
    //     return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
    //   };
    //   $(`.${title}-pajak-box_${type}_${value_type}`).remove();
      
    //   $(`#${table}`).DataTable().rows().every( function ( rowIdx, tableLoop, rowLoop ) {
    //     var cell_kode_pajak = $(`#${table}`).DataTable().cell({ row: rowIdx, column: row_pajak }).node();
    //     var cell_harga = $(`#${table}`).DataTable().cell({ row: rowIdx, column: row_harga }).node();
    //     var cell_qty = $(`#${table}`).DataTable().cell({ row: rowIdx, column: row_qty }).node();
    //     var val_pajak = $('option:selected', cell_kode_pajak).attr('nilai');
    //     var type_pajak = $('option:selected', cell_kode_pajak).text();
    //     let element = document.getElementById(`pajak_${title}_${type}_${type_pajak}_${value_type}`);
    //     if ($(`#kena_pajak_${title}_${type}_${value_type}`).prop("checked") == true && type_pajak !== '') {
    //       var sum_harga = $('input', cell_harga).val().replace(/,/g, "") * $('input', cell_qty).val().replace(/,/g, "");
          
    //       var pajak_operation = val_pajak/100;
    //       var nilai_pajak = pajak_operation * sum_harga;
    //       if(element === null) {
    //         $(`#bottom_table_${title}_${type}_${value_type}`).prepend(`
    //         <div class="alert alert-success mb-5 p-5 ml-5 mt-5 ${title}-pajak-box_${type}_${value_type}" role="alert" id="pajak_${title}_${type}_${type_pajak}_${value_type}">
    //           <strong>${type_pajak}</strong>
    //           <div class="border-bottom border-white opacity-20 mb-5"></div>
    //           <h4 class="alert-heading">Rp. <span class="float-right ml-2" id="pajak_${title}_${type}_${type_pajak}_${value_type}_val">${nilai_pajak.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span></h4>
    //         </div>
    //       `);
    //       } else {
    //         nilai_pajak = intVal($(`#pajak_${title}_${type}_${type_pajak}_${value_type}_val`).html()) + intVal(nilai_pajak);
    //         $(`#pajak_${title}_${type}_${type_pajak}_${value_type}_val`).html(nilai_pajak.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
    //       }
    //   }
      
    //     (typeof val_pajak != 'undefined') ? val_pajak = val_pajak * $('input', cell_qty).val() : val_pajak = 0;
    //     harga.push($('input', cell_harga).val().replace(/,/g, "") * $('input', cell_qty).val());
    //     ($(`#kena_pajak_${title}_${type}_${value_type}`).prop("checked") == true && typeof val_pajak != "undefined")? pajak.push(($('input', cell_harga).val().replace(/,/g, "") * val_pajak/100)): pajak.push(0);
      
    //   });
      
    //   total = harga.reduce((a, b) => intVal(a) + intVal(b), 0);
    //   ttl_pajak = pajak.reduce((a, b) => intVal(a) + intVal(b), 0);
      
    //   if ($(`#dengan_pajak_${title}_${type}_${value_type}`).prop("checked") == true && $(`#kena_pajak_${title}_${type}_${value_type}`).prop("checked") == true){
    //     grand_total = intVal(total);
    //   } else {
    //     grand_total = intVal(total) + intVal(ttl_pajak);
    //   }
      
    //   $(`#grand_total_${title}_${type}_${value_type}`).html(grand_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
    // }

    // const show_log_activity = (transaksi,id,modal,url) => {
    //   //console.log(url);
    //   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    //   $.ajax({
    //     type: "POST",
    //     timeout: 50000,
    //    // url: 'pengaturan/logs',
    //     url: url,
    //     async: true,
    //     data: {'transaksi': transaksi, 'id' : id},
    //     success: function (res) {
    //      // console.log(res);
    //       $(`#${modal} .modal-dialog`).html('');
    //       $(`#${modal} .modal-dialog`).html(res);
    //       $(`#${modal}`).modal('show');
    //     },
    //     error: function (res, textstatus) {
    //       if (textstatus === "timeout") {
    //         notice('Response Time Out', 'error');
    //       } else {
    //         notice(res.responseJSON.message, 'error');
    //       }
    //     }
    //   });
    // }

const getActiveTab = () => {
  return (pageAct+tabAct).replaceAll(" ","");
}
