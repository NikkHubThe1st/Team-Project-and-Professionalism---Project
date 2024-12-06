<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book events</title>
</head>

<body>
    <h1>Book events</h1>

    <form id="bookingForm" action="javascript:alert('form submitted');" method="get">
        <section id="bookEvents">
            <h2>Select events</h2>
            <?php
            try {
                require_once('functions.php');
                $dbConn = getConnection();
                $sqlEvents = 'SELECT eventID, eventTitle, eventStartDate, eventEndDate, catDesc, venueName, eventPrice FROM EGN_events e INNER JOIN EGN_categories c ON e.catID = c.catID INNER JOIN EGN_venues v ON e.venueID = v.venueID ORDER BY eventTitle';
                $rsEvents = $dbConn->query($sqlEvents);

                while ($event = $rsEvents->fetchObject()) {
                    $eventTitle = $event->eventTitle;
                    echo "\t<div class='item'>
                            <span class='eventTitle'>" . filter_var($eventTitle, FILTER_SANITIZE_SPECIAL_CHARS) . "</span>
                            <span class='eventStartDate'>{$event->eventStartDate}</span>
                            <span class='eventEndDate'>{$event->eventEndDate}</span>
                            <span class='catDesc'>{$event->catDesc}</span>
                            <span class='venueName'>{$event->venueName}</span>
                            <span class='eventPrice'>{$event->eventPrice}</span>
                            <span class='chosen'><input type='checkbox' name='event[]' value='{$event->eventID}' data-price='{$event->eventPrice}'></span>
                        </div>\n";
                }
            } catch (Exception $e) {
                echo "Problem " . $e->getMessage();
            }
            ?>
        </section>

        <section id="collection">
            <h2>Collection method</h2>
            <p>Please select whether you want your chosen event ticket(s) to be delivered to your home address (a charge applies for this) or whether you want to collect them yourself.</p>
            <p>
                Home address - &pound;7.99 <input type="radio" name="deliveryType" value="home" data-price="7.99" checked>&nbsp; | &nbsp;
                Collect from ticket office - no charge <input type="radio" name="deliveryType" value="ticketOffice" data-price="0">
            </p>
        </section>

        <section id="checkCost">
            <h2>Total cost</h2>
            Total <input type="text" name="total" size="10" readonly>
        </section>

        <section id="placeBooking">
            <h2>Place booking</h2>
            <h3>Your details</h3>
            <div id="custDetails" class="custDetails">
                Forename <input type="text" name="forename">
                Surname <input type="text" name="surname">
            </div>
            <p style="color: #FF0000; font-weight: bold;" id='termsText'>I have read and agree to the terms and conditions
                <input type="checkbox" name="termsChkbx"></p>
            <p><input type="submit" name="submit" value="Book now!" disabled></p>
        </section>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var bookingForm = document.getElementById('bookingForm');
            var termsCheckbox = document.getElementsByName('termsChkbx')[0];
            var submitButton = document.getElementsByName('submit')[0];
            var eventCheckboxes = document.getElementsByName('event[]');
            var deliveryRadios = document.getElementsByName('deliveryType');
            var totalInput = document.getElementsByName('total')[0];
            var forenameInput = document.getElementsByName('forename')[0];
            var surnameInput = document.getElementsByName('surname')[0];

            termsCheckbox.addEventListener('change', function () {
                if (termsCheckbox.checked) {
                    document.getElementById('termsText').style.color = 'black';
                    document.getElementById('termsText').style.fontWeight = 'normal';
                } else {
                    document.getElementById('termsText').style.color = '#FF0000';
                    document.getElementById('termsText').style.fontWeight = 'bold';
                }
                checkFormValidity();
            });

            eventCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    updateTotalCost();
                    checkFormValidity();
                });
            });

            deliveryRadios.forEach(function (radio) {
                radio.addEventListener('change', function () {
                    updateTotalCost();
                    checkFormValidity();
                });
            });

            forenameInput.addEventListener('input', function () {
                checkFormValidity();
            });

            surnameInput.addEventListener('input', function () {
                checkFormValidity();
            });

            function updateTotalCost() {
                var totalCost = 0;

                eventCheckboxes.forEach(function (checkbox) {
                    if (checkbox.checked) {
                        totalCost += parseFloat(checkbox.getAttribute('data-price'));
                    }
                });

                deliveryRadios.forEach(function (radio) {
                    if (radio.checked) {
                        totalCost += parseFloat(radio.getAttribute('data-price'));
                    }
                });

                totalInput.value = totalCost.toFixed(2);
            }

            function checkFormValidity() {
                var isFormValid =
                    termsCheckbox.checked &&
                    forenameInput.value.trim() !== '' &&
                    surnameInput.value.trim() !== '' &&
                    Array.from(eventCheckboxes).some(function (checkbox) {
                        return checkbox.checked;
                    });

                submitButton.disabled = !isFormValid;
            }
        });
    </script>
</body>

</html>
