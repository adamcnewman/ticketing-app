<div class="line-item container">
    <div class="input-wrapper vertical">
        <label for="truck-label-dropdown">Label</label>
        <select id="truck-label-dropdown" class="truck-label-dropdown" name="truck-label-dropdown[]">
            <option value="" selected>Select truck...</option>
        </select>
    </div>
    <div class="input-wrapper vertical">
        <label for="truck-quantity">Quantity</label>
        <input type="text" id="truck-quantity" class="truck-quantity" name="truck-quantity[]"/>
    </div>
    <div class="input-wrapper vertical">
        <label for="truck-uom-dropdown">UOM</label>
        <select id="truck-uom-dropdown" class="truck-uom-dropdown" name="truck-uom[]">
            <option value="" selected>Select UOM...</option>
            <option value="Hourly">Hourly</option>
            <option value="Fixed">Fixed</option>
        </select>
    </div>
    <div class="input-wrapper vertical">
        <label for="truck-rate">Rate ($)</label>
        <input type="text" id="truck-rate" class="truck-rate" name="truck-rate[]" readonly/>
    </div>
    <div class="input-wrapper vertical">
        <label for="truck-total">Total</label>
        <input type="text" id="truck-total" class="truck-total" name="truck-total[]" readonly/>
    </div>
    <div class="line-item-buttons">
        <button class="add-line-item" type="button">+</button>
        <button class="remove-line-item" type="button">-</button>
    </div>
</div>