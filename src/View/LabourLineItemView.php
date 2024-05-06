<div class="line-item container">
    <div class="input-wrapper vertical lg-input">
        <label for="staff-dropdown">Staff</label>
        <select id="staff-dropdown" class="staff-dropdown" name="staff-dropdown[]">
            <option value="" selected>Select Staff...</option>
        </select>
    </div>
    <div class="input-wrapper vertical xl-input">
        <label for="position-dropdown">Position</label>
        <select id="position-dropdown" class="position-dropdown" name="labour-position[]">
            <option value="" selected>Select Position...</option>
        </select>
    </div>
    <div class="input-wrapper vertical md-input">
        <label for="labour-uom">UOM</label>
        <select id="labour-uom" class="labour-uom" name="labour-uom[]">
            <option value="" selected>Select UOM...</option>
            <option value="Hourly">Hourly</option>
            <option value="Fixed">Fixed</option>
        </select>
    </div>
    <div class="input-wrapper vertical reg-rate xs-input">
        <label for="labour-regular-rate">Regular Rate</label>
        <input type="text" id="labour-regular-rate" class="labour-regular-rate" name="labour-regular-rate[]" readonly/>
    </div>
    <div class="input-wrapper vertical reg-hours xs-input">
        <label for="labour-regular-hours">Regular Hours</label>
        <input type="text" id="labour-regular-hours" class="labour-regular-hours numeric" name="labour-regular-hours[]"/>
    </div>
    <div class="input-wrapper vertical ot-rate xs-input">
        <label for="labour-overtime-rate">Overtime Rate</label>
        <input type="text" id="labour-overtime-rate" class="labour-overtime-rate" name="labour-overtime-rate[]" readonly/>
    </div>
    <div class="input-wrapper vertical ot-hours xs-input">
        <label for="labour-overtime-hours">Overtime Hours</label>
        <input type="text" id="labour-overtime-hours" class="labour-overtime-hours numeric" name="labour-overtime-hours[]"/>
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