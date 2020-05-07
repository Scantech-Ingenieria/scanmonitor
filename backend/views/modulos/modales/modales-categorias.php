<div class="modal fade" id="modal-insertar-categorias"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generar Nueva Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-nuevo-categorias">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nombre </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="El nombre de la categoria es..." required name="tituloCategorias" onkeyup="insertar(this.value,'urlAmigable')">
            </div>
          </div>
                   <div class="form-group row">
            <label class="col-sm-2 col-form-label">Url Amigable</label>
            <div class="col-sm-10">
              <input type="text" readonly="readonly" class="form-control" placeholder="La url amigable se verá aquí " required name="urlAmigable"
              id="urlAmigable">
            </div>
            
          </div>
  
       
          <input type="hidden" name="tipoOperacion" value="insertarCategorias">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- EDITAR SLIDER -->
<div class="modal fade" id="modal-editar-categorias"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Categorias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-editar-categorias">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Titulo" required name="tituloCategorias">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Vínculo</label>
            <div class="col-sm-10">
              <input type="text"  class="form-control" placeholder="vínculo" required name="urlCategorias">
            </div>
          </div>
       
          <input type="hidden" name="tipoOperacion" value="actualizarCategorias">
          <input type="hidden" name="rutaActual">
          <input type="hidden" name="id_categorias">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>