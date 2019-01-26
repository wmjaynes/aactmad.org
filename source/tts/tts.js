var COST_FULL_WEEKEND = 80;
var COST_AACTMAD = 75;
var COST_STUDENT = 50;
var formId = 1;

$(document)
    .ready(
        function () {
            $("input[name='nonMember']").click(function () {
                var thisForm = $(this).closest(".registration");
                thisForm.find('.cost').prop("checked", false);
                $(this).prop("checked", true);

            });
            $("input[name='aactmadMember']").click(function () {
                var thisForm = $(this).closest(".registration");
                thisForm.find('.cost').prop("checked", false);
                $(this).prop("checked", true);
            });
            $("input[name='student']").click(function () {
                var thisForm = $(this).closest(".registration");
                thisForm.find('.cost').prop("checked", false);
                $(this).prop("checked", true);
            });
            $("[name='less']").click(function (event) {
                event.preventDefault();
                var frm = $(this).closest(".registration");
                frm.remove();
                updateAmountDue();
            });
            $("#more").click(
                function (event) {
                    event.preventDefault();
                    var form1 = $("#form1");
                    var street = form1.find("[name='street']")
                        .val();
                    var city = form1.find("[name='city']").val();
                    var state = form1.find("[name='state']").val();
                    var zip = form1.find("[name='zip']").val();
                    var newPern = form1.clone(true);
                    formId++;
                    var newId = "form" + formId;
                    var newIdSelect = "#" + newId;
                    newPern.prop("id", newId);
                    newPern.prop("name", newId);

                    resetForm(newPern);

                    newPern.find("input[name='nonMember']").prop(
                        "checked", true);

                    // newPern[0].reset();
                    newPern.find("[name='less']").show();

                    $("#reg").append(newPern);

                    newPern.find("[name='street']").val(street);
                    newPern.find("[name='city']").val(city);
                    newPern.find("[name='state']").val(state);
                    newPern.find("[name='zip']").val(zip);

                    newPern.find("[name='amtDue']").text(
                        COST_FULL_WEEKEND);
                    updateTotal();
                });

            $("[name='state']").change(function (event) {
                var st = $(this).val().toUpperCase();
                $(this).val(st);
            });

            $(".cost").click(updateAmountDue);

            $("#printButton").click(function (event) {
                event.preventDefault();
                if (!areAllRequiredFieldsFilled()) {
                    alert("Please fill out all required fields.");
                } else {
                    window.print();
                }
            });

            $("[name='amtDue']").text(COST_FULL_WEEKEND);
            updateTotal();

            $('#paypalButton')
                .click(
                    function (event) {
                        event.preventDefault();
                        if (!areAllRequiredFieldsFilled()) {
                            alert("Please fill out all required fields.");
                            return;
                        }
                        var vars = "";
                        var index = 1;
                        var isFirst = true;
                        var item_number = "";
                        $(".registration")
                            .each(
                                function () {
                                    if (isFirst) {
                                        var timestamp = new Date()
                                            .toString('MMddHHmm');
                                        item_number = $(
                                            this)
                                                .find(
                                                    "[name='lastName']")
                                                .val()
                                            + '-'
                                            + timestamp;
                                        isFirst = false;
                                    }
                                    var reginput = $(
                                        this)
                                        .find(
                                            ":input")
                                        .serialize();
                                    reginput = reginput
                                        + '&amtdue='
                                        + Number($(
                                            this)
                                            .find(
                                                "[name='amtDue']")
                                            .text());
                                    vars = vars
                                        + '&'
                                        + reginput
                                            .replace(
                                                /=/g,
                                                index
                                                + '=');
                                    index++;
                                });
                        var paypal = Number($("[name='paypal_charge']")
                            .text());
                        var total = Number($("[name='total']")
                            .text());
                        vars = vars + '&paypal=' + paypal;
                        vars = vars + '&total=' + total;
                        $('#item_number').val(item_number);
                        vars = vars + '&item_number='
                            + item_number;

                        var paypalForm = $('#paypalForm');
                        paypalForm.find('#amount').val(total);
                        paypalForm.find('#item_number').val(
                            item_number);

                        var form = $('#emailForm');
                        var action = form.attr('action');
                        var serialized_form = vars;
                        if (confirm("Please confirm to continue on to PayPal.")) {
                            $.post(action, serialized_form,
                                submit_paypal);
                        }
                    });

        }); // end of ready function

function submit_paypal() {
    $('#paypalForm').submit();
}

function areAllRequiredFieldsFilled() {
    var problem = false;
    $(".registration").each(function () {
        $(this).find(".required").each(function () {
            if (this.value.length == 0) {
                problem = true;
            }
        });
    });
    return !problem;
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val(
        '');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr(
        'selected');
}


function updateAmountDue() {
    var thisForm;
    thisForm = $(this).closest(".registration");
    var cost_full_weekend = COST_FULL_WEEKEND;
    var cost_aactmad = COST_AACTMAD;
    var cost_student = COST_STUDENT;

    var cost = 0;
    if (thisForm.find("[name='nonMember']").is(':checked'))
        cost = cost_full_weekend;
    if (thisForm.find("[name='aactmadMember']").is(':checked'))
        cost = cost_aactmad;
    if (thisForm.find("[name='student']").is(':checked'))
        cost = cost_student;

    /*
    var donationField = thisForm.find("[name='donation']");
    var donation = donationField.value();
    if ($.isNumeric(donation))
        cost = cost + donation;
*/

    cost = cost.toFixed(2);
    thisForm.find("[name='amtDue']").text(cost);
    updateTotal();
}

function updateTotal() {
    var subtotal = 0;
    $(".registration").each(function () {
        subtotal += Number($(this).find("[name='amtDue']").text());
    });

    var total = subtotal;
    total = total.toFixed(2);
    subtotal = subtotal.toFixed(2);
    $("[name='total']").text(total);
}
