
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


      <form id="formularioMenus"  method="POST" action="ActualizarMenu.php" >
        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
<div class="modal-body" id="cont_modal">

<div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">ID</label>
                <input type="text" name="id" class="form-control" value="<?php echo $row['ID']; ?>" disabled>
            </div>
        </div>
    </div>


   <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Periodicidad:</label>
            <select id="periodicidad" name="periodicidad" class="form-control" required="true">
                <option value="<?php echo $row['Periodicidad']; ?>"><?php echo $row['Periodicidad']; ?></option>
                <option value="Semanal">Semanal</option>
                <option value="Quincenal">Quincenal</option>
                <option value="Mensual">Mensual</option>
            </select>



             <!-- <input type="text" name="periodicidad" class="form-control" value="<?php echo $row['Periodicidad']; ?>" required="true"> -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Nombre:</label>
                <input id="nombreMenu" type="text" name="nombre" class="form-control" value="<?php echo $row['Nombre']; ?>" required="true">
            </div>
        </div>

       
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Precio:</label>
                <input id="precio" type="text" name="precio" class="form-control" value="<?php echo $row['Precio']; ?>" required="true">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Descuento:</label>
                <input id="descuento" type="text" name="descuento" class="form-control" value="<?php echo $row['Descuento']; ?>" required="true">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Stock:</label>
                <input id="stock" type="text" name="stock" class="form-control" value="<?php echo $row['Stock']; ?>" required="true">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">stockMin:</label>
                <input id="stockmin" type="text" name="stockMinimo" class="form-control" value="<?php echo $row['StockMinimo']; ?>" required="true">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">stockMax:</label>
                <input id="stockmax" type="text" name="stockMaximo" class="form-control" value="<?php echo $row['StockMaximo']; ?>" required="true">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Descripcion</label>
                <input id="descripcion" type="text" name="descripcion" class="form-control" value="<?php echo $row['Descripcion']; ?>" required="true">
            </div>
        </div>
    </div>

                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
       </form>

    </div>
  </div>
</div>

<!---fin ventana Update --->
