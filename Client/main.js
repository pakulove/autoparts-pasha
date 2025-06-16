$(document).ready(function(){
  
$(document).ready(function(){
    $('select').formSelect();
  });
});
 
function init() {
    if (localStorage.client_id == 0 || localStorage.client_id==undefined) {
        clear_client_form();
        console.log("new");
    } else {
        let id = localStorage.client_id;
        $.ajax({
        type: 'GET',
        url: 'clients_db.php',
        data: {
            action: 'get',
            id: id
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data.result) {
                let client = data.result;
                fill_client_form(id, client.surname, client.name, client.patronymic, client.phone, client.email, client.address, client.birthday);
            } 
        }
    });
                                    
    }
}
 
function add_client(event) {
    $('#clients-table tr').removeAttr('style');
    let send_data = get_client_data();
    send_data.action = 'add';
    
    $.ajax({
        type: 'POST',
        url: 'clients_db.php',
        data: send_data,
        dataType: 'json',
        success: function(data) {
            if (data.result) {
                send_data.id = data.result;
                add_client_to_table(send_data);
                alert("Клиент " + name + " добавлен");
                location.href = 'Klients.php';
            } else {
                alert("Ошибка");
            }
        }
    });
}

function select_client(event) {
    localStorage.client_id = event.target.parentNode.id.substring(7);
    $('#clients-table tr').removeAttr('style');
    event.target.parentNode.setAttribute('style', 'background-color: #90caf9');

}

function select_client1(event) {
    var id = event.target.parentNode.id.substring(7);
    localStorage.autopart_id = id

}

function edit_client() {
    $('#clients-table tr').removeAttr('style');
    if (localStorage.client_id != 0) {
        let send_data = get_client_data();
        send_data.id = localStorage.client_id;
        send_data.action = 'edit';
        
        $.ajax({
            type: 'POST',
            url: 'clients_db.php',
            data: send_data,
            dataType: 'json',
            success: function(data) {
                if (data.result) {
                    edit_client_in_table(send_data);
                    location.href = 'Klients.php';
                } else {
                    alert("Не удалось обновить клиента! Обратитесь в службу поддержки");
                }
            }
        });
    } else {
        alert("Выберите клиента!");
    }
}

function edit_client1() {
    if (localStorage.client_id == 0) {
        alert("Выберите клиента!");
    }
    else {
        location.href = 'AddKlients2.php';
    }
}

function delete_client() {
    if (localStorage.client_id != 0) {
        let send_data = {
            id : localStorage.client_id,
            action: 'delete'
        };
        
        $.ajax({
            type: 'POST',
            url: 'clients_db.php',
            data: send_data,
            dataType: 'json',
            success: function(data) {
                if (data.result) {
                    delete_client_from_table(localStorage.client_id);
                    clear_client_form();
                } else {
                    alert("Не удалось удалить клиента! Обратитесь в службу поддержки");
                }
            }
        });
    } else {
        alert("Выберите клиента!");
    }
}

function delete_client_from_table(id) {
    $('#client-' + id).remove();
    localStorage.client_id = 0;
}

function clear_client_form() {
    fill_client_form(0, '', '', '', '', '', '', '');
}

function clear_all() {
    localStorage.clear();
}

function fill_client_form(id, surname, name, patronymic, phone, email, address, birthday) {
    localStorage.client_id = id;
    $('#surname').val(surname);
    $('#name').val(name);
    $('#patronymic').val(patronymic);
    $('#phone').val(phone);
    $('#email').val(email);
    $('#address').val(address);
    $('#birthday').val(birthday);
}

function get_client_data() {
    return {
        surname:    $('#surname').val(),
        name:       $('#name').val(),
        patronymic: $('#patronymic').val(),
        phone:      $('#phone').val(),
        email:      $('#email').val(),
        address:    $('#address').val(),
        birthday:   $('#birthday').val()
    };
}

