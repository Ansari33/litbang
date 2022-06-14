SERVER_API = "http://localhost:8000/";

if(data.tipe == 3 && subType == 'bukanBarang'){
    actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
    <i class="fas fa-trash text-danger"></i>
  </a>`;
} 

if (data.tipe == 1 && data['menggunakan_nomor_seri'] == 1 && subType == 'bukanBarang') {
  actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
  <i class="fas fa-trash text-danger"></i>
</a>`;
$('body .formGudang').css('display','block');
$('body .formGudang').attr('data-id','gudangValidate')
}

if (data.tipe == 1 && data['menggunakan_nomor_seri'] == null) {
  actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
  <i class="fas fa-trash text-danger"></i>
</a>`;
}

if(data.tipe == 3 && subType == 'nomorSeri'){
  actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
  <i class="fas fa-trash text-danger"></i>
</a>`;
}

if (data.tipe == 1 && data['menggunakan_nomor_seri'] == 1 && subType == 'nomorSeri') {
  actionCell = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
  <i class="fas fa-trash text-danger"></i>
</a>`;

$('body .formGudang').css('display','block');
$('body .formGudang').attr('data-id','gudangValidate')
}

if (data.tipe == 1 && data['menggunakan_nomor_seri'] == 0 && subType == 'nomorSeri') {
  actionCell = `<a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
  <i class="fas fa-trash text-danger"></i>
</a>`;
$('body .formGudang').css('display','block');
$('body .formGudang').attr('data-id','gudangValidate')
}

if (data.tipe == 1 && data['menggunakan_nomor_seri'] == 1 && subType == 'denganBarang') {

actionCell = `<a href="javascript:void(0)" id="serialNumber" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class=" fas fa-box-open"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
<i class="fas fa-trash text-danger"></i>
</a>`;

$('body .formGudang').css('display','block');
$('body .formGudang').attr('data-id','gudangValidate')
}

if (data.tipe == 3 && data['menggunakan_nomor_seri'] == null && subType == 'denganBarang') {
actionCell = `<a href="javascript:void(0)" id="ModalBarang" class="btn btn-clean btn-icon btn-sm" title="Input Serial Number"><i class="flaticon2-plus mr-n1"></i></a><a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Syarat Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showSyaratPengiriman"><i class="fas fa-shipping-fast text-warning"></i></a> <a href="javascript:;" data-toggle="tooltip" data-theme="dark" title="Jadwal Pengiriman" role="button" class="btn btn-sm btn-clean btn-icon" title="Delete" id="showModalJadwal"><i class="far fa-calendar text-primary"></i></a> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="delete">
<i class="fas fa-trash text-danger"></i>
</a>`;
$('body .formGudang').css('display','block');
$('body .formGudang').attr('data-id','gudangValidate')
}