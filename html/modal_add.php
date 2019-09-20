<div id="addcontactModal" class="modal fade">
        <div class="modal-dialog">
                <div class="modal-content">
                        <form name="add_contact" id="add_contact">
                                <div class="modal-header">
                                        <h4 class="modal-title">Agregar Contacto</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                        </button>
                                </div>
                                <div class="modal-body">

                                        <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" name="name" id="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" name="lname" id="lname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" id="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                                <label>Categoría</label>
                                                <input type="text" data-role="tagsinput" value="Amsterdam,Washington" name="cat" id="category" class="form-control"
                                                       required>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal"
                                               value="Cancelar">
                                        <input type="submit" class="btn btn-success" value="Guardar">
                                </div>
                        </form>
                </div>
        </div>
</div>
