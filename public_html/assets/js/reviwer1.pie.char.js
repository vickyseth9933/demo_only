// ================================  dashboard ================================================

/*$(function() {
    var Total_jobs_cnt = document.getElementsByName("total_jobs")[0].value;
    var DistributnChkklist_jobs_cnt = document.getElementsByName("JobsDistributnChkklist")[0].value;
    
    var data = [{
        label: "Total Jobs", data:Total_jobs_cnt, color: "#FF6384", }, {
        label: "Review Done", data: DistributnChkklist_jobs_cnt, color: "#36A2EB", }, {
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
            content: "%p.0%, %s", 
            shifts: {   x: 20, y: 0 },
            defaultTheme: false
        }
    });
});*/
$(document).ready(function () {
    var data1 = [{
        label: "Total Jobs", data:50, color: "#FF6384", }, {
        label: "Review Done", data: 50, color: "#36A2EB", }, {
    }];
    var options = {
    series: {
        pie: {
            show: true
        }
    }
};

    $.plot($("#dash_pie_totaljobs"), data1, options);
    $("#dash_pie_totaljobs").showMemo();
});

$.fn.showMemo = function () {
    alert('hello');
    $(this).bind("plothover", function (event, pos, item) {
        if (!item) { return; }
 
        var html = [];
        var percent = parseFloat(item.series.percent).toFixed(2);        
        alert(item.series.data);
        html.push("<div style=\"border:1px solid grey;background-color:",
             item.series.color,
             "\">",
             "<span style=\"color:white\">",
             item.series.label,
             " : ",
             $.formatNumber(item.series.data[0][1], { format: "#,###", locale: "us" }),
             " (", percent, "%)",
             "</span>", 
             "</div>");
             alert(item.series.data[0][1]);
        $("#flot-memo").html(html.join(''));
    });
}
$(function() {
     var CoverSheet_jobs_cnt1 = document.getElementsByName("JobsCoverSheet")[0].value;
     var PrjDetails_jobs_cnt = document.getElementsByName("JobsPrjDetails")[0].value;
    var QualifyFive_jobs_cnt = document.getElementsByName("JobsQualifyFive")[0].value;
    var DistributnChkklist_jobs_cnt = document.getElementsByName("JobsDistributnChkklist")[0].value;
    
    var data = [{
        label: "Cover Sheet", data:'', color: "#bdc3c7", }, {
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
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
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
            content: "%p.0%, %s", 
            shifts: {x: 20, y: 0 },
            defaultTheme: false
        }
    });
});