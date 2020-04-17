<?php
session_start();
if (!isset($_SESSION["user_id"]) && ($_SESSION["role"] != 'patient')) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome/css/font-awesome.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap/css/bootstrap.min.css">

    <meta charset='utf-8'/>

    <link href='assets/js/fullcalendar/packages/core/main.css' rel='stylesheet'/>
    <link href='assets/js/fullcalendar/packages/daygrid/main.css' rel='stylesheet'/>
    <link href='assets/js/fullcalendar/packages/timegrid/main.css' rel='stylesheet'/>
    <link href='assets/js/fullcalendar/packages/bootstrap/main.css' rel='stylesheet'/>
    <link href='assets/js/fullcalendar/packages/list/main.css' rel='stylesheet'/>

    <script src='assets/js/fullcalendar/packages/core/main.js'></script>
    <script src='assets/js/fullcalendar/packages/daygrid/main.js'></script>
    <script src='assets/js/fullcalendar/packages/timegrid/main.js'></script>
    <script src='assets/js/fullcalendar/packages/list/main.js'></script>
    <script src='assets/js/fullcalendar/packages/bootstrap/main.js'></script>
    <script src="assets/js/jquery.3.2.1.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['bootstrap', 'dayGrid', 'timeGrid', 'list'],
                themeSystem: 'lumen',
                timeZone: 'UTC',
                views: {
                    dayGrid: {},
                    timeGrid: {},
                    week: {},
                    day: {}
                },
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth, timeGridWeek, timeGridDay'
                },
                locale: 'fr',
                buttonText: {
                    today: 'Aujourd\'hui',
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour'
                },
                events: function (info, successCallback, failureCallback) {
                    var url = "actions/loadEvents.php?start=" + dateToString(info.start) + "&end=" + dateToString(info.end);

                    $.ajax(url)
                        .done(function (data) {
                            //Ajax request was successful.
                            if (data[0] === '*') {
                                data = data.replace('*', '');
                            }
                            successCallback(JSON.parse(data));
                        })
                        .fail(function (xhr, status, error) {
                            //Ajax request failed.
                            var errorMessage = xhr.status + ': ' + xhr.statusText
                            alert('Error - ' + errorMessage);
                        })
                },
                eventClick: function (info) {
                    $("#detailModal").modal("show");
                    var dateRdv = document.getElementById("dateRdv");
                    var titleRdv = document.getElementById("titleRDV");
                    var d = info.event.start;
                    var dateString = ("00" + (d.getMonth() + 1)).slice(-2) + "/" +
                        ("00" + d.getDate()).slice(-2) + "/" +
                        d.getFullYear() + " " +
                        ("00" + d.getHours()).slice(-2) + ":" +
                        ("00" + d.getMinutes()).slice(-2) + ":" +
                        ("00" + d.getSeconds()).slice(-2);
                    dateRdv.innerHTML = dateString;
                    titleRdv.innerHTML = info.event.title;
                }
            });
            calendar.setOption('locale', 'fr');
            calendar.setOption('theme', 'bootstrap');
            calendar.render();
        });

        function dateToString(date) {
            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();
            return year + '-' + (monthIndex + 1) + '-' + day;
        }
    </script>
    <style>
        .cal {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 10px;
        }

        .guide {
            display: flex;
        }

        .guide li {
            display: block;
            margin: 0.5rem 1rem;
        }

        .guide li:before {
            content: " ";
            width: 20px;
            height: 20px;
            display: inline-flex;
            margin-right: 10px;;
        }

        .demande:before {
            background-color: #17a2b8;
        }

        .valide:before {
            background-color: #28a745;
        }

        .rejete:before {
            background-color: #eb4040;
        }

        .canceled:before {
            background-color: #eb8b1c;
        }
    </style>
</head>

<body>
<div>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="assets/img/logo.png" width="30" height="30"
                 class="d-inline-block align-top" alt="">
            Tracker
        </a>
        <form class="form-inline">
            <img src="assets/img/default-avatar.png" width="30" height="30"
                 class="d-inline-block align-top" alt="">
            <label class="mr-2"><?php echo $_SESSION["name"];?></label>
            <a href="index.php?logout=logout" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Abmelden</a>
        </form>
    </nav>
</div>
<div>
    <div class="cal">
        <ul class="guide">
            <li class="demande">Demandés</li>
            <li class="valide">Validés</li>
            <li class="rejete">Rejetés</li>
            <li class="canceled">Annulés</li>
        </ul>
    </div>
    <div class="cal" id='calendar'></div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Termin</h5>
            </div>
            <div class="modal-body">
                <div id="dateRdv" class="h3">

                </div>
                <div id="titleRDV" class="mt-3">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Schlißen</button>
            </div>
        </div>
    </div>
</div>
<!--Sweet alert js-->
<script src="assets/js/popper.min.js"></script>
<script src="assets/css/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>