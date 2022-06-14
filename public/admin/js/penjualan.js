// TableData = $(`#${tablename}`).DataTable({
//   dom: 't',
//   pageLength: -1,
//   responsive: true,
//   colReorder: !0,
//   stateSave: !1,
//   lengthMenu: [
//     [10, 20, 50, 100],
//     [10, 20, 50, 100]
//   ],
//   language: {
//     "lengthMenu": " _MENU_ ",
//     "zeroRecords": "Belum ada data",
//   },
//   order: [],
//   columnDefs: [{
//       "defaultContent": "-",
//       "targets": [4],
//     },
//     {
//       targets: 0,
//       className: "text-center",
//       orderable: true,
//       data: null,
//       defaultContent: ''
//     },
//     {
//       targets: 0,
//       className: "text-center",
//       orderable: true,
//       data: null,
//       defaultContent: ''
//     },
//     {
//       targets: [1, 2, 3, 4, 5, 6],
//       visible: false,
//     },
//     targetsDateFormat,
//     targetsCurrencyFormat,
//   ],
// });

// $(`#${tablename} tbody`).on('click', 'td.details-control', function () {
//   var tr = $(this).closest('tr');
//   var row = TableData.row(tr);


//   if (row.child.isShown()) {
//     TableData.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
//     tr.removeClass('shown');
//   } else {
//     TableData.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
//     tr.addClass('shown');
//   }
// });