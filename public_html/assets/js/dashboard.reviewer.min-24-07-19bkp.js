// $(function() {
//     var Total_jobs_cnt = document.getElementsByName("total_jobs")[0].value;
//     var DistributnChkklist_jobs_cnt = document.getElementsByName("JobsDistributnChkklist")[0].value;
    
//     var test2 = '40';
//     var data = [{
//         label: "Total Jobs", data:Total_jobs_cnt, color: "#FF6384", }, {
//         label: "Review Done", data: DistributnChkklist_jobs_cnt, color: "#36A2EB", }, {
//     }];

//     var plotObj = $.plot($("#dash_pie_totaljobs"), data, {
//         series: {
//             pie: {
//                 show: true
//             }
//         },
//         grid: { hoverable: true },
//         tooltip: true,
//         tooltipOpts: {
//             //content: "%p.0%, %s", 
//             content: "%y.0, %s", // show value to 0 decimals
//             shifts: {   x: 20, y: 0 },
//             defaultTheme: false
//         }
//     });
// });

$(function() {
    $('#dash_datatable').DataTable({
        pageLength: 5,
        fixedHeader: true,
        responsive: true,
        "sDom": 'rtip',
        columnDefs: [{
            targets: 'no-sort',
            orderable: false
        }]
    });

    var table = $('#dash_datatable').DataTable();
    $('#key-search').on('keyup', function() {
        table.search(this.value).draw();
    });
    $('#type-filter').on('change', function() {
         table.search($(this).val()).draw();
    });
    $('#adtbl-select-all').on('click', function(){
              // Check/uncheck all checkboxes in the table
              var rows = table.rows({ 'search': 'applied' }).nodes();
              $('input[type="checkbox"]', rows).prop('checked', this.checked);
              $("#assign_tojob").toggle();
           });
});
$(function() {
    $('#dash_datatable2').DataTable({
        pageLength: 5,
        fixedHeader: true,
        responsive: true,
        "sDom": 'rtip',
        columnDefs: [{
            targets: 'no-sort',
            orderable: false
        }]
    });

    var table = $('#dash_datatable2').DataTable();
    $('#key-search2').on('keyup', function() {
        table.search(this.value).draw();
    });
    $('#type-filter2').on('change', function() {
         table.search($(this).val()).draw();
    });
    $('#adtbl-select-all2').on('click', function(){
              // Check/uncheck all checkboxes in the table
              var rows = table.rows({ 'search': 'applied' }).nodes();
              $('input[type="checkbox"]', rows).prop('checked', this.checked);
              $("#assign_tojob").toggle();
           });
});
$(function() {
    $('#dash_datatable3').DataTable({
        pageLength: 5,
        fixedHeader: true,
        responsive: true,
        "sDom": 'rtip',
        columnDefs: [{
            targets: 'no-sort',
            orderable: false
        }]
    });

    var table = $('#dash_datatable3').DataTable();
    $('#key-search3').on('keyup', function() {
        table.search(this.value).draw();
    });
    $('#type-filter3').on('change', function() {
         table.search($(this).val()).draw();
    });
    $('#adtbl-select-all3').on('click', function(){
              // Check/uncheck all checkboxes in the table
              var rows = table.rows({ 'search': 'applied' }).nodes();
              $('input[type="checkbox"]', rows).prop('checked', this.checked);
              $("#assign_tojob").toggle();
           });
});
$(function() {
    $('#dash_datatablerejcted').DataTable({
        pageLength: 5,
        fixedHeader: true,
        responsive: true,
        "sDom": 'rtip',
        columnDefs: [{
            targets: 'no-sort',
            orderable: false
        }]
    });

    var table = $('#dash_datatablerejcted').DataTable();
    $('#key-searchrejcted').on('keyup', function() {
        table.search(this.value).draw();
    });
    $('#type-filterrejcted').on('change', function() {
         table.search($(this).val()).draw();
    });
    $('#adtbl-select-allrejcted').on('click', function(){
              // Check/uncheck all checkboxes in the table
              var rows = table.rows({ 'search': 'applied' }).nodes();
              $('input[type="checkbox"]', rows).prop('checked', this.checked);
              $("#assign_tojob").toggle();
           });
});

$(function() {
    
    $('#dash_datatable5').DataTable({
        pageLength:10,
        fixedHeader: true,
        responsive: true,
        "sDom": 'rtip',
        columnDefs: [{
            targets: 'no-sort',
            orderable: false
        }]
    });

    var table = $('#dash_datatable5').DataTable();
    $('#key-search5').on('keyup', function() {
        table.search(this.value).draw();
    });
    $('#type-filter5').on('change', function() {
         table.search($(this).val()).draw();
    });
 
});
