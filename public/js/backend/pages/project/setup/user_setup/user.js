$(function() {
    modal_content = 'user';
    module_url = '/actions/' + modal_content;
    module_type = 'custom';
    page_title = 'User';

    scion.centralized_button(false, true, true, true);
    
    scion.create.table(
        modal_content + '_table',  
        module_url + '/get', 
        [
            { data: "lastname", title:"<input type='checkbox' class='multi-checkbox' onclick='scion.table.checkAll()'/>", render: function(data, type, row, meta) {
                var html = "";
                html += '<input type="checkbox" class="single-checkbox" value="'+row.id+'" onclick="scion.table.checkOne()"/>';
                html += '<a href="#" class="align-middle edit" onclick="scion.record.edit('+"'"+module_url+"/edit/', "+ row.id + ' )"><i class="fas fa-pen"></i></a>';
                return html;
            }},
            { data: "middlename", title: "STATUS", render: function(data, type, row, meta) {
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
            }},
            { data: 'firstname', title:'NAME', render: function(data, type, row, meta) {
                return row.firstname + ' ' + (row.middlename !== null && row.middlename !== ''?row.middlename + ' ':'') + row.lastname;
            }},
            { data:'email', title: 'EMAIL', className: 'small_text with-bg' }
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
        firstname: $('#firstname').val(),
        middlename: $('#middlename').val(),
        lastname: $('#lastname').val(),
        suffix: $('#suffix').val(),
        email: $('#email').val(),
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

function customFunc() {}

function syncData() {}