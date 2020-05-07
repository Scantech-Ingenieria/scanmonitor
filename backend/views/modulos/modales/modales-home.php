<div class="modal fade" id="modal-insertar-categorias"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insertar Nuevo Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-nuevo-slider">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Titulo" required name="tituloSlider">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Imagen</label>
            <div class="col-sm-10 conteNuevaImagen">
              <input type="file" class="form-control"  id="imagen" name="imagenSlider">
              <img src="" id="imagenSlider" alt="" class="thumbnail" width="200" style="display: none">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Vínculo</label>
            <div class="col-sm-10">
              <input type="text"  class="form-control" placeholder="vínculo" required name="urlSlider">

              
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Descripcion</label>
            <div class="col-sm-10">
              <textarea class="form-control" placeholder="Texto descriptivo" required rows="5" name="descripcionSlider"></textarea>
            </div>
          </div>
       
          <input type="hidden" name="tipoOperacion" value="insertarSlider">
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
<div class="modal fade" id="modal-editar-slider"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-editar-slider">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Titulo" required name="tituloSlider">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Imagen</label>
            <div class="col-sm-10 conteEditarImagen">
              <input type="file" class="form-control"  id="imagenEditar" name="imagenSlider">
              <br>
              <img src="" id="imagenSlider" alt="" class="thumbnail" width="200">

            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Vínculo</label>
            <div class="col-sm-10">
              <input type="text"  class="form-control" placeholder="vínculo" required name="urlSlider">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Descripcion</label>
            <div class="col-sm-10">
              <textarea class="form-control" placeholder="Texto descriptivo" required rows="5" name="descripcionSlider"></textarea>
            </div>
          </div>
       
          <input type="hidden" name="tipoOperacion" value="actualizarSlider">
          <input type="hidden" name="rutaActual">
          <input type="hidden" name="id_slider">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>