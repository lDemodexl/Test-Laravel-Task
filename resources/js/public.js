const { indexOf } = require("lodash");

$(document).ready(function(){

    if( $('#add_domains_form').length > 0 ){

        loadListFromStorage();
        initListActions();
        $('#add_domain_to_list').on('click',function(e){
            if( $('#url_input')[0].checkValidity() ){
                e.preventDefault();
                var new_domain = $('#url_input').val();
                var list_conttainer = $('#domain_list');
                if( saveToLocalSorage( new_domain ) ){
                    var new_record = create_new_list_element( new_domain );
                    $(list_conttainer).append(new_record);
                }
                $('#url_input').val('');
                displayActionBtn();
                initListActions()
            }
        });

        $('#clear_list').on('click', function(e){
            e.preventDefault();
            if( confirm('Are you sure?!') ){
                localStorage.removeItem('local_domains');
                loadListFromStorage(true);
            }
        });

        $('#submit_list').on('click', function(e){
            e.preventDefault();
            $.ajax({
                url: '',
                type: 'post',
                data: {'domains':localStorage.getItem('local_domains')},
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                statusCode: {
                    404: function() {
                        console.log('Something went wrong, Please contact site administrator! 404');
                    },
                    400: function( response ) {
                        console.log('Something went wrong, Please contact site administrator! 400');
                    },
                    500: function(e) {
                        return e;
                    }
                },
                success: function( response ){
                    var data = JSON.parse(response);
                    if( data.status == 'success' ){
                        localStorage.removeItem('local_domains');
                        loadListFromStorage(true);
                        showNotification('List of domains added to queue successfully');
                    }else{
                        if( data.msg ){
                            showNotification(data.msg, 'danger');
                        }
                    }
                }
            })
        })

    }
})

function showNotification(msg, type='success'){
    var notificationsBar = $('<div class="alert alert-'+type+'" role="alert"></div>');
    notificationsBar.text(msg);
    $('#domain_list').parent().prepend(notificationsBar);
    setTimeout(function(){
        notificationsBar.remove();
    },3000);
}

function initListActions(){
    $('.remove-domain-btn').off('click');
    $('.remove-domain-btn').on('click', function(){
        var domain = $(this).closest('.row').find('input').val();
        deleteFromLocalStorage(domain);
        $(this).closest('.row').remove();
        displayActionBtn();
    })
}

function deleteFromLocalStorage( domain ){
    var current_data = localStorage.getItem('local_domains');
    var domains = JSON.parse(current_data);
    var index = indexOf(domains, domain);
    domains.splice(index, 1);
    localStorage.setItem('local_domains', JSON.stringify(domains));
}

function create_new_list_element( domain ){
    var container = $("<div class='row mb-2 border-bottom border-ligth p-2'></div>");
    var ladel = $("<label class='col-8'></label>");
    var actions = $("<div class='col-4'><button class=' remove-domain-btn btn btn-warning' >Remove</button></div>");
    var input = $("<input type='hidden' name='domains[]'>").val(domain);
    $(ladel).text(domain).append(input);
    $(container).append(ladel).append(actions);
    return container;
}

function saveToLocalSorage(domain){
    var current_data = localStorage.getItem('local_domains');
    if( current_data ){
        var domains = JSON.parse(current_data);
    }else{
        var domains = [];
    }

    if( indexOf(domains, domain) == -1 ){
        domains.push(domain);
        localStorage.setItem('local_domains', JSON.stringify(domains));
        return true;
    }

    return false;

}

function loadListFromStorage( clear = false  ){
    var current_data = localStorage.getItem('local_domains');
    if( clear ){
        $('#domain_list').html('');
    }
    if( current_data ){
        var domains = JSON.parse(current_data);
        for( var i = 0; i<domains.length; i++ ){
            var domain = create_new_list_element(domains[i]);
            $('#domain_list').append(domain);
        }
    }
    displayActionBtn();
}

function displayActionBtn(){
    if( $('#domain_list').find('div').length > 0 ){
        $('#form_action_buttons').show();
    }else{
        $('#form_action_buttons').hide();
    }
}
