<div id="project" class="section">
    <h2 class="section-header">Project</h2>
    <div class="section-content">
        <div class="column">
            <div class="input-wrapper horizontal">
                <label for="customer-dropdown">Customer Name:</label>
                <select required id="customer-dropdown" name="customer-dropdown">
                    <option value="" readonly selected class="readonly">Select Customer...</option>
                </select>
            </div>
            <div class="input-wrapper horizontal">
                <label for="job-dropdown">Job Name:</label>
                <select required id="job-dropdown" name="job-dropdown">
                    <option value="" readonly selected class="readonly">Select Job...</option>
                </select>
            </div>
            <div class="input-wrapper horizontal">
                <label for="status">Status:</label>
                <select required id="status" name="status">
                    <option value="" readonly selected class="readonly">Select Status...</option>
                    <option value="Pending">Pending</option>
                    <option value="Active">Active</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>
            <div class="input-wrapper horizontal">
                <label for="location-dropdown">Location/LSD:</label>
                <select required id="location-dropdown" name="location-dropdown">
                    <option value="" readonly selected class="readonly">Select LSD...</option>
                </select>
            </div>
        </div>
        <div class="column">
            <div class="input-wrapper horizontal">
                <label for="ordered-by">Ordered By:</label>
                <input required type="text" id="ordered-by" name="ordered-by"/>
            </div>
            <div class="input-wrapper horizontal">
                <label for="date">Date:</label>
                <input required type="date" id="date" name="date"/> 
            </div>
            <div class="input-wrapper horizontal">
                <label for="area">Area/Field:</label>
                <input required type="text" id="area" name="area"/>
            </div>
        </div>
    </div>
</div>