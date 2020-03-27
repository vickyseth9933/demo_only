// ================================  dashboard ================================================
var random = Math.floor(Math.random() * 10111);
$(function() {
     //alert('hiiii');
   
    var Total_jobs_cnt = document.getElementsByName("total_jobs")[0].value;
    var Jobsreviewdone = document.getElementsByName("Jobsreviewdone")[0].value;
    // alert('value=='+Total_jobs_cnt);
   // alert('value=='+Jobsreviewdone);
    var data = [{
        label: "Completed ("+Jobsreviewdone+")", data:Jobsreviewdone, color: "#FF6384",},{
        label: "Submited for Approval ("+Total_jobs_cnt+")", data:Total_jobs_cnt, color: "#36A2EB",}];

    var plotObj = $.plot($("#dash_pie_totaljobs"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: { hoverable: true },
        tooltip: true,
        tooltipOpts: {
            content: "%s", 
            shifts: {x: 20, y: 0 },
            defaultTheme: false
        }
       
    });
    
   //  console.log(plotObj);
});

$(function() {
   
    var CN29_jobs_cnt                           =   document.getElementsByName("JobsStatusCN29")[0].value;
    var FieldRemediation_jobs_cnt               =   document.getElementsByName("JobsStatusFieldRemediation")[0].value;
    var UnknownStatus_jobs_cnt                  =   document.getElementsByName("JobsStatusUnknownStatus")[0].value;
    
    
     var data_form_status = [{
        label: "CN-29 Eligible ("+CN29_jobs_cnt+")", data:CN29_jobs_cnt, color: "#6B8E23", }, {
        label: "Field Remediation Required ("+FieldRemediation_jobs_cnt+")", data: FieldRemediation_jobs_cnt, color: "#FF7F50", }, {
        label: "Unknown ("+UnknownStatus_jobs_cnt+")", data: UnknownStatus_jobs_cnt, color: "#ADD8E6", }
      ];
    var plotObj = $.plot($("#dash_jobstatus"), data_form_status, {
        series: {
            pie: { show: true }
        },
        grid: { hoverable: true },
        tooltip: true,
        tooltipOpts: {
            content: "%s", 
            shifts: {x: 20, y: 0 },
            defaultTheme: false
        }
    });
});
 
 var _canvas = null;
$(function() {
$("#id_generate_pdf").on("click", function (e) {
    var filter = $('#filter').val();
   // alert(filter);
    if(filter!=''){
    if(filter=='week'){    
    var sdateweek = $('#weekfilter1').val();
    var sdate = '- Week Date From '+sdateweek;
    }else if(filter=='month'){
    var sdatemonth = $('#monthly1').val();
    var sdate = '- Month '+sdatemonth;
    }else if(filter=='daterange'){
     if($('#type-filtercn29').val()=='custom') {      
    var stdate = $('#from').val();    
    var enddate = $('#to').val(); 
    var sdate = '- From Date '+stdate+' To Date '+enddate;
     }else{
      var stdate1 = $('#from1').val();    
    var enddate1 = $('#to1').val(); 
    var sdate = '- From Date '+stdate1+' To Date '+enddate1;    
     }
    }else{
     sdate = ' ';    
    }

    }else{
     sdate = ' ';    
    }
    window.allcanvas = [];
    var allcontainers = $('[id^="piechart"]');
 
    allcontainers.each(function (index, elem) {
      html2canvas($(elem).get(0), {
        onrendered: function (canvas) {
          window.allcanvas.push(canvas);
          if(allcontainers.length == allcanvas.length){
            finalpdf(sdate);
          }
        }
      });
    });
  });
  
  finalpdf = function(sdate){
      var sdate = sdate;
    var doc = new jsPDF('landscape');
    
    for(var i = 0; i< allcanvas.length; i++){
    var imgData = allcanvas[i].toDataURL('image/PNG');
    
     doc.setFontSize(22);
   
doc.text('Pie Chart Report '+sdate, 15, 20);

      doc.setFillColor(204, 204,204,0);
       doc.addImage(imgData, 'PNG', 2.5, 20, 290, 85);
      if(i != allcanvas.length-1) {
        doc.addPage();
      }
    }
    doc.save('PieChartReportPDF'+random+'.pdf');
  };
});