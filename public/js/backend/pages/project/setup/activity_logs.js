$(function() {
    modal_content = 'activity_log';
    module_url = '/actions/' + modal_content;
    module_type = 'custom';
    page_title = 'Activity Log';

    scion.centralized_button(true, true, true, true);
    
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
        ], 'Bfrtip', ['print', 'csv'], false, false
    );

});

function filterDate() {
    if ($.fn.DataTable.isDataTable('#'+modal_content + '_table')) {
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
