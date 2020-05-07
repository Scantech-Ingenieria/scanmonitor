

<!-- EDITAR SLIDER -->
<div class="modal fade" id="modal-editar-inicio"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Información Inicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-editar-inicio">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
              <textarea class="form-control" placeholder="Texto descriptivo" required rows="5" name="descripcionInicio"></textarea>
            </div>
          </div>

          <input type="hidden" name="tipoOperacion" value="actualizarInicio">
          <input type="hidden" name="id_Inicio">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>