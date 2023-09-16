<h1>
    <?php echo ($action == 'edit') ? 'Modificar ' : 'Nueva ' ?>Tarea
</h1>
<form method="POST" action="tareas.php?action=<?php echo $action; ?>">
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <input type="text" name="data[descripcion]" class="form-control" placeholder="Descripcion"
            value="<?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?>" required minlength="3"
            maxlength="50" />
    </div>
    <div class="mb-3">
        <label class="form-label">Estado de la tarea</label>
        <select name="data[id_estado]" class="form-control" required>
            <?php
            foreach ($dataestado as $key => $estado):
                $selected = " ";
                if ($estado['id_estado'] == $data[0]['id_estado']):
                    $selected = " selected";
                endif;
                ?>
                <option value="<?php echo $estado['id_estado']; ?>" <?php echo $selected; ?>>
                    <?php echo $estado['estado']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <?php if ($action == 'edit'): ?>
            <input type="hidden" name="data[id_tarea]"
                value="<?php echo isset($data[0]['id_tarea']) ? $data[0]['id_tarea'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
</form>