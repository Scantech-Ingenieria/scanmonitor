<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Gestor menú inicio

      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">


      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>

            <th scope="col">Acciones</th>

          </tr>
        </thead>
        <tbody>

          <?php

          $inicio = ControllerInicio::listarInicioCtr();

          foreach ($inicio as $key => $value) {
            echo '
              <tr>
                <th scope="row">'.$value["id_info"].'</th>
                <td>'.nl2br($value["informacion"]).'</td>
                <td width="100">
                 <button class="btn btn-sm btn-info btnEditarInicio" idInicio="'.$value["id_info"].'" data-toggle="modal" data-target="#modal-editar-inicio">
                    <i class="far fa-edit"></i>
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