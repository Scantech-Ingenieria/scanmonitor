<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor de Usuarios
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modal-insertar-Usuarios">Agregar USUARIO <i class="fas fa-plus"></i></button>

      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Avatar</th>
          </tr>
        </thead>
        <tbody>

          <?php

          $usuarios = ControllerUsuarios::listarUsuariosCtr();

          foreach ($usuarios as $key => $value) {
            echo '
              <tr>
                <th scope="row">'.$value["id_admin"].'</th>
                <td>'.$value["nombre_admin"].'</td>
                <td>'.$value["correo_admin"].'</td>

                <td><img width="200" src="'.substr($value["avatar_admin"], 3).'"></td>
                <td width="100">
                  <button class="btn btn-sm btn-info btnEditarUsuarios" idUsuarios="'.$value["id_admin"].'" data-toggle="modal" data-target="#modal-editar-Usuarios">
                    <i class="far fa-edit"></i>
                  </button>
                  <button class="btn btn-sm btn-danger btnEliminarUsuarios" idUsuarios="'.$value["id_admin"].'" rutaImagen="'.$value["avatar_admin"].'">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
            ';
          }
          ?>
        </tbody>
      </table>

    </section>
    <!-- /.content -->
  </div>