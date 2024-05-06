<div class="line-item container">
    <div class="input-wrapper vertical md-input">
        <label for="truck-label-dropdown">Label</label>
        <select id="truck-label-dropdown" class="truck-label-dropdown" name="truck-label-dropdown[]">
            <option value="" selected>Select truck...</option>
        </select>
    </div>
    <div class="input-wrapper vertical sm-input">
        <label for="truck-quantity">Quantity</label>
        <input type="text" id="truck-quantity" class="truck-quantity numeric" name="truck-quantity[]"/>
    </div>
    <div class="input-wrapper vertical md-input">
        <label for="truck-uom-dropdown">UOM</label>
        <select id="truck-uom-dropdown" class="truck-uom-dropdown" name="truck-uom[]">
            <option value="" selected>Select UOM...</option>
            <option value="Hourly">Hourly</option>
            <option value="Fixed">Fixed</option>
        </select>
    </div>
    <div class="input-wrapper vertical sm-input">
        <label for="truck-rate">Rate ($)</label>
        <input type="text" id="truck-rate" class="truck-rate" name="truck-rate[]" readonly/>
    </div>
    <div class="input-wrapper vertical xs-input">
        <label for="truck-total">Total</label>
        <input type="text" id="truck-total" class="truck-total" name="truck-total[]" readonly/>
    </div>
    <div class="line-item-buttons">
        <button class="add-line-item" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 50 50" fill="#3277A8">
                <path d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 24 13 L 24 24 L 13 24 L 13 26 L 24 26 L 24 37 L 26 37 L 26 26 L 37 26 L 37 24 L 26 24 L 26 13 L 24 13 z"></path>
            </svg>
        </button>
        <button class="remove-line-item" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 50 50" fill="#CC6960">
                <path d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 13 24 L 37 24 L 37 26 L 13 26 L 13 24 z"></path>
            </svg>
        </button>
    </div>
</div>