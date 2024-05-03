<div class="line-item container">
    <div class="input-wrapper vertical">
        <label for="staff-dropdown">Staff</label>
        <select id="staff-dropdown" name="staff-dropdown[]">
            <option value="" selected>Select Staff...</option>
        </select>
    </div>
    <div class="input-wrapper vertical">
        <label for="position-dropdown">Position</label>
        <select id="position-dropdown" name="labour-position[]">
            <option value="" selected>Select Position...</option>
        </select>
    </div>
    <div class="input-wrapper vertical">
        <label for="labour-uom">UOM</label>
        <select id="labour-uom" name="labour-uom[]">
            <option value="" selected>Select UOM...</option>
            <option value="Hourly">Hourly</option>
            <option value="Fixed">Fixed</option>
        </select>
    </div>
    <div class="input-wrapper vertical">
        <label for="labour-regular-rate">Regular Rate</label>
        <input type="text" id="labour-regular-rate" name="labour-regular-rate[]" readonly/>
    </div>
    <div class="input-wrapper vertical">
        <label for="labour-regular-hours">Regular Hours</label>
        <input type="text" id="labour-regular-hours" name="labour-regular-hours[]"/>
    </div>
    <div class="input-wrapper vertical">
        <label for="labour-overtime-rate">Overtime Rate</label>
        <input type="text" id="labour-overtime-rate" name="labour-overtime-rate[]" readonly/>
    </div>
    <div class="input-wrapper vertical">
        <label for="labour-overtime-hours">Overtime Hours</label>
        <input type="text" id="labour-overtime-hours" name="labour-overtime-hours[]"/>
    </div>
</div>