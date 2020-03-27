// ================================  dashboard ================================================

$(function() {
     //alert('hiiii');
   
    var Total_jobs_cnt = document.getElementsByName("total_jobs")[0].value;
    var Jobsreviewdone = document.getElementsByName("Jobsreviewdone")[0].value;
     //alert(Total_jobs_cnt);
    //alert(Jobsreviewdone);
    var data = [{
        label: "Total Jobs", data:Total_jobs_cnt, color: "#FF6384", }, {
        label: "Review Done", data: Jobsreviewdone, color: "#36A2EB", }, {
    }];

    var plotObj = $.plot($("#dash_pie_totaljobs"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: { hoverable: true },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0, %s", 
            shifts: {   x: 20, y: 0 },
            defaultTheme: false
        }
    });
});
$(function() {
     var CoverSheet_jobs_cnt1 = document.getElementsByName("JobsCoverSheet")[0].value;
     var PrjDetails_jobs_cnt = document.getElementsByName("JobsPrjDetails")[0].value;
    var QualifyFive_jobs_cnt = document.getElementsByName("JobsQualifyFive")[0].value;
    var DistributnChkklist_jobs_cnt = document.getElementsByName("JobsDistributnChkklist")[0].value;
    
    var data = [{
        label: "Cover Sheet", data:CoverSheet_jobs_cnt1, color: "#bdc3c7", }, {
        label: "Project Details", data: PrjDetails_jobs_cnt, color: "#43AEA8", }, {
        label: "Qualifying Five", data: QualifyFive_jobs_cnt, color: "#999933", }, {
        label: "Checklist Questions", data: DistributnChkklist_jobs_cnt, color: "#AED6F1", }
      ];
    var plotObj = $.plot($("#dash_pie_formstage"), data, {
        series: {
            pie: {  show: true }
        },
        grid: { hoverable: true },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0, %s", // show percentages, rounding to 2 decimal places
            shifts: {   x: 20, y: 0 },
            defaultTheme: false
        }
    });
});
$(function() {
    
    var CN29_jobs_cnt                           =   document.getElementsByName("JobsStatusCN29")[0].value;
    var FieldRemediation_jobs_cnt               =   document.getElementsByName("JobsStatusFieldRemediation")[0].value;
    var UnknownStatus_jobs_cnt                  =   document.getElementsByName("JobsStatusUnknownStatus")[0].value;
    
    
     var data_form_status = [{
        label: "CN-29 Eligible", data:CN29_jobs_cnt, color: "#6B8E23", }, {
        label: "Field Remediation", data: FieldRemediation_jobs_cnt, color: "#FF7F50", }, {
        label: "Unknown Status", data: UnknownStatus_jobs_cnt, color: "#ADD8E6", }
      ];
    var plotObj = $.plot($("#dash_jobstatus"), data_form_status, {
        series: {
            pie: { show: true }
        },
        grid: { hoverable: true },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0, %s", 
            shifts: {x: 20, y: 0 },
            defaultTheme: false
        }
    });
    
    /*if (isNaN(content.getData()[0].percent)){
        alert('no data');
    var canvas = content.getCanvas();
    var ctx = canvas.getContext("2d");  //canvas context
    var x = canvas.width / 2;
    var y = canvas.height / 2;
    ctx.font = '30pt Calibri';
    ctx.textAlign = 'center';
    ctx.fillText('No Data!', x, y);
    }*/
});