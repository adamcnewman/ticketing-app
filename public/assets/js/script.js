/**
 * Initializes the script when the document is ready.
 */
$(document).ready(function() {
    /***** INITIAL PAGE LOAD *****/
    $.ajax({
        url: "assets/handler.php",
        type: "POST",
        data: {
            action: "init_page"
        },
        success: function(data) {
            var jsonData = JSON.parse(data);
            var projectData = jsonData.projectData;
            var staffData = jsonData.staffData;   
            var labourLineItemHTML = jsonData.labourLineItemHTML;
            var truckData = jsonData.truckData; 
            var truckLineItemHTML = jsonData.truckLineItemHTML;

            /* Project Section */
            // Populate customers dropdown
            for (var i = 0; i < projectData.customers.length; i++) {
                var customer = projectData.customers[i];
                $("#customer-dropdown").append("<option value='" + customer.customer_id + "'>" + customer.name + "</option>");
            }
            // Populate jobs dropdown
            for (var i = 0; i < projectData.jobs.length; i++) {
                var job = projectData.jobs[i];
                $("#job-dropdown").append("<option value='" + job.job_id + "'>" + job.name + "</option>");
            }
            // Populate locations dropdown
            for (var i = 0; i < projectData.locations.length; i++) {
                var location = projectData.locations[i];
                $("#location-dropdown").append("<option value='" + location.location_id + "'>" + location.name + "</option>");
            }

            /* Labour Section */
            /* Populate the staff dropdown */
            $("#labour .line-items").append(labourLineItemHTML);
            for (var i = 0; i < staffData.length; i++) {
                var staff = staffData[i];
                $("#staff-dropdown").append("<option value='" + staff.staff_id + "'>" + staff.name + "</option>");
            }

            /* Truck Section */
            /* Populate the truck dropdown */
            $("#truck .line-items").append(truckLineItemHTML);
            for (var i = 0; i < truckData.length; i++) {
                var truck = truckData[i];
                $("#truck .line-item #truck-label-dropdown").append("<option value='" + truck.truck_id + "'>" + truck.label + "</option>");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX request failed: ", jqXHR, textStatus, errorThrown);
        }
    });


    /***** LABOUR *****/ 
    /**
     * Gets the positions when staff dropdown is selected.
     */
    $(document).on("change", "#labour .staff-dropdown", function() {
        lineItem = $(this).closest(".line-item.container");
        var staffVal = lineItem.find(".staff-dropdown").val();
        if (staffVal) {
            $.ajax({
                url: "assets/handler.php",
                type: "POST",
                data: {
                    action: "get_staff_positions",
                    staff_id: staffVal
                },
                success: function(data) {
                    var jsonData = JSON.parse(data);
                    var positionData = jsonData.positions;
                    // Clear any previous position options, if any were present
                    lineItem.find(".position-dropdown").html("<option value='' selected>Select Position...</option>");
                    // Populate the dropdown with the staff's positions
                    for (var i = 0; i < positionData.length; i++) {
                        var position = positionData[i];
                        lineItem.find(".position-dropdown").append("<option value='" + position.position_id + "'>" + position.title + "</option>");
                    }
                    // Reset the Position and UOM dropdowns, and regular/overtime rates
                    lineItem.find(".position-dropdown").val("");
                    lineItem.find(".labour-uom").val("");
                    lineItem.find(".labour-regular-rate").val("");
                    lineItem.find(".labour-overtime-rate").val("");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: ", jqXHR, textStatus, errorThrown);
                }
            });
        } else {
            lineItem.find(".position-dropdown").html("<option value=''>Select Position... </option>");
            lineItem.find(".labour-uom").val("");
            lineItem.find(".labour-regular-rate").val("");
            lineItem.find(".labour-overtime-rate").val("");
        }
    });

    /**
     * Gets the rates of the staff's position when position and UOM dropdowns are selected.
     */
    $(document).on("change", "#labour .position-dropdown, #labour .labour-uom", function() {
        var lineItem = $(this).closest(".line-item.container");
        var positionVal = lineItem.find(".position-dropdown").val();
        var uomVal = lineItem.find(".labour-uom").val();
        if (positionVal, uomVal) {
            $.ajax({
                url: "assets/handler.php",
                type: "POST",
                data: {
                    action: "get_position_rates",
                    position_id: positionVal,
                    uom: uomVal
                },
                success: function(data) {
                    var jsonData = JSON.parse(data);
                    var regularRate = jsonData.regular_rate;
                    var overtimeRate = jsonData.overtime_rate; 
                    lineItem.find(".labour-regular-rate").val(regularRate);
                    lineItem.find(".labour-overtime-rate").val(overtimeRate);
                    calculateLabourTotal();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: ", jqXHR, textStatus, errorThrown);
                }
            });
        } else {
            lineItem.find(".labour-regular-rate").val("");
            lineItem.find(".labour-overtime-rate").val("");
        }
    });

    $(document).on("input", "#labour .labour-regular-hours, #labour .labour-overtime-hours", function() {
        calculateLabourTotal();
    });

    /**
     * Calculates the total cost of the labour line item based on the rates and hours.
     * If a line item uses a fixed rate, the fixed rate gets added to the labour subtotal without
     * consideration of the hours.
     * If a line item uses a regular/overtime rate, the line item's total is calculated 
     * based on the ovetime & regular hours / rates.
     */
    function calculateLabourTotal() {
        var subtotal = 0;
        $("#labour .line-item.container").each(function() {
            var lineItem = $(this);
            var staff = lineItem.find(".staff-dropdown").val();
            var position = lineItem.find(".position-dropdown").val();
            var uom = lineItem.find(".labour-uom").val();
            var regularRate = lineItem.find(".labour-regular-rate").val();
            var regularHours = lineItem.find(".labour-regular-hours").val();
            var overtimeRate = lineItem.find(".labour-overtime-rate").val();
            var overtimeHours = lineItem.find(".labour-overtime-hours").val();
            if (staff && position && uom) {
                if (uom == "Fixed") {
                    var fixedRate = parseFloat(regularRate);
                    if (!isNaN(fixedRate)) {
                        subtotal += fixedRate;
                }
            } else if (uom== "Hourly") {
                var regularTotal = (parseFloat(regularRate).toFixed(2) * parseFloat(regularHours).toFixed(2));
                var overtimeTotal = (parseFloat(overtimeRate).toFixed(2) * parseFloat(overtimeHours).toFixed(2));
                if (!isNaN(regularTotal)) {
                    subtotal += regularTotal;
                }
                if (!isNaN(overtimeTotal)) {
                    subtotal += overtimeTotal;
                }
            }
            
            if (!isNaN(subtotal) || subtotal == 0.00) {
                // Set the subtotal
                $("#labour-subtotal").val(subtotal.toFixed(2));
            } else {
                $("#labour-subtotal").val("");
            }
            }
        });
    }

    /**
     * Adds a new line item to labour section.
     */
        $(document).on("click", "#labour .add-line-item", function() {
            var newItem = $("#labour .line-item.container").first().clone();
            newItem.find("input").val(""); // Clear the values in the cloned inputs
            newItem.find(".position-dropdown").html("<option value=''>Select Position... </option>");
            $("#labour .line-items.container").append(newItem);
        });
    
    /**
     * Removes the labour line item and recalculates the labour subtotal.
     */ 
    $(document).on("click", "#labour .remove-line-item", function() {
        if ($("#labour .line-item.container").length > 1) { // Ensure at least one line item remains
            $(this).closest("#labour .line-item.container").remove();
            calculateLabourTotal(); // Recalculate total after removal
        }
    });


    /***** TRUCK *****/ 
    /**
     * Get the rate of the selected truck & uom when the dropdown selections change.
     */ 
    $(document).on("change", "#truck .truck-label-dropdown, #truck .truck-uom-dropdown", function() {
        var lineItem = $(this).closest(".line-item.container");
        var labelVal = lineItem.find(".truck-label-dropdown").val();
        var uomVal = lineItem.find(".truck-uom-dropdown").val();
        if (labelVal && uomVal) {
            $.ajax({
                url: "assets/handler.php",
                type: "POST",
                data: {
                    action: "get_truck_rate",
                    truck_id: labelVal,
                    uom: uomVal
                },
                success: function(data) {
                    var rate = data;
                    lineItem.find(".truck-rate").val(rate);
                    lineItem.find(".truck-total").val((lineItem.find(".truck-quantity").val() * rate).toFixed(2));
                    calculateTruckSubtotal();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: ", jqXHR, textStatus, errorThrown);
                }
            });
        } else {
            lineItem.find(".truck-rate").val("");
            lineItem.find(".truck-total").val("");
        }
    });

    /**
     * Calculates a truck line item's total and recalculates the subtotal when its quantity changes.
     */
    $(document).on("input", "#truck .truck-quantity", function() {
        lineItem = $(this).closest(".line-item.container");
        var label = lineItem.find(".truck-label-dropdown").val();
        var quantity = lineItem.find(".truck-quantity").val();
        var rate = lineItem.find(".truck-rate").val();
        if (quantity && rate && label) {
            lineItem.find(".truck-total").val((quantity * rate).toFixed(2));
        } else {
            lineItem.find(".truck-total").val("");
        };
        calculateTruckSubtotal();
    });

    /**
     * Calculates the total cost of all truck items and updates the truck subtotal.
     */
    function calculateTruckSubtotal() {
        var subtotal = 0;
        $(".truck-total").each(function() {
            var value = parseFloat($(this).val());
            if (!isNaN(value)) {
                subtotal += value;
            }
        });
        if (subtotal.toFixed(2) == 0.00) {
            // Clear the subtotal if it's 0
            $("#truck-subtotal").val("") 
        }
        else {
            // Set the subtotal
            $("#truck-subtotal").val(subtotal.toFixed(2));
        }
    }

    /**
     * Adds a new line item to truck section.
     */
    $(document).on("click", "#truck .add-line-item", function() {
        var newItem = $("#truck .line-item.container").first().clone();
        newItem.find("input").val(""); // Clear the values in the cloned inputs
        $("#truck .line-items.container").append(newItem);
    });
    
    /**
     * Removes the truck line item and recalculates the truck subtotal.
     */ 
    $(document).on("click", "#truck .remove-line-item", function() {
        if ($("#truck .line-item.container").length > 1) { // Ensure at least one line item remains
            $(this).closest("#truck .line-item.container").remove();
            calculateTruckSubtotal(); // Recalculate subtotal after removal
        }
    });

    /***** MISCELLANEOUS *****/ 
    /**
     * Calculates the total cost of the miscellaneous item based on the price and quantity.
     */
    $(document).on("input", "#misc .misc-quantity, #misc .misc-price", function() {
        var lineItem = $(this).closest(".line-item.container");
        var price = lineItem.find(".misc-price").val();
        var quantity = lineItem.find(".misc-quantity").val();
        if (price && quantity) {
            var total = (price * quantity).toFixed(2);
            lineItem.find(".misc-total").val(total);
        } else {
            lineItem.find(".misc-total").val("");
        }
        calculateMiscSubtotal();
    });

    /**
     * Calculates the total cost of all miscellaneous items and updates the misc subtotal.
     */
    function calculateMiscSubtotal() {
        var subtotal = 0;
        $(".misc-total").each(function() {
            var value = parseFloat($(this).val());
            if (!isNaN(value)) {
                subtotal += value;
            }
        });
        if (subtotal.toFixed(2) == 0) {
            // Clear the subtotal if it's 0
            $("#misc-subtotal").val("") 
        }
        else {
            // Set the subtotal
            $("#misc-subtotal").val(subtotal.toFixed(2));
        }
    }

    /**
     * Adds a new line item to misc section.
     */
    $(document).on("click", "#misc .add-line-item", function() {
        var newItem = $("#misc .line-item.container").first().clone();
        newItem.find("input").val(""); // Clear the values in the cloned inputs
        $("#misc .line-items.container").append(newItem);
    });

    /**
     * Removes the misc line item and recalculates the misc subtotal.
     */ 
    $(document).on("click", "#misc .remove-line-item", function() {
        if ($("#misc .line-item.container").length > 1) { // Ensure at least one line item remains
            $(this).closest("#misc .line-item.container").remove();
            calculateMiscSubtotal(); // Recalculate subtotal after removal
        }
    });
});