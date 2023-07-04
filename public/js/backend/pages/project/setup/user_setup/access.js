$(function() {
    modal_content = 'access';
    module_url = '/actions/' + modal_content;
    module_type = 'custom';
    page_title = 'Access';

    scion.centralized_button(true, true, true, true);
    

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
        description: $('#description').val()
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

function syncData() {
}


// custom
function selectRole() {
    if($('#roles').val() !== '') {
        $('.check-permission').prop('disabled', false);

        $.get(module_url + '/get/' + $('#roles').val(), function(response) {
            $.each(response.data, function(i,v) {
                setAccessBtnSelected(v.enable, 'enable', v.permission_for, v.permission_for_id);
                setAccessBtnSelected(v.add, 'add', v.permission_for, v.permission_for_id);
                setAccessBtnSelected(v.edit, 'edit', v.permission_for, v.permission_for_id);
                setAccessBtnSelected(v.delete, 'delete', v.permission_for, v.permission_for_id);
                setAccessBtnSelected(v.print, 'print', v.permission_for, v.permission_for_id);
            });
        });
    }
    else {
        $('.check-permission').prop('disabled', true);
        
    }
}

function setAccessBtnSelected(permission, details, permission_for, permission_for_id) {
    $('#'+permission_for+'_'+permission_for_id+' .check-'+details)[0].checked = permission === 1?true:false;
}