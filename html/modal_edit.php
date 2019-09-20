<div id="editProductModal" class="modal fade">
        <div class="modal-dialog">
                <div class="modal-content">
                        <form name="edit_product" id="edit_product">
                                <div class="modal-header">
                                        <h4 class="modal-title">Editar Contacto</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                        </button>
                                </div>
                                <div class="modal-body">

                                        <input type="hidden" name="id" id="edit_id">
                                        <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" name="name" id="edit_name" class="form-control"
                                                       required>
                                        </div>
                                        <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" name="lname" id="edit_lname" class="form-control"
                                                       required>
                                        </div>
                                        <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" id="edit_email" class="form-control"
                                                       required>
                                        </div>
                                        <div class="form-group">
                                                <label>Categoría</label>
                                                <input type="text" data-role="tagsinput" name="cat" id="edit_category"
                                                       class="form-control" required>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal"
                                               value="Cancelar">
                                        <input type="submit" class="btn btn-info" value="Guardar">
                                </div>
                        </form>
                </div>
        </div>
</div>
