$(function() {
    project_type = 'app_module';
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
            scion.centralized_button(true, false, true, true);
            break;
        case 'update':
            break;
    }
    scion.create.sc_modal(modal_content + '_form').hide('all', modalHideFunction);
}

function error() {}

function delete_success() {
}

function delete_error() {}

function generateData() {
    form_data = {
        _token: _token,
        data: []
    };

    $.each($('.access-sidebar-item'), function(i,v){
        var field_id = v.id;
        var permission_for = field_id.split('-')[0];
        var permission_for_id = field_id.split('-')[1];

        form_data.data.push({
            'role_id': $('#roles').val(),
            'permission_for': permission_for,
            'permission_for_id': permission_for_id,
            'enable': $('#' + field_id + ' .check-enable')[0].checked === true?1:0,
            'add': $('#' + field_id + ' .check-add')[0] !== undefined?($('#' + field_id + ' .check-add')[0].checked === true?1:0):0,
            'edit': $('#' + field_id + ' .check-edit')[0] !== undefined?($('#' + field_id + ' .check-edit')[0].checked === true?1:0):0,
            'delete': $('#' + field_id + ' .check-delete')[0] !== undefined?($('#' + field_id + ' .check-delete')[0].checked === true?1:0):0,
            'print': $('#' + field_id + ' .check-print')[0] !== undefined?($('#' + field_id + ' .check-print')[0].checked === true?1:0):0
        });
    });

    return form_data;
}

function generateDeleteItems(){}

function modalShowFunction() {
    scion.centralized_button(true, false, true, true);
}

function modalHideFunction() {
    // scion.centralized_button(false, true, true, true);
}

function customFunc() {}

function syncData() {
}


// custom
function selectRole() {
    actions = 'save';
    $('.check-permission').prop('checked', false);
    form_data.data = [];
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
            scion.centralized_button(true, false, true, true);
        });
    }
    else {
        $('.check-permission').prop('disabled', true);
        scion.centralized_button(true, true, true, true);
        
    }
}

function setAccessBtnSelected(permission, details, permission_for, permission_for_id) {
    if($('#'+permission_for+'-'+permission_for_id+' .check-'+details)[0] !== undefined) {
        $('#'+permission_for+'-'+permission_for_id+' .check-'+details)[0].checked = permission === 1?true:false;
    }
}

function sample() {
    var data = [];
    $.each($('.access-sidebar-item'), function(i,v){
        var field_id = v.id;
        var permission_for = field_id.split('-')[0];
        var permission_for_id = field_id.split('-')[1];

        data.push({
            'role_id': $('#roles').val(),
            'permission_for': permission_for,
            'permission_for_id': permission_for_id,
            'enable': $('#' + field_id + ' .check-enable')[0].checked === true?1:0,
            'add': $('#apps-1 .check-add')[0] !== undefined?($('#' + field_id + ' .check-add')[0].checked === true?1:0):0,
            'edit': $('#apps-1 .check-edit')[0] !== undefined?($('#' + field_id + ' .check-edit')[0].checked === true?1:0):0,
            'delete': $('#apps-1 .check-delete')[0] !== undefined?($('#' + field_id + ' .check-delete')[0].checked === true?1:0):0,
            'print': $('#apps-1 .check-print')[0] !== undefined?($('#' + field_id + ' .check-print')[0].checked === true?1:0):0
        });
    });
    console.log(data);
}
