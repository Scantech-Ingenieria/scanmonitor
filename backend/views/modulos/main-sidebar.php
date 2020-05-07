<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo substr($_SESSION["avatar"], 3); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["nombre"];?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menú</li>
        <!-- Optionally, you can add icons to the links -->


        <li><a href="slider"><i class="far fa-folder-open"></i> <span>Archivos</span></a></li>


 <li><a href="formulario"><i class="far fa-file-alt"></i> <span>Formulario</span></a></li>

<?php 
if ($_SESSION["rango"]=='superadmin') {
  # code...
?>
        <li><a href="usuarios"><i class="fas fa-user-cog"></i> <span> Configurar Usuarios</span></a></li>

        <?php 
}
        ?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>