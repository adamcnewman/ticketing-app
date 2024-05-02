<div id="truck-line-item" class="line-item container" data-line-item-no="1">
    <div class="input-wrapper vertical">
        <label for="truck-label-dropdown">Label</label>
        <select id="truck-label-dropdown" name="truck-label">
            <option value="" readonly selected class="readonly">Select truck...</option>
            <?php foreach ($trucks as $truck): ?>
            <option value="<?= htmlspecialchars($truck["truck_id"])?>"><?= htmlspecialchars($truck["label"])?></option>
            <?php endforeach?>
        </select>
    </div>
    <div class="input-wrapper vertical">
        <label for="truck-quantity">Quantity</label>
        <input type="text" id="truck-quantity" name="truck-quantity"/>
    </div>
    <div class="input-wrapper vertical">
        <label for="truck-uom-dropdown">UOM</label>
        <select id="truck-uom-dropdown" name="truck-uom">
            <option value="" readonly selected class="readonly">Select UOM...</option>
            <option value="Hourly">Hourly</option>
            <option value="Fixed">Fixed</option>
        </select>
    </div>
    <div class="input-wrapper vertical">
        <label for="truck-rate">Rate ($)</label>
        <input type="text" id="truck-rate" name="truck-rate" readonly class="readonly"/>
    </div>
    <div class="input-wrapper vertical">
        <label for="truck-total">Total</label>
        <input type="text" id="truck-total" name="truck-total" readonly class="readonly"/>
    </div>
    <div class="line-item-buttons">
            <button class="add-line-item" type="button">+</button>
            <button class="remove-line-item" type="button">-</button>
    </div>
</div>