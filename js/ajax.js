$(function () {
    load(1);
});

function load(page) {
    let query = $("#q").val();
    let per_page = 10;
    let param = {"action": "ajax", "page": page, 'query': query, 'per_page': per_page};

    $("#loader").fadeIn('slow');

    $.ajax({
        url: 'ajax/read_contact.php',
        data: param,
        beforeSend: function () {
            $("#loader").html("Cargando...");
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
        }
    })
}

$('#editProductModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal

    let id = button.data('id');
    let name = button.data('name');
    let lname = button.data('lname');
    let email = button.data('email');
    let cat = button.data('cat');

    $('#edit_id').val(id);
    $('#edit_name').val(name);
    $('#edit_lname').val(lname);
    $('#edit_email').val(email);
    $('#edit_category').val(cat);
});

$('#deleteProductModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let id = button.data('id');

    $('#delete_id').val(id);
});

$("#edit_product").submit(function (event) {
    let param = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "ajax/update_contact.php",
        data: param,
        beforeSend: function () {
            $("#resultados").html("Enviando...");
        },
        success: function (datos) {
            $("#resultados").html(datos);
            load(1);
            $('#editProductModal').modal('hide');
        }
    });
    event.preventDefault();
});

$("#add_product").submit(function (event) {
    let param = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "ajax/create_contact.php",
        data: param,
        beforeSend: function () {
            $("#resultados").html("Enviando...");
        },
        success: function (datos) {
            $("#resultados").html(datos);
            load(1);
            $('#addProductModal').modal('hide');
        }
    });
    event.preventDefault();
});

$("#delete_product").submit(function (event) {
    let param = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "ajax/delete_contact.php",
        data: param,
        beforeSend: function () {
            $("#resultados").html("Enviando...");
        },
        success: function (datos) {
            $("#resultados").html(datos);
            load(1);
            $('#deleteProductModal').modal('hide');
        }
    });
    event.preventDefault();
});

var cat = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
        url: 'assets/citynames.json',
        filter: function (list) {
            return $.map(list, function (cityname) {
                return {name: cityname};
            });
        }
    }
});
cat.initialize();

$('#category').tagsinput({
    typeaheadjs: {
        name: 'citynames',
        displayKey: 'name',
        valueKey: 'name',
        source: cat.ttAdapter()
    }
});