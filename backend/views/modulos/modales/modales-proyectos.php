<div class="modal fade" id="modal-insertar-proyectos"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insertar Nuevo Proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-nuevo-proyectos">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Titulo" required name="tituloProyectos">
            </div>
          </div>
                  <div class="form-group row">
            <label class="col-sm-2 col-form-label">Subtítulo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Subtítulo" name="SubtituloProyectos">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Imagen</label>
            <div class="col-sm-10 conteNuevaImagen">
              <input type="file" class="form-control"  id="imagen" name="imagenProyectos" required>
              <img src="" id="imagenSlider" alt="" class="thumbnail" width="200" style="display: none">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Descripcion</label>
            <div class="col-sm-10">
              <textarea class="form-control" placeholder="Texto descriptivo" required rows="5" name="descripcionProyectos"></textarea>
            </div>
          </div>

          <input type="hidden" name="tipoOperacion" value="insertarProyectos">
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
<div class="modal fade" id="modal-editar-proyectos"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Proyectos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-editar-proyectos">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Titulo" required name="tituloProyectos">
            </div>
          </div>
              <div class="form-group row">
            <label class="col-sm-2 col-form-label">Subtítulo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Subtítulo" name="SubtituloProyectos">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Imagen</label>
            <div class="col-sm-10 conteEditarImagen">
              <input type="file" class="form-control"  id="imagenEditar" name="imagenProyectos">
              <br>
              <img src="" id="imagenProyectos" alt="" class="thumbnail" width="200">

            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Descripcion</label>
            <div class="col-sm-10">
              <textarea class="form-control" placeholder="Texto descriptivo" required rows="5" name="descripcionProyectos"></textarea>
            </div>
          </div>

          <input type="hidden" name="tipoOperacion" value="actualizarProyectos">
          <input type="hidden" name="rutaActual">
          <input type="hidden" name="id_proyectos">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>