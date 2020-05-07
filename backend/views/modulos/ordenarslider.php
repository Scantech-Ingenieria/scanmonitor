<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor de archivos

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
        
            <th scope="col">Imagen</th>
      
          </tr>
        </thead>
        <tbody>

          <?php

          $slider = ControllerSlider::listarSliderCtr();

          foreach ($slider as $key => $value) {
            echo '
              <tr>
                <th scope="row">'.$value["id"].'</th>
      
                <td><img width="300" src="'.substr($value["rutaImg"], 3).'"></td>
                <td width="100">
             
                
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