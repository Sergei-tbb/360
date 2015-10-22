/**
 * Created by sasha on 17.10.15.
 */
$(document).on('click', '#delivery-add', function(){

    var body = getPageData('admin', 'delivery_new_company', 'html');

    bootbox.dialog({
        message: body,
        title: "Создание новой компании доставки",
        buttons: {
            success: {
                label: "Создать",
                className: "btn-success",
                callback: function()
                {
                    var name = $('input[name="name"]').val();
                    var website = $('input[name="website"]').val();

                    $.ajax({
                        url: '/index.php/ajax/delivery/Delivery/new_delivery_company',
                        type: 'POST',
                        data: {name: name, website: website},
                        success: function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateList('delivery/Delivery', 'get_list_delivery_companies', 'delivery');
                        },
                        error: function(data)
                        {
                            bootbox.alert(data, function(){});
                        }
                    });
                }
            },
            danger: {
                label: "Закрыть",
                className: "btn-danger",
                callback: function() {}
            }
        }
    });

});

$(document).on('click', '.delete-delivery', function(){
    var id = $(this).parent().parent('tr').data('id_company');

    bootbox.confirm('Вы уверены, что хотите удалить данную компанию доставки?', function(result){

        if(result==true) {
            $.ajax({
                url: '/index.php/ajax/delivery/Delivery/delete_delivery_company/' + id,
                success: function (data)
                {
                    bootbox.alert(data, function(){});
                    updateList('delivery/Delivery', 'get_list_delivery_companies', 'delivery');
                },
                error: function (data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }
    });
});

$(document).on('click', '.edit-delivery', function() {
    var id = $(this).parent().parent('tr').data('id_company');

    $.ajax({
        url: '/index.php/ajax/delivery/Delivery/get_one_company/'+id,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Изменение данных компании доставки",
                buttons: {
                    success: {
                        label: "Создать",
                        className: "btn-success",
                        callback: function()
                        {
                            var name = $('input[name="name"]').val();
                            var website = $('input[name="website"]').val();
                            var id = $('input[name="id"]').val();
                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery/edit_delivery_company/'+id,
                                type: 'POST',
                                data: {name: name, website: website},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateList('delivery/Delivery', 'get_list_delivery_companies', 'delivery');
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on('click', '#country-add', function(){

    var body = getPageData('admin', 'delivery_new_country', 'html');

    bootbox.dialog({
        message: body,
        title: "Создание страны",
        buttons: {
            success: {
                label: "Создать",
                className: "btn-success",
                callback: function()
                {
                    var name = $('input[name="name"]').val();

                    $.ajax({
                        url: '/index.php/ajax/delivery/Delivery_countries/add_country',
                        type: 'POST',
                        data: {name: name},
                        success: function(data)
                        {
                            bootbox.alert(data, function(){});
                            updateList('delivery/Delivery_countries', 'get_list_countries', 'countries');
                        },
                        error: function(data)
                        {
                            bootbox.alert(data, function(){});
                        }
                    });
                }
            },
            danger: {
                label: "Закрыть",
                className: "btn-danger",
                callback: function() {}
            }
        }
    });
});

$(document).on('click', '.country-delete', function(){
    var id = $(this).parent().parent('tr').data('id_country');

    bootbox.confirm('Вы уверены, что хотите удалить данную страну?', function(result){

        if(result==true) {
            $.ajax({
                url: '/index.php/ajax/delivery/Delivery_countries/delete_country/' + id,
                success: function (data)
                {
                    bootbox.alert(data, function(){});
                    updateList('delivery/Delivery_countries', 'get_list_countries', 'countries');
                },
                error: function (data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }
    });
});

$(document).on('click', '.country-edit', function() {

    var id = $(this).parent().parent('tr').data('id_country');

    $.ajax({
        url: '/index.php/ajax/delivery/Delivery_countries/get_one_country/'+id,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Изменение данных страны",
                buttons: {
                    success: {
                        label: "Изменить",
                        className: "btn-success",
                        callback: function()
                        {
                            var name = $('input[name="name"]').val();
                            var id = $('input[name="id"]').val();
                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery_countries/edit_country/'+id,
                                type: 'POST',
                                data: {name: name},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateList('delivery/Delivery_countries', 'get_list_countries', 'countries');
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});


$(document).on('click', '#region-add', function(){

    $.ajax({
        url: '/index.php/ajax/delivery/Delivery_regions/load_new_region/',
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Новый региона",
                buttons: {
                    success: {
                        label: "Создать",
                        className: "btn-success",
                        callback: function()
                        {
                            var name = $('input[name="region"]').val();
                            var country = $('select[name="country"] option:selected').val();

                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery_regions/add_region/',
                                type: 'POST',
                                data: {name: name, id_country: country},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateList('delivery/Delivery_regions', 'get_list_regions', 'regions');
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on('click', '.region-delete', function(){
    var id = $(this).parent().parent('tr').data('id_region');

    bootbox.confirm('Вы уверены, что хотите удалить данный регион?', function(result){

        if(result==true) {
            $.ajax({
                url: '/index.php/ajax/delivery/Delivery_regions/delete_region/' + id,
                success: function (data)
                {
                    bootbox.alert(data, function(){});
                    updateList('delivery/Delivery_regions', 'get_list_regions', 'regions');
                },
                error: function (data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }
    });
});

$(document).on('click', '.region-edit', function() {

    var id = $(this).parent().parent('tr').data('id_region');

    $.ajax({
        url: '/index.php/ajax/delivery/Delivery_regions/get_one_region/'+id,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Изменение данных региона",
                buttons: {
                    success: {
                        label: "Изменить",
                        className: "btn-success",
                        callback: function()
                        {
                            var country = $('select[name="country"] option:selected').val();
                            var name = $('input[name="region"]').val();
                            var id = $('input[name="id"]').val();
                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery_regions/edit_region/'+id,
                                type: 'POST',
                                data: {name: name, id_country: country},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateList('delivery/Delivery_regions', 'get_list_regions', 'regions');
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on('click', '#city-add', function(){

    var modal_body = getPageData('admin', 'delivery_cities_new', 'html');
            bootbox.dialog({
                message: modal_body,
                title: "Новый города",
                buttons: {
                    success: {
                        label: "Создать",
                        className: "btn-success",
                        callback: function () {
                            var name = $('input[name="name"]').val();

                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery_cities/add_city/',
                                type: 'POST',
                                data: {name: name},
                                success: function (data) {
                                    bootbox.alert(data, function () {
                                    });
                                    updateList('delivery/Delivery_cities', 'get_list_cities', 'cities');
                                },
                                error: function (data) {
                                    bootbox.alert(data, function () {
                                    });
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function () {
                        }
                    }
                }
            });
});

$(document).on('click', '.city-delete', function(){
    var id = $(this).parent().parent('tr').data('id_city');

    bootbox.confirm('Вы уверены, что хотите удалить данный город?', function(result){

        if(result==true) {
            $.ajax({
                url: '/index.php/ajax/delivery/Delivery_cities/delete_city/' + id,
                success: function (data)
                {
                    bootbox.alert(data, function(){});
                    updateList('delivery/Delivery_cities', 'get_list_cities', 'cities');
                },
                error: function (data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }
    });
});

$(document).on('click', '.city-edit', function() {

    var id = $(this).parent().parent('tr').data('id_city');

    $.ajax({
        url: '/index.php/ajax/delivery/Delivery_cities/get_one_city/'+id,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Изменение данных города",
                buttons: {
                    success: {
                        label: "Изменить",
                        className: "btn-success",
                        callback: function()
                        {
                            var name = $('input[name="name"]').val();
                            var id = $('input[name="id"]').val();
                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery_cities/edit_city/'+id,
                                type: 'POST',
                                data: {name: name},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateList('delivery/Delivery_cities', 'get_list_cities', 'cities');
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on('click', '.city-streets', function() {

    var id_city = $(this).parent().parent('tr').data('id_city');
    $.ajax({
        url: '/index.php/ajax/delivery/Delivery_streets/load_streets/'+id_city,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Добавление улиц",
                buttons: {
                    success: {
                        label: "Изменить",
                        className: "btn-success",
                        callback: function()
                        {
                            var city = $('input[name="id"]').val();
                            var id_street = $('select[name="streets"]').val();
                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery_streets/create_city_street/',
                                type: 'POST',
                                data: {id_street: id_street, id_city: city},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateList('delivery/Delivery_cities', 'get_list_cities', 'cities');
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});



$(document).on('click', '#street-add', function(){

    var modal_body = getPageData('admin', 'delivery_streets_new', 'html');
    bootbox.dialog({
        message: modal_body,
        title: "Новая улица",
        buttons: {
            success: {
                label: "Создать",
                className: "btn-success",
                callback: function () {
                    var name = $('input[name="street"]').val();

                    $.ajax({
                        url: '/index.php/ajax/delivery/Delivery_streets/add_street/',
                        type: 'POST',
                        data: {name: name},
                        success: function (data) {
                            bootbox.alert(data, function () {
                            });
                            updateList('delivery/Delivery_streets', 'get_list_streets', 'streets');
                        },
                        error: function (data) {
                            bootbox.alert(data, function () {
                            });
                        }
                    });
                }
            },
            danger: {
                label: "Закрыть",
                className: "btn-danger",
                callback: function () {
                }
            }
        }
    });
});

$(document).on('click', '.street-delete', function(){
    var id = $(this).parent().parent('tr').data('id_street');

    bootbox.confirm('Вы уверены, что хотите удалить данную улицу?', function(result){

        if(result==true) {
            $.ajax({
                url: '/index.php/ajax/delivery/Delivery_streets/delete_street/' + id,
                success: function (data)
                {
                    bootbox.alert(data, function(){});
                    updateList('delivery/Delivery_streets', 'get_list_streets', 'streets');
                },
                error: function (data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }
    });
});

$(document).on('click', '.street-edit', function() {

    var id = $(this).parent().parent('tr').data('id_street');

    $.ajax({
        url: '/index.php/ajax/delivery/Delivery_streets/get_one_street/'+id,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Изменение данных улицы",
                buttons: {
                    success: {
                        label: "Изменить",
                        className: "btn-success",
                        callback: function()
                        {
                            var name = $('input[name="street"]').val();
                            var id = $('input[name="id"]').val();
                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery_streets/edit_street/'+id,
                                type: 'POST',
                                data: {name: name},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                    updateList('delivery/Delivery_streets', 'get_list_streets', 'streets');
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on('click', '.add-department', function() {
    var id_company = $(this).parent().parent('tr').data('id_company');
    $.ajax({
        url: '/index.php/ajax/delivery/Delivery/load_delivery_department_view/'+id_company,
        success: function(data)
        {
            bootbox.dialog({
                message: data,
                title: "Новое отделение",
                buttons: {
                    success: {
                        label: "Создать",
                        className: "btn-success",
                        callback: function()
                        {
                            var country = $('select[name="country"] option:selected').val();
                            var region = $('select[name="region"] option:selected').val();
                            var city = $('select[name="city"] option:selected').val();
                            var street = $('select[name="street"] option:selected').val();
                            var house_number = $('input[name="house_number"]').val();
                            var department_number = $('input[name="house_number"]').val();
                            var zip = $('input[name="zip"]').val();
                            var phone = $('input[name="phone"]').val();
                            var id = $('input[name="id"]').val();

                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery_addresses/new_department/'+id,
                                type: 'POST',
                                data: {id_company: id, id_country: country, id_region: region, id_city: city, id_street: street, house_number: house_number, department_number: department_number, zip: zip, phone: phone},
                                success: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                },
                                error: function(data)
                                {
                                    bootbox.alert(data, function(){});
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function() {}
                    }
                }
            });
        }

    });
});

$(document).on('click', '.country-region', function(){

    var id_country = $(this).parent().parent('tr').data('id_country');

    $.ajax({
        url: '/index.php/ajax/delivery/Delivery_countries/load_countries_regions_view/'+id_country,
        success: function(data) {
            bootbox.dialog({
                message: data,
                title: "Добавление региона в страну",
                buttons: {
                    success: {
                        label: "Создать",
                        className: "btn-success",
                        callback: function () {
                            var region = $('select[name="region"]').val();
                            var id_country = $('input[name="id"]').val();

                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery_regions/add_country_regions/',
                                type: 'POST',
                                data: {id_country: id_country, id_region: region},
                                success: function (data) {
                                    bootbox.alert(data, function () {
                                    });
                                    updateList('delivery/Delivery_countries', 'get_list_countries', 'countries');
                                },
                                error: function (data) {
                                    bootbox.alert(data, function () {
                                    });
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function () {
                        }
                    }
                }
            });
        },
        error: function(data)
        {
            bootbox.alert(data, function(){});
        }
    });
});

$(document).on('click', '.region-city', function(){

    var id_region = $(this).parent().parent('tr').data('id_region');

    $.ajax({
        url: '/index.php/ajax/delivery/Delivery_regions/load_regions_cities/'+id_region,
        success: function(data) {
            bootbox.dialog({
                message: data,
                title: "Добавление города в регион",
                buttons: {
                    success: {
                        label: "Создать",
                        className: "btn-success",
                        callback: function () {
                            var id_city = $('select[name="cities"]').val();
                            var id_region = $('input[name="id"]').val();

                            $.ajax({
                                url: '/index.php/ajax/delivery/Delivery_cities/add_regions_cities/',
                                type: 'POST',
                                data: {id_region: id_region, id_city: id_city},
                                success: function (data) {
                                    bootbox.alert(data, function () {
                                    });
                                    updateList('delivery/Delivery_regions', 'get_list_regions', 'regions');
                                },
                                error: function (data) {
                                    bootbox.alert(data, function () {
                                    });
                                }
                            });
                        }
                    },
                    danger: {
                        label: "Закрыть",
                        className: "btn-danger",
                        callback: function () {
                        }
                    }
                }
            });
        },
        error: function(data)
        {
            bootbox.alert(data, function(){});
        }
    });
});

$(document).on('click', '.department-delete', function(){
    var id = $(this).parent().parent('tr').data('id_address');

    bootbox.confirm('Вы уверены, что хотите удалить выбранное отделение?', function(result){

        if(result==true) {
            $.ajax({
                url: '/index.php/ajax/delivery/Delivery_addresses/delete_department/' + id,
                success: function (data)
                {
                    bootbox.alert(data, function(){});
                    updateList('delivery/Delivery_addresses', 'get_list_addresses', 'addresses');
                },
                error: function (data)
                {
                    bootbox.alert(data, function(){});
                }
            });
        }
    });
});




