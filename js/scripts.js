$(function () {
    load(1);
});

function load(page) {
    let query = $("#q").val();
    let per_page = 5;
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

$('#editcontactModal').on('show.bs.modal', function (event) {
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

$('#deletecontactModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let id = button.data('id');

    $('#delete_id').val(id);
});

$("#edit_contact").submit(function (event) {
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
            $('#editcontactModal').modal('hide');
        }
    });
    event.preventDefault();
});

$("#add_contact").submit(function (event) {
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
            $('#addcontactModal').modal('hide');
        }
    });
    event.preventDefault();
});

$("#delete_contact").submit(function (event) {
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
            $('#deletecontactModal').modal('hide');
        }
    });
    event.preventDefault();
});

let tags = '';

$('#tags > span').each(function () {
    tags = tags + $(this).html() + ',';
});

$('#category').val(tags);

$("#tags input").on({
    focusout: function () {
        var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig, ''); // allowed characters
        if (txt) $("<span/>", {text: txt.toLowerCase(), insertBefore: this});
        this.value = "";
    },
    keyup: function (ev) {
        // if: comma|enter (delimit more keyCodes with | pipe)
        if (/(188|13)/.test(ev.which)) $(this).focusout();
    }
});

$('#tags').on('click', 'span', function () {
    $(this).remove();
});

function add_tags(tag, arrtags) {
    let index = -1;
    let res = control_tags(tag, arrtags);

    for (let i = 0; i < arrtags.length; i++) {
        if (arrtags[i] === tag) {
            index = i;
        }
    }

    if (index > -1) {
        arrtags[index] = tag;
    } else {
        arrtags.push(tag);
    }

    return res;
}

function control_tags(needle, haystack) {
    var length = haystack.length;

    for (var i = 0; i < length; i++) {
        if (typeof haystack[i] == 'object') {
            if (arrayCompare(haystack[i], needle)) return true;
        } else {
            if (haystack[i] === needle) return true;
        }
    }

    return false;
}

function delete_tags(array, element) {
    const index = array.indexOf(element);
    array.splice(index, 1);
}

let arr_db = [];
let user_tags = [];

$("#tags input").on({
    focusout: function () {
        let txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig, ''); // allowed characters
        if (txt) {
            // Check if array contains value before creating span
            if ((tags.indexOf(txt) === -1)) {
                $('#message').hide();
                $("<span/>", {
                    text: txt.toLowerCase(),
                    insertBefore: this
                });
            } else {
                $('#message').show();
            }
        }
        tags.push(txt);
        this.value = "";
    },
    keyup: function (ev) {
        // if: comma|enter (delimit more keyCodes with | pipe)
        if (/(188|13)/.test(ev.which)) $(this).focusout();
    }
});

// $("#tags input").on({
//     focusout: function () {
//         let txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig, ''); // allowed characters
//
//         // Aqui agregamos los tags escritos por el usuario y los cuales quiere agregar
//         let control = add_tags(txt.toLowerCase(), user_tags);
//
//         // Lo siguiente verifica que el tag ingresado sea de los permitidos en base de datos
//         let check_tags = control_tags(txt.toLowerCase(), arr_db);
//
//         // control debe retornar false con esto evitamos que se inserten tags repetidos
//         // verifica_tags debe retornar true, esto quiere decir que el tag esta guardado en la base de datos
//         if (txt && control === false && check_tags === true) {
//             $("<span/>",
//                 {
//                     text: txt.toLowerCase(),
//                     insertBefore: this
//                 });
//         }
//         this.value = "";
//     },
//     keyup: function (ev) {
//         // if: comma|enter (delimit more keyCodes with | pipe)
//         if (/(188|13)/.test(ev.which)) $(this).focusout();
//     }
// });

$.ajax({
    url: 'ajax/tags.php',
    success: function (res) {
        let returnedData = JSON.parse(res);
        let total = returnedData.length;

        for (let i = 0; i < total; i++) {
            arr_db.push(returnedData[i]);
        }
    }
});

$('#tags').on('click', 'span', function () {
    $(this).remove();

    delete_tags(user_tags, $(this).text());
});

