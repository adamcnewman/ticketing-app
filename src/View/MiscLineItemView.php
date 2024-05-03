<div class="line-item container">
    <div class="input-wrapper vertical">
        <label for="misc-description">Description</label>
        <input type="text" id="misc-description" class="misc-description" name="misc-description[]"/>
    </div>
    <div class="input-wrapper vertical">
        <label for="misc-cost">Cost</label>
        <input type="number" id="misc-cost" class="misc-cost" name="misc-cost[]" min="0.00" step="0.01"/>
    </div>
    <div class="input-wrapper vertical">
        <label for="misc-price">Price</label>
        <input type="text" id="misc-price" class="misc-price" name="misc-price[]"/>
    </div>
    <div class="input-wrapper vertical">
        <label for="misc-quantity">Quantity</label>
        <input type="text" id="misc-quantity" class="misc-quantity" name="misc-quantity[]"/>
    </div>
    <div class="input-wrapper vertical">
        <label for="misc-total">Total</label>
        <input type="text" id="misc-total" class="misc-total" name="misc-total[]" readonly/>
    </div>
    <div class="line-item-buttons">
        <button class="add-line-item" type="button">+</button>
        <button class="remove-line-item" type="button">-</button>
    </div>
</div>