function add_client_to_table(data) {
    $('#clients-table').append(
        "<tr id='client-" + data.id + "'>" + 
        "<td>" + data.surname + "</td>" + 
        "<td>" + data.name + "</td>" + 
        "<td>" + data.patronymic + "</td>" + 
        "<td>" + data.phone + "</td>" +
        "<td>" + data.email + "</td>" +
        "<td>" + data.address + "</td>" + 
        "<td>" + get_format_date(data.birthday) + "</td>" + 
        "</tr>"
    );
}

function edit_client_in_table(data) {
    $('#client-' + data.id).html(
        "<td>" + data.surname + "</td>" + 
        "<td>" + data.name + "</td>" + 
        "<td>" + data.patronymic + "</td>" + 
        "<td>" + data.phone + "</td>" + 
        "<td>" + data.email + "</td>" +
        "<td>" + data.address + "</td>" + 
        "<td>" + get_format_date(data.birthday) + "</td>"
    );
}

function get_format_date(date) {
    let d = new Date(date);
    
    return [
        ('0' + d.getDate()).slice(-2),
        ('0' + (d.getMonth() + 1)).slice(-2),
        d.getFullYear()
    ].join('.');
}




function init1() {
    if (localStorage.autopart_id == 0 || localStorage.autopart_id==undefined) {
        clear_autopart_form();
        console.log("new");
    } else {
        let id = localStorage.autopart_id;
        $.ajax({
        type: 'GET',
        url: 'autoparts_db.php',
        data: {
            action: 'get',
            id: id
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data.result) {
                let autopart = data.result;
                fill_autopart_form(id, autopart.name, autopart.type, autopart.description, autopart.cost);
            } 
        }
    });
                                    
    }
}
 
function add_autopart(event) {
    $('#autoparts-table tr').removeAttr('style');
    let send_data = get_autopart_data();
    send_data.action = 'add';
    
    $.ajax({
        type: 'POST',
        url: 'autoparts_db.php',
        data: send_data,
        dataType: 'json',
        success: function(data) {
            if (data.result) {
                send_data.id = data.result;
                add_autopart_to_table(send_data);
                alert("Автозапчасть " + name + " добавлена");
                location.href = 'Catalog.php';
            } else {
                alert("Ошибка");
            }
        }
    });
}

function select_autopart(event) {
    var id = event.target.parentNode.id.substring(10);
    localStorage.autopart_id = id
     $('#autoparts-table tr').removeAttr('style');
    event.target.parentNode.setAttribute('style', 'background-color: #90caf9');
    
    list = localStorage.getItem('productList');
    if (list == null) {
        list = {};
    } else {
        list = JSON.parse(list);
    }
    
    if (list[id]) {
        list[id] = list[id] + 1;
    } else {
        list[id] = 1;
    }
    localStorage.setItem('productList', JSON.stringify(list));

}

function edit_autopart() {
     $('#autoparts-table tr').removeAttr('style');
    if (localStorage.autopart_id != 0) {
        let send_data = get_autopart_data();
        send_data.id = localStorage.autopart_id;
        send_data.action = 'edit';
        
        $.ajax({
            type: 'POST',
            url: 'autoparts_db.php',
            data: send_data,
            dataType: 'json',
            success: function(data) {
                if (data.result) {
                    edit_autopart_in_table(send_data);
                    location.href = 'Catalog.php';
                } else {
                    alert("Не удалось обновить автозапчасть! Обратитесь в службу поддержки");
                }
            }
        });
    } else {
        alert("Выберите автозапчасить!");
    }
}

function edit_autopart1() {
    if (localStorage.autopart_id == 0) {
        alert("Выберите автозапчасть!");
    }
    else {
        location.href = 'AddAutoparts2.php';
    }
}


function delete_autopart() {
    if (localStorage.autopart_id != 0) {
        let send_data = {
            id : localStorage.autopart_id,
            action: 'delete'
        };
        
        $.ajax({
            type: 'POST',
            url: 'autoparts_db.php',
            data: send_data,
            dataType: 'json',
            success: function(data) {
                if (data.result) {
                    delete_autopart_from_table(localStorage.autopart_id);
                    clear_autopart_form();
                } else {
                    alert("Не удалось удалить автозапчасть! Обратитесь в службу поддержки");
                }
            }
        });
    } else {
        alert("Выберите автозапчасть!");
    }
}

function delete_autopart_from_table(id) {
    $('#autopart-' + id).remove();
    localStorage.autopart_id = 0;
}

function clear_autopart_form() {
    fill_autopart_form(0, '', '', '', '');
}


function fill_autopart_form(id, name, type, description, cost) {
    localStorage.autopart_id = id;
    $('#name').val(name);
    $('#type').val(type);
    $('#description').val(description);
    $('#cost').val(cost);
}

function get_autopart_data() {
    return {
        name:       $('#name').val(),
        type: 		$('#type').val(),
        description:$('#description').val(),
        cost:      	$('#cost').val()
    };
}
 

function add_autopart_to_table(data) {
    $('#autoparts-table').append(
        "<tr id='autopart-" + data.id + "'>" + 
        "<td>" + data.name + "</td>" + 
        "<td>" + data.type + "</td>" + 
        "<td>" + data.description + "</td>" +
        "<td>" + data.cost + "</td>" + 
        "</tr>"
    );
}

function edit_autopart_in_table(data) {
    $('#autopart-' + data.id).html(
        "<td>" + data.name + "</td>" + 
        "<td>" + data.type + "</td>" + 
        "<td>" + data.description + "</td>" + 
        "<td>" + data.cost + "</td>"  
    );
}



function init_show() {
    let send_data = {
            action: 'get_autoparts'
        };
     $.ajax({
            type: 'POST',
            url: 'autoparts_db.php',
            data: send_data,
            dataType: 'json',
            success: function(data) {
                    $('#list').html('');
                    let list = localStorage.getItem('productList');
                    if (list == null) {
                    return;
                    } else {
                    list = JSON.parse(list);
                    }
                    for (i in data.result) {
                        let item = data.result[i];
                    if (list[item.id]) {
                    $('#list').append("<tr id='i" + item.id + "'><td>" + item.id + "</td>" + "<td>" + item.name + "</td>" + "<td>" + item.type + "</td>" + "<td>" + item.description + "</td>" + "<td>" + item.cost + "</td>" + "<td>" +  list[item.id] + "</td>" + "<td>" + (item.cost * list[item.id]) + "</td></tr>");
                  
            } var er = (item.cost * list[item.id]);
        }
            } 

        });
}


function del(event) {
    var id = event.target.parentNode.id.substring(1);
    console.log(id);
    localStorage.autopart_id = id;
    
    list = localStorage.getItem('productList');
    if (list == null) {
        list = {};
    } else {
        list = JSON.parse(list);
    }
    
    if (list[id]) {
        list[id] = list[id] - 1;
    }
    
    localStorage.setItem('productList', JSON.stringify(list));
    init_show();
}

function add_order(event) {
    let send_data = get_order_data();
    send_data.action = 'add';
    
    $.ajax({
        type: 'POST',
        url: 'autoparts_db.php',
        data: send_data,
        dataType: 'json',
        success: function(data) {
            if (data.result) {
                send_data.id = data.result;
                add_autopart_to_table(send_data);
                alert("Автозапчасть " + name + " добавлена");
                location.href = 'Catalog.php';
            } else {
                alert("Ошибка");
            }
        }
    });
}


function add_order(event) {
    let send_data = get_order_data();
    send_data.action = 'add';
    console.log(send_data);
    $.ajax({
        type: 'POST',
        url: 'order_db.php',
        data: send_data,
        dataType: 'json',
        success: function(data) {
            if (data.result) {
                send_data.id = data.result;
            } else {
                alert("Ошибка");
            }
        }
    });
}

function get_order_data() {
    return {
            order_number:      i++,
            client_id: 	       localStorage.client_id,
            sum:               "5000"
    };
        
}                                                                                     
