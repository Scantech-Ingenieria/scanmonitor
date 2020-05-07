<div class="modal fade" id="modal-insertar-Usuarios"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generar Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-nuevo-usuarios">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nombre </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="ingrese su nombre de usuario..." required name="tituloUsuarios" >
            </div>
          </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Correo</label>
            <div class="col-sm-10">
              <input type="email"  class="form-control" placeholder="ingrese correo" required name="correoUsuarios">
            </div>
            </div>

            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="text"  class="form-control" placeholder="ingrese clave" required name="passUsuarios">
         </div>

          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Avatar</label>
            <div class="col-sm-10 conteNuevaImagen">
              <input type="file" class="form-control"  id="imagen" name="imagenUsuarios">
              <img src="" id="imagenUsuarios" alt="" class="thumbnail" width="200" style="display: none">
            </div>
          </div>


          <input type="hidden" name="tipoOperacion" value="insertarUsuarios">
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
<div class="modal fade" id="modal-editar-Usuarios"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-editar-Usuarios">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Nombre" required name="tituloUsuarios">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Imagen</label>
            <div class="col-sm-10 conteEditarImagen">
              <input type="file" class="form-control"  id="imagenEditar" name="imagenUsuarios">
              <br>
              <img src="" id="imagenUsuarios" alt="" class="thumbnail" width="200">

            </div>
          </div>
  <div class="form-group row">
            <label class="col-sm-2 col-form-label">Correo</label>
            <div class="col-sm-10">
              <input type="text"  class="form-control" placeholder="Correo" required name="correo">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="text"  class="form-control" placeholder="Contraseña" required name="urlUsuarios">
            </div>
          </div>


          <input type="hidden" name="tipoOperacion" value="actualizarUsuarios">
          <input type="hidden" name="rutaActual">
          <input type="hidden" name="id_Usuarios">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>