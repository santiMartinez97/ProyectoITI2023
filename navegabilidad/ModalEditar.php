
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


      <form enctype="multipart/form-data" method="POST" action="ActualizarMenu.php">
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
        <div class="col-md-6 grupo__nombre">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control formulario__input" value="<?php echo $row['Nombre']; ?>" required="true">
                <p class="grupo_input-error">Ingrese un nombre válido. </p>
            </div>
        </div>

       
    </div>

    <div class="row">
        <div class="col-md-4 grupo__precio">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Precio:</label>
                <input type="text" name="precio" class="form-control formulario__input" value="<?php echo $row['Precio']; ?>" required="true">
                <p class="grupo_input-error">Ingrese precio válido. </p>
            </div>
        </div>

        <div class="col-md-4 grupo__descuento">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Descuento:</label>
                <input type="text" name="descuento" class="form-control formulario__input" value="<?php echo $row['Descuento']; ?>" required="true">
                <p class="grupo_input-error">Ingrese un descuento válido. </p>
            </div>
        </div>

        <div class="col-md-4 grupo__stock">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Stock:</label>
                <input type="text" name="stock" class="form-control formulario__input" value="<?php echo $row['Stock']; ?>" required="true">
                <p class="grupo_input-error">Ingrese stock válido. </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 grupo__stockMinimo">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">stockMinimo:</label>
                <input type="text" name="stockMinimo" class="form-control formulario__input" value="<?php echo $row['StockMinimo']; ?>" required="true">
                <p class="grupo_input-error">Ingrese stock válido. </p>
            </div>
        </div>

        <div class="col-md-4 grupo__stockMaximo">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">stockMaximo:</label>
                <input type="text" name="stockMaximo" class="form-control formulario__input" value="<?php echo $row['StockMaximo']; ?>" required="true">
                <p class="grupo_input-error">Ingrese stock válido. </p>
            </div>
        </div>

        <div class="col-md-4 grupo__descripcion">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Descripcion:</label>
                <input type="text" name="descripcion" class="form-control formulario__input" value="<?php echo $row['Descripcion']; ?>" required="true">
                <p class="grupo_input-error">Ingrese una descripción válida. </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grupo__imagen">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Imagen</label><a href="#" class="ver-imagen"> (Ver imagen cargada)</a>
                <div class="imagen-preview">
                    <img src="../imgCatalogo/<?php echo $row['Imagen']; ?>" alt="Vista previa de la imagen">
                </div>
                <input type="file" name="imagen" class="form-control formulario__input">
                <p class="grupo_input-error">Solamente se aceptan formatos .jpg, .jpeg, .gif y .png. La imagen no debe superar 1 MB. </p>
            </div>
        </div>
    </div>

                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary submit-button">Guardar Cambios</button>
              <p class="botonAlerta grupo_input-error col-6 text-center">Complete correctamente los campos por favor.</p>
            </div>
       </form>

    </div>
  </div>
</div>
<!---fin ventana Update --->
