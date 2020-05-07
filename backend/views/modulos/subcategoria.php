<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor de subCategorias
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modal-insertar-subcategorias">Registrar <i class="fas fa-plus"></i></button>

      <table class="table table-dark" id="tablasubCategorias">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">urlAmigable</th>
            
            <th scope="col">Acciones </th>
          </tr>
        </thead>
        <tbody>

          <?php 
          
          $subcategorias = ControllersubCategorias::listarsubCategoriasCtr();
          foreach ($subcategorias as $key => $value) {
            echo '
              <tr>
                <th scope="row">'.$value["id"].'</th>
                <td>'.$value["subcategoria"].'</td>
                <td>'.$value["ruta"].'</td>
                <td width="300"> <img src="'.substr($value["imagen"],3 ).'" class="img-fluid" style="width:200px;"></td>
                <td width="100">
                  <button class="btn btn-sm btn-info btnEditarsubCategorias" idsubCategorias="'.$value["id"].'" data-toggle="modal" data-target="#modal-editar-subcategorias">
                    <i class="far fa-edit"></i>
                  </button>
                  <button class="btn btn-sm btn-danger btnEliminarsubCategorias" idsubCategorias="'.$value["id"].'" rutaImagen="'.$value["imagen"].'">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
            ';
          }

          echo "   <script>
   





          
          $('#tablasubCategorias').DataTable();
     
          
          
              </script>";
          ?>
        </tbody>
      </table>

    </section>

 
    <!-- /.content -->
  </div>