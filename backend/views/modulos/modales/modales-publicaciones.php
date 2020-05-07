<div class="modal fade" id="modal-insertar-publicaciones"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insertar Nuevo Proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-nuevo-publicaciones">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Titulo" required name="tituloPublicaciones">
            </div>
          </div>
                  <div class="form-group row">
            <label class="col-sm-2 col-form-label">Subtítulo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Subtítulo" name="SubtituloPublicaciones">
            </div>
          </div>
                 <div class="form-group row">
            <label class="col-sm-2 col-form-label">Autor</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Autor" name="AutorPublicaciones">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Imagen</label>
            <div class="col-sm-10 conteNuevaImagen">
              <input type="file" class="form-control"  id="imagen" name="imagenPublicaciones" required>
              <img src="" id="imagenSlider" alt="" class="thumbnail" width="150" style="display: none">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Descripcion</label>
            <div class="col-sm-10">
              <textarea class="form-control" placeholder="Texto descriptivo"  rows="10" name="descripcionPublicaciones"></textarea>
            </div>
          </div>

          <input type="hidden" name="tipoOperacion" value="insertarPublicaciones">
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
<div class="modal fade" id="modal-editar-publicaciones"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Publicaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-editar-publicaciones">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Titulo" required name="tituloPublicaciones">
            </div>
          </div>
              <div class="form-group row">
            <label class="col-sm-2 col-form-label">Subtítulo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Subtítulo" name="SubtituloPublicaciones">
            </div>
          </div>
              <div class="form-group row">
            <label class="col-sm-2 col-form-label">Autor</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Autor" name="AutorPublicaciones">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Imagen</label>
            <div class="col-sm-10 conteEditarImagen">
              <input type="file" class="form-control"  id="imagenEditar" name="imagenPublicaciones">
              <br>
              <img src="" id="imagenPublicaciones" alt="" class="thumbnail" width="150">

            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Descripcion</label>
            <div class="col-sm-10">
              <textarea class="form-control" placeholder="Texto descriptivo"  rows="10" name="descripcionPublicaciones"></textarea>
            </div>
          </div>

          <input type="hidden" name="tipoOperacion" value="actualizarPublicaciones">
          <input type="hidden" name="rutaActual">
          <input type="hidden" name="id_publicaciones">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>