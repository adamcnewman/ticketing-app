<div id="project" class="section">
    <h2 class="section-header">Project</h2>
    <div class="section-content">
        <div class="column">
            <div class="input-wrapper horizontal">
                <label for="customer-name">Customer Name:</label>
                <select id="customer-name" name="customer-name">
                    <option value="" readonly selected class="readonly">Select Customer...</option>
                    <?php foreach ($projectData["customers"] as $customer): ?>
                        <option value="<?= htmlspecialchars($customer["customer_id"]); ?>">
                            <?= htmlspecialchars($customer["name"]); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-wrapper horizontal">
                <label for="job-name">Job Name:</label>
                <select id="job-name" name="job-name">
                    <option value="" readonly selected class="readonly">Select Job...</option>
                    <?php foreach ($projectData["jobs"] as $job): ?>
                        <option value="<?= htmlspecialchars($job["job_id"]); ?>" data-customer="<?= htmlspecialchars($job["customer_id"])?>">
                            <?= htmlspecialchars($job["name"]); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-wrapper horizontal">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="" readonly selected class="readonly">Select Status...</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="approved">Cancelled</option>
                </select>
            </div>
            <div class="input-wrapper horizontal">
                <label for="location">Location/LSD:</label>
                <select id="location" name="location">
                    <option value="" readonly selected class="readonly">Select LSD...</option>
                    <?php foreach ($projectData["locations"] as $location): ?>
                        <option value="<?= htmlspecialchars($location["location_id"]); ?>" data-job="<?= htmlspecialchars($location["location_id"])?>">
                            <?= htmlspecialchars($location["name"]); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="column">
            <div class="input-wrapper horizontal">
                <label for="ordered-by">Ordered By:</label>
                <input type="text" id="ordered-by" name="ordered-by"/>
            </div>
            <div class="input-wrapper horizontal">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date"/> 
            </div>
            <div class="input-wrapper horizontal">
                <label for="area">Area/Field:</label>
                <input type="text" id="area" name="area"/>
            </div>
        </div>
    </div>
</div>