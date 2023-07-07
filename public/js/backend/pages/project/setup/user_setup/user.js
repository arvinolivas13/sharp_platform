var user_id = null;
$(function() {
    project_type = 'app_module';
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
                html += '<a href="#" class="align-middle role_setup" style="color:#646464;padding:5px;display:inline-block;" onclick="getRoleSetup('+row.id+')"><i class="fas fa-user-lock"></i></a>';
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

    switch(modal_content) {
        case 'user':
            form_data = {
                _token: _token,
                firstname: $('#firstname').val(),
                middlename: $('#middlename').val(),
                lastname: $('#lastname').val(),
                suffix: $('#suffix').val(),
                email: $('#email').val(),
                status: $('#status').val(),
            };
            
            break;
        
        case 'role_setup':
            form_data = {
                _token: _token,
                user_id: user_id,
                role_id: $('#role_id').val()
            };

            break;
    }

    return form_data;
}

function generateDeleteItems(){}

function modalShowFunction() {
    scion.centralized_button(true, false, true, true);
}

function modalHideFunction() {
    scion.centralized_button(false, true, true, true);
    modal_content = 'user';
}

function customFunc() {}

function syncData() {
    $.get('/actions/role/list/all', function(response) {
        $.each(response.data, function(i,v) {
            var o = new Option(v.name, v.id);
            
            $(o).html(v.name);
            $("#role_id").append(o);
        });
    });
}

// Custom Function
function getRoleSetup(id) {
    user_id = id;
    actions = 'save';

    $.get('/actions/role_setup/list/'+id, function(response) {

        if(response.data !== null)
        {
            $('#role_id').val(response.data.role_id);
        }
        else {
            $('#role_id').val('');
        }
        
        scion.create.sc_modal("access_form", 'ROLE SETUP').show(modalShowFunction);
        
        modal_content = 'role_setup';
        module_url = '/actions/' + modal_content;
    });
}