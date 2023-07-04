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
    console.log('helloe');
}


// custom
function selectRole() {
    if($('#role').val() !== '') {
        $('.btn-permission').prop('disabled', false);
    }
    else {
        $('.btn-permission').prop('disabled', true);
    }
}