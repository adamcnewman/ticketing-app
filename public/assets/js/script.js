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
    $(document).on("change", "#staff-dropdown", function() {
        if ($("#staff-dropdown").val()) {
            $.ajax({
                url: "assets/handler.php",
                type: "POST",
                data: {
                    action: "get_staff_positions",
                    staff_id: $("#staff-dropdown").val()
                },
                success: function(data) {
                    var jsonData = JSON.parse(data);
                    var positionData = jsonData.positions;
                    // Clear any previous options, if any were present
                    $("#position-dropdown").html("<option value='' selected>Select Position...</option>");
                    for (var i = 0; i < positionData.length; i++) {
                        var position = positionData[i];
                        $("#position-dropdown").append("<option value='" + position.position_id + "'>" + position.title + "</option>");
                    }
                    // Reset the Position and UOM dropdowns, and regular/overtime rates
                    $("#position-dropdown").val("");
                    $("#labour-uom").val("");
                    $("#labour-regular-rate").val("");
                    $("#labour-overtime-rate").val("");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: ", jqXHR, textStatus, errorThrown);
                }
            });
        } else {
            $("#position-dropdown").html("<option value=''>Select Position... </option>");
            $("#labour-uom").val("");
            $("#labour-regular-rate").val("");
            $("#labour-overtime-rate").val("");
        }
    });

    $(document).on("change", "#position-dropdown, #labour-uom", function() {
        if ($("#position-dropdown").val() && $("#labour-uom").val()) {
            $.ajax({
                url: "assets/handler.php",
                type: "POST",
                data: {
                    action: "get_position_rates",
                    position_id: $("#position-dropdown").val(),
                    uom: $("#labour-uom").val()
                },
                success: function(data) {
                    var jsonData = JSON.parse(data);
                    var regularRate = jsonData.regular_rate;
                    var overtimeRate = jsonData.overtime_rate; 
                    $("#labour-regular-rate").val(regularRate);
                    $("#labour-overtime-rate").val(overtimeRate);
                    // calculateLabourItemTotal();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: ", jqXHR, textStatus, errorThrown);
                }
            });
        } else {
            $("#labour-regular-rate").val("");
            $("#labour-overtime-rate").val("");
        }
    });


    /***** TRUCK *****/ 
    /**
     * Calculates the total cost of the truck item based on the quantity and rate.
     */
    function calculateTruckItemTotal() {
        if ($("#truck-quantity").val() && $("#truck-rate").val()) {
            var quantity = $("#truck-quantity").val();
            var rate = $("#truck-rate").val();
            var total = (quantity * rate).toFixed(2);
            $("#truck-total").val(total);
        } else {
            $("#truck-total").val("");
        }
    }

    /**
     * Triggers calculateTruckItemTotal() when the quantity input changes.
     */
    $(document).on("input", "#truck-quantity", function() {
        if ($("#truck-quantity").val()) {
            calculateTruckItemTotal();
        } else {
            $("#truck-total").val("");
        };
    });

    /**
     * Get the rate of the selected truck & uom when the dropdown selections change.
     */ 
    $(document).on("change", "#truck-label-dropdown, #truck-uom-dropdown", function() {
        if ($("#truck-label-dropdown").val() && $("#truck-uom-dropdown").val()) {
            $.ajax({
                url: "assets/handler.php",
                type: "POST",
                data: {
                    action: "get_truck_rate",
                    truck_id: $("#truck-label-dropdown").val(),
                    uom: $("#truck-uom-dropdown").val()
                },
                success: function(data) {
                    $("#truck-rate").val(data);
                    calculateTruckItemTotal();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: ", jqXHR, textStatus, errorThrown);
                }
            });
        } else {
            $("#truck-rate").val("");
            $("#truck-total").val("");
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
            console.log(total);
            lineItem.find(".misc-total").val(total);
            calculateMiscSubtotal();
        }
    });

    /**
     * Calculates the total cost of all miscellaneous items and update the subtotal.
     */
    function calculateMiscSubtotal() {
        var subtotal = 0;
        $(".misc-total").each(function() {
            var value = parseFloat($(this).val());
            if (!isNaN(value)) {
                subtotal += value;
            }
        });
        $("#misc-subtotal").val(subtotal.toFixed(2));
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