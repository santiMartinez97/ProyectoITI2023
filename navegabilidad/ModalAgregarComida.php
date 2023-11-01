<?php
$menu = $pdo->prepare("SELECT ID, Nombre FROM `menu` WHERE Habilitacion = 'Habilitado';");
$menu->execute();
$resultado2 = $menu->fetchAll(PDO::FETCH_ASSOC);
?>

<!--ventana para Update--->
<div class="modal fade" id="editChildresn<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #FF8000 !important;">
        <h6 class="modal-title" style="color: #fff; text-align: center;">
          Actualizar Información
        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form enctype="multipart/form-data" method="POST" action="../Clases/menu_contiene_vianda.php">
        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
        <div class="modal-body" id="cont_modal">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">ID</label>
                <input type="text" name="id" class="form-control" value="<?php echo $row['ID']; ?>" required="true" readonly>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Vianda a agregar:</label>
                <select id="nombres" name="menu_id">
                  <option value="">Selecciona un nombre</option>
                  <?php
                  foreach ($resultado2 as $menu) {
                    $nombreMenu = $menu['Nombre'];
                    $idMenu = $menu['ID'];
                    echo '<option value="' . $idMenu . '">' . $nombreMenu . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary submit-button">Agregar menu</button>
            <p class="botonAlerta grupo_input-error col-6 text-center">Complete correctamente los campos por favor.</p>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!---fin ventana Update --->