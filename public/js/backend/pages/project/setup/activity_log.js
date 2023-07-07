$(function() {
    project_type = 'apps';
    modal_content = 'activity_log';
    module_url = '/actions/' + modal_content;
    module_type = 'custom';
    page_title = 'Activity Log';

    scion.centralized_button(true, true, true, false);
    
    scion.create.table(
        modal_content + '_table',  
        module_url + '/get' ,
        [
            { data: "action", title: "LOGS", render:function(data, type, row, meta) {
                var html = '';
                    html += "<div class='activity-item'>";
                        html += '<div class="user"><div class="profiel-pic" style="background:url(/backend/img/avatars/'+row.user.profile_img+')no-repeat !important;background-size:cover !important;background-position:center center !important;"></div>';
                        html += '<i class="fab fa-'+row.device_info.toLowerCase()+'"></i>';
                        html += '</div>';
                        html += '<div class="log-details">';
                                html += '<div class="log-content"><b>'+row.action+'</b>: '+row.details+'</div>';
                                html += '<span class="log-date">'+moment(row.created_at).format('MMM DD, YYYY - h:mm A')+'</span>';
                                html += '<div class="log-sub">IP Address: '+row.ip_address+'</div>';
                        html += '</div>';
                    html += "</div>";
                return html;
            }}
        ], 'rti', [], false, false
    );

});

function filterDate() {
    if ($.fn.DataTable.isDataTable('#' + modal_content + '_table')) {
        $('#' + modal_content + '_table').DataTable().clear().destroy();
    }

    scion.create.table(
        modal_content + '_table', 
        module_url + '/get/' + $('#filter_date').val(),
        [
            { data: "action", title: "LOGS", render:function(data, type, row, meta) {
                var html = '';
                    html += "<div class='activity-item'>";
                        html += '<span class="activity-date">'+moment(row.created_at).format('MMM DD, YYYY - h:mm A')+'</span>';
                        html += '<span class="activity-title">'+row.action+'</span>';
                        html += '<span class="activity-details">'+row.details+'</span>';
                        html += '<span class="activity-sub"><b>'+row.device_info+'</b> - '+row.ip_address+'</span>';
                    html += "</div>";
                return html;
            }}
        ], 'Bfrtip', ['print', 'csv'], false
    );
}

function printReports() {
    $('.buttons-print').click();
}
