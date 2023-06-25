$(function() {
    modal_content = 'app_module';
    module_url = '/actions/' + modal_content;
    module_type = 'custom';
    page_title = 'App Type';

    scion.centralized_button(false, true, true, true);
    
    scion.create.table(
        modal_content + '_table',  
        module_url + '/get', 
        [
            { data: "id", title:"<input type='checkbox' class='multi-checkbox' onclick='scion.table.checkAll()'/>", render: function(data, type, row, meta) {
                var html = "";
                html += '<input type="checkbox" class="single-checkbox" value="'+row.id+'" onclick="scion.table.checkOne()"/>';
                html += '<a href="#" class="align-middle edit" onclick="scion.record.edit('+"'"+module_url+"/edit/', "+ row.id + ' )"><i class="fas fa-pen"></i></a>';
                return html;
            }},
            { data: "name", title: "MODULE NAME" },
            { data: "code", title: "CODE", className: 'small_text with-bg' },
            { data: "app.name", title: "APP" },
            { data: "sort_no", title: "SORT NO." },
            { data: "status", title: "STATUS", render: function(data, type, row, meta) {
                var status = '';
                switch(row.status) {
                    case 0:
                        status = 'danger';
                        break;
                    case 1:
                        status = 'success';
                        break;
                }
                return "<span class='status text-"+status+"'><i class='fas fa-circle'></i></span>"
            }}
        ], 'Bfrtip', []
    );


    syncData();

});

function success() {
    switch(actions) {
        case 'save':
            break;
        case 'update':
            break;
    }
    $('#' + modal_content + '_table').DataTable().draw();
    scion.create.sc_modal(modal_content + '_form').hide('all', modalHideFunction);
}

function error() {}

function delete_success() {
    $('#' + modal_content + '_table').DataTable().draw();
}

function delete_error() {}

function generateData() {
    form_data = {
        _token: _token,
        name: $('#name').val(),
        code: $('#code').val(),
        app_id: $('#app_id').val(),
        sort_no: $('#sort_no').val(),
        status: $('#status').val(),
    };

    return form_data;
}

function generateDeleteItems(){}

function modalShowFunction() {
    scion.centralized_button(true, false, true, true);
}

function modalHideFunction() {
    scion.centralized_button(false, true, true, true);
}

function customFunc() {
}

function syncData() {
    $.get('/actions/app/list/all', function(response) {
        $.each(response.data, function(i,v) {
            var o = new Option(v.name, v.id);
            
            $(o).html(v.name);
            $("#app_id").append(o);
        });
    });
}