// // ================================  dashboard ================================================
// $( document ).ready(function() {
    
//     //alert("tettstt");
//   var Total_jobs_cnt = document.getElementsByName("total_jobs")[0].value;
//   //var DistributnChkklist_jobs_cnt = document.getElementsByName("JobsDistributnChkklist")[0].value;
   
//     var CoverSheet_jobs_cnt                     =   document.getElementsByName("JobsCoverSheet")[0].value;
//     var PrjDetails_jobs_cnt                     =   document.getElementsByName("JobsPrjDetails")[0].value;
//     var QualifyFive_jobs_cnt                    =   document.getElementsByName("JobsQualifyFive")[0].value;
//     var DistributnChkklist_jobs_cnt             =   document.getElementsByName("JobsDistributnChkklist")[0].value;
    
//     var CN29_jobs_cnt                           =   document.getElementsByName("JobsStatusCN29")[0].value;
//     var FieldRemediation_jobs_cnt               =   document.getElementsByName("JobsStatusFieldRemediation")[0].value;
//     var UnknownStatus_jobs_cnt                  =   document.getElementsByName("JobsStatusUnknownStatus")[0].value;
    
//     //alert(CN29_jobs_cnt);
//     //alert(FieldRemediation_jobs_cnt);
//     //alert(UnknownStatus_jobs_cnt);
    
//     /**********Total Jobs and Review Jobs************************/
//     var data_total_review_jobs = [{
//         label: "Total Jobs", data:Total_jobs_cnt, color: "#FF6384", }, {
//         label: "Review Done", data: DistributnChkklist_jobs_cnt, color: "#36A2EB", }, {
//     }];
    
//     var plotObj1 = $.plot($("#dash_pie_totaljobs"), data_total_review_jobs, {
//         series: {
//             pie: {
//                 show: true
//             }
//         },
//         grid: { hoverable: true },
//         tooltip: true,
//         tooltipOpts: {
//             content: "%p.0%, %s", 
//             shifts: {   x: 20, y: 0 },
//             defaultTheme: false
//         }
//     });
//     /****************************Done*****************************/
//     /**********Jobs Chart for four form stages************************/
//     var data_form_stages = [{
//         label: "Cover Sheet", data:CoverSheet_jobs_cnt, color: "#bdc3c7", }, {
//         label: "Project Details", data: PrjDetails_jobs_cnt, color: "#43AEA8", }, {
//         label: "Qualifying Five", data: QualifyFive_jobs_cnt, color: "#999933", }, {
//         label: "Checklist Questions", data: DistributnChkklist_jobs_cnt, color: "#AED6F1", }
//       ];
//     var plotObj2 = $.plot($("#dash_pie_formstage"), data_form_stages, {
//         series: {
//             pie: {  show: true }
//         },
//         grid: { hoverable: true },
//         tooltip: true,
//         tooltipOpts: {
//             content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
//             shifts: {   x: 20, y: 0 },
//             defaultTheme: false
//         }
//     });
//     /****************************Done*****************************/
//     /**********Jobs Chart for four form status************************/
  
//     var data_form_status = [{
//         label: "CN-29 Eligible", data:CN29_jobs_cnt, color: "#6B8E23", }, {
//         label: "Field Remediation", data: FieldRemediation_jobs_cnt, color: "#FF7F50", }, {
//         label: "Unknown Status", data: UnknownStatus_jobs_cnt, color: "#ADD8E6", }
//       ];
//      /*var data_form_status = [{
//         label: "CN-29 Eligible", data:1, color: "#6B8E23", }, {
//         label: "Field Remediation", data: 1, color: "#FF7F50", }, {
//         label: "Unknown Status", data:1, color: "#ADD8E6", }
//       ];*/
//     var plotObj3 = $.plot($("#dash_jobstatus"), data_form_status, {
//         series: {
//             pie: { show: true }
//         },
//         grid: { hoverable: true },
//         tooltip: true,
//         tooltipOpts: {
//             content: "%p.0%, %s", 
//             shifts: {x: 20, y: 0 },
//             defaultTheme: false
//         }
//     });
//     /****************************Done*****************************/
    
// });