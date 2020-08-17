@extends('admin.layouts.app')

@section('head_link')

{{-- Only for Calendar --}}
<link rel="stylesheet" href="/plugins/fullcalendar/main.min.css">
<link rel="stylesheet" href="/plugins/fullcalendar-daygrid/main.min.css">
<link rel="stylesheet" href="/plugins/fullcalendar-timegrid/main.min.css">
<link rel="stylesheet" href="/plugins/fullcalendar-bootstrap/main.min.css">

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="sticky-top mb-3">
                    <form method="get">
                        @csrf
                        <div class="card" id="external-events">
                            <div class="card-header">
                                <h3 class="card-title">Select Car</h3>
                            </div>
                            <div class="card-body text-center">
                                <div class="input-group">
                                    <div class="form-group col-md-12">
                                        <label>Marca</label>
                                        <select id="brand" class="form-control ">
                                            <option value={{null}}>Seleccione una Marca</option>
                                            @foreach ($brands as $brand)
                                                <option value={{$brand->id}}>{{$brand->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="form-group col-md-12">
                                        <label>Model</label>
                                        <select id="models" name="model" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Buscar Placas</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>


                    @if ($cars!=null)

                        <div class="card" id="external-events">
                            <div class="card-header">
                                <h3 class="card-title">Matriculas</h3>
                            </div>

                            @foreach ($cars as $car)
                            <form method="get">

                            <div class="card-body text-center">
                                <input name="car_id" value={{$car->id}} style="display: none">
                                <button type="submit" class="btn btn-primary">{{$car->registration}}</button>
                            </div>
                            </form>
                            @endforeach


                        </div>

                    @endif

                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

@endsection

@section('footer_scripts')
    <!-- fullCalendar 2.2.5 -->
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/fullcalendar/main.min.js"></script>
    <script src="/plugins/fullcalendar-daygrid/main.min.js"></script>
    <script src="/plugins/fullcalendar-timegrid/main.min.js"></script>
    <script src="/plugins/fullcalendar-interaction/main.min.js"></script>
    <script src="/plugins/fullcalendar-bootstrap/main.min.js"></script>


    <script>

$('#document').ready(function () {
        $('#brand').on('change', function () {
            var brand_id = this.value;
            Models(brand_id);
        });
    });

    var Models = function (brand_id) {
        $.ajax({
                url: 'http://car_rental.test/Car/Models',
                method: 'GET',
                data: {
                    brand_id: brand_id
                },
            })
            .done(function (result) {
                result = JSON.parse(result);
                $("#models").empty().append('<option value="-1" disabled>Seleccione un Modelo</option>');
                $.each(result, function (i, model) {
                    $("#models").append('<option  value="' + model.id + '">' +
                        model.name + '</option>');
                });
            });
    }

    </script>

    <script>





        $(function () {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function () {

                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this)
                            .text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0 //  original position after the drag
                    })

                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendarInteraction.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function (eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null)
                            .getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'color'),
                    };
                }
            });

            var events = {!! json_encode($eventos) !!}

            var calendar = new Calendar(calendarEl, {
                plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                'themeSystem': 'bootstrap',
                //Random default events

                events,
                editable: false,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function (info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });

            calendar.render();
            // $('#calendar').fullCalendar()

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function (e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')
                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })
            $('#add-new-event').click(function (e) {
                e.preventDefault()
                // Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                // Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)
                $('#external-events').prepend(event)

                // Add draggable funtionality
                ini_events(event)

                // Remove event from text input
                $('#new-event').val('')
            })
        })

    </script>
@endsection