$(function () {
    'strict mode';

    /**
     * Creamos un nuevo tipo de error para manejarlo más adelante.
     * @param {string} msg
     */
    var InvalidTag = function (msg) {
        this.message = msg;
        this.stack = (new Error()).stack;
    }
    InvalidTag.prototype = Object.create(Error.prototype);
    InvalidTag.prototype.name = 'InvalidTag';

    /**
     * Tags es creado para ser manejado como objeto (POO).
     *
     * @type {Object}
     *
     * @property {Array<string>} allowed  Etiquetas permitidas.
     * @property {number} maxAllowed      Número máximo permitido de etiquetas.
     * @property {Object} errors          Contiene los objetos de errores.
     * @property {Object} container       Es creado de `null` para que no herede un prototipo.
     */
    var Tags = {
        allowed: ['html', 'css', 'javascript', 'php', 'java', 'mysql'],
        maxAllowed: 4,
        errors: {
            invalid: new InvalidTag('The tag is invalid.'),
            duplicated: new InvalidTag('You can not add duplicate labels.'),
            noMoreTags: new InvalidTag('Can not add more than 4 tags.')
        },

        container: Object.create(null),

        /**
         * Aquí van las reglas para normalizar la cadena de texto que representa la
         * etiqueta.
         *
         * @param  {string} tag
         * @return {string}
         */
        normalize: function (tag) {
            return tag.toLowerCase().trim();
        },

        /**
         * Añade una etiqueta a la propiedad `container` de este objeto y al elemento
         * en el DOM.
         *
         * @param {string} tag
         * @param {Boolean} normalize
         */
        add: function (tag, normalize) {
            tag = normalize ? this.normalize(tag) : tag;

            if (Object.keys(this.container).length >= this.maxAllowed)
                throw this.errors.noMoreTags;

            if (!this.isValid(tag)) throw this.errors.invalid;
            if (Tags.exists(tag)) throw this.errors.duplicated;

            this.container[tag] = $('<span>', {class: 'tag', text: tag});
            $('.container .tags').append(this.container[tag]);
        },

        /**
         * Remueve una etiqueta en la propiedad `container` de este objeto y el elemento
         * en el DOM.
         *
         * @param {string} tag
         * @param {Boolean} normalize
         */
        remove: function (tag, normalize) {
            tag = normalize ? this.normalize(tag) : tag;

            if (this.exists(tag)) {
                this.container[tag].remove();
                delete this.container[tag];
            }
        },

        /**
         * Devuelve un booleano en función de que la etiqueta (tag) se encuentre dentro
         * de las etiquetas permitidas (this.allowed).
         *
         * @param  {string}  tag
         * @return {Boolean}
         */
        isValid: function (tag) {
            return this.allowed.indexOf(tag) > -1;
        },

        /**
         * Valida que la etiqueta ya exista dentro del contenedor (container).
         *
         * @param  {string} tag
         * @return {Boolean}
         */
        exists: function (tag) {
            return (tag in this.container);
        },

        /**
         * Devuelve un los textos de las etiquetas separadas por coma (,).
         *
         * @see {@link https://developer.mozilla.org/es/docs/Web/JavaScript/Referencia/Objetos_globales/Array/join}
         * @return {string}
         */
        toString: function () {
            return Object.keys(this.container).join();
        }
    };

    /**
     * Este evento se ejecutará cada que el usuario presione «Enter» debido a que
     * el evento está a la espera de un `submit`.
     *
     * Descomentar estas líneas siguientes para habilitar el envío de datos.
     * Está comentada para funcionar en StackOverflow Español.
     */
    /**
     $('.AjaxForm').on('submit',function(e) {
    var data = {};
    data.tags = Tags.toString();

    $.ajax({
      method: 'POST',
      url: 'post.php',
      data: data,
      success: function(response) {
        console.log(response);
      }
    });

    e.preventDefault();
    e.stopPropagation();
  });*/

    $('.allowed_tags').text(Tags.allowed.toString());

    $(document).on({
        /**
         * Función que se encargará de añadir las etiquetas.
         *
         * @param  {Event} e
         */
        keyup: function handler(e) {
            if (e.type !== 'blur' && e.type !== 'keyup') return;
            if (e.type === 'keyup' && $(this).val().indexOf(',') === -1) return;
            if ($(this).val() === '') return;

            try {
                Tags.add($(this).val().replace(',', ''), true);
            } catch (ex) {
                if (ex instanceof InvalidTag) $('.error').text(ex.message);
                else throw ex;
            } finally {
                $(this).val('');
            }
        },

        focus: function () {
            $('.error').text('');
        }
    }, '#input');

    $('.tags').on('click', '.tag', function () {
        Tags.remove($(this).text(), true);
    });

});
