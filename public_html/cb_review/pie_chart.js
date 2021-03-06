// ================================  dashboard ================================================

$(function() {
     //alert(Total_jobs_cnt);
     //alert(Jobsreviewdone);
    var data = [{
        label: "Total Jobyyyys", data:23, color: "#FF6384", }, {
        label: "Review Done", data: 5, color: "#36A2EB", }, {
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
    
     //alert(CoverSheet_jobs_cnt1);
   // alert(PrjDetails_jobs_cnt);
   // alert(QualifyFive_jobs_cnt);
    //alert(DistributnChkklist_jobs_cnt);
    
    var data = [{
        label: "Cover Sheet", data:2, color: "#bdc3c7", }, {
        label: "Project Details", data: 3, color: "#43AEA8", }, {
        label: "Qualifying Five", data: 4, color: "#999933", }, {
        label: "Checklist Questions", data: 6, color: "#AED6F1", }
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
        label: "CN-29 Eligible", data:5, color: "#6B8E23", }, {
        label: "Field Remediation", data: 6, color: "#FF7F50", }, {
        label: "Unknown Status", data: 7, color: "#ADD8E6", }
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
});