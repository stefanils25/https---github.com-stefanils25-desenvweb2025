<div class="escala">
    <?php foreach ($escala as $valor => $descricao): ?>
        <label class="item-escala">
            <input type="radio" name="nota" value="<?php echo $valor; ?>" required>
            <span><?php echo $valor; ?></span>
            <small><?php echo htmlspecialchars($descricao); ?></small>
        </label>
    <?php endforeach; ?>
</div>
