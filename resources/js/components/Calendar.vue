<template>
    <main>

        <div class="bg-gray-light  m-5" style="margin-top: 100px!important; height: 100vh">

            <FullCalendar :options="calendarOptions" style="background-color: white; margin-bottom: 100px;"/>

        </div>

        <!--        Event Adding Starts-->


        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="addEditEventModal"
             role="dialog"
             tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-show="!eventEditmode">Add Event</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-show="eventEditmode">Update Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">


                        <form enctype="multipart/form-data" id="changelogFormId">


                            <div class="form-group">


                                <input :class="{ 'is-invalid': eventForm.errors.has('title') }"
                                       aria-describedby="title"
                                       class="form-control"
                                       id="title"
                                       placeholder="Event Title" type="text" v-model="eventForm.title"
                                >
                                <has-error :form="eventForm" field="title"></has-error>


                            </div>
                            <hr>


                            <div class="row">
                                <div class="col">

                                    <date-picker :class="{ 'is-invalid': eventForm.errors.has('date') }"
                                                 class="form-group"
                                                 format="YYYY-MM-DD"
                                                 id="date"
                                                 name="dateofChange"
                                                 placeholder="Date Of Shift"
                                                 type="date"
                                                 v-model="eventForm.date"
                                                 valueType="format">

                                    </date-picker>
                                    <has-error :form="eventForm" field="date"></has-error>
                                </div>

                                <div class="col">

                                    <input :class="{ 'is-invalid': eventForm.errors.has('color') }"
                                           aria-describedby="title"
                                           class="form-control"
                                           id="color"
                                           placeholder="Add Event Color. Exp: Red" type="color"
                                           v-model="eventForm.color"
                                    >
                                    <has-error :form="eventForm" field="color"></has-error>


                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col">
                                    <date-picker :class="{ 'is-invalid': eventForm.errors.has('starts') }"
                                                 class="form-group"

                                                 format="HH:mm" id="starts"
                                                 name="outageWindow"
                                                 placeholder="Starts"
                                                 type="time"
                                                 v-model="eventForm.starts"
                                                 valueType="format"

                                                 width="50">

                                    </date-picker>
                                    <has-error :form="eventForm" field="starts"></has-error>
                                </div>
                                <div class="col">
                                    <date-picker :class="{ 'is-invalid': eventForm.errors.has('ends') }"
                                                 class="form-group"

                                                 format="HH:mm" id="ends"
                                                 name="outageWindow"
                                                 placeholder="Ends"
                                                 type="time"
                                                 v-model="eventForm.ends"
                                                 valueType="format"
                                                 width="50">

                                    </date-picker>
                                    <has-error :form="eventForm" field="ends"></has-error>
                                </div>
                            </div>


                            <div class="modal-footer">

                                <div class="container">
                                    <div class="row">

                                        <div class="col-12">
                                            <button @click.prevent="deleteEvent()"
                                                    class="btn btn-danger float-start"
                                                    type="submit"
                                                    v-show="eventEditmode && !showPleaseWaitBtn">Delete
                                            </button>

                                            <button @click.prevent="updateEvent()"
                                                    class="btn btn-success float-end"
                                                    type="submit"
                                                    v-show="eventEditmode && !showPleaseWaitBtn">Update
                                            </button>


                                            <div class="d-grid gap-2">
                                                <button @click.prevent="createEvent()"
                                                        class="btn btn-primary"
                                                        type="submit"
                                                        v-show="!eventEditmode && !showPleaseWaitBtn">Create
                                                </button>
                                            </div>

                                            <!--                                            <button class="btn btn-primary float-right btn-block"-->

                                            <!--                                                    disabled-->
                                            <!--                                                    type="submit" v-show="showPleaseWaitBtn">-->
                                            <!--                                                <div class="spinner-border text-warning" role="status">-->

                                            <!--                                                </div>-->
                                            <!--                                                Please wait...-->
                                            <!--                                            </button>-->

                                            <div class="center" v-show="showPleaseWaitBtn">

                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>

                        </form>
                    </div>


                </div>

            </div>

        </div>


        <!--        Event Adding Ends-->


    </main>
</template>

<script>


    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import '@fullcalendar/core/vdom'
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'


    import interactionPlugin from '@fullcalendar/interaction'
    import timeGridPlugin from '@fullcalendar/timegrid';

    import esLocale from '@fullcalendar/core/locales/en-gb';


    export default {
        name: "Calendar",
        components: {
            FullCalendar
        },
        data() {
            return {

                disabled: false,

                eventEditmode: false,
                showPleaseWaitBtn: false,

                eventForm: new Form({
                    id: this.eventId,

                    title: '',
                    date: '',
                    starts: '',
                    color: '',
                    ends: '',


                }),

                calendarOptions: {
                    plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
                    initialView: 'timeGridWeek',
                    weekends: false,
                    contentHeight: 560,
                    allDaySlot: true,
                    editable: true,
                    selectable: true,
                    displayEventEnd: true,

                    locale: 'en-gb',

                    eventResize: (info) => {
                        this.eventMoving(info);

                    },


                    eventDrop: (info) => {

                        this.eventMoving(info);

                    },


                    select: (info) => {

                        this.selectCalendar(info);
                    },


                    eventTimeFormat: { // like '14:30:00'
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false,

                        meridiem: true
                    },
                    slotLabelFormat: {
                        hour: '2-digit',
                        minute: '2-digit',

                        hour12: false,

                    },


                    slotMinTime: "08:00:00",
                    slotMaxTime: "18:00:00",

                    headerToolbar: {
                        right: 'dayGridMonth,timeGridWeek,timeGridDay',

                        center: 'title',
                        left: 'today,prev,next'
                    },


                    events: "",
                    eventClick: info => {

                        this.editShift(info);

                    },


                }
            }

        },
        methods: {


            eventMoving(info) {
                console.log("event id=" + info.event.color);
                console.log(info.event);


                //Starts time starts

                let newDateStarts = new Date(info.event.start);

                var rangeFirstDay = (newDateStarts.getDate() < 10 ? '0' : '') + newDateStarts.getDate();
                var rangeFirstMonth = (newDateStarts.getMonth() < 9 ? '0' : '') + (newDateStarts.getMonth() + 1);

                var rangeFirstYear = newDateStarts.getFullYear();
                var fullOfRangeFirst = rangeFirstYear + "-" + rangeFirstMonth + "-" + rangeFirstDay;

                this.eventForm.date = fullOfRangeFirst;

                var getHours = (newDateStarts.getHours() < 10 ? '0' : '') + newDateStarts.getHours();
                var getMinutes = (newDateStarts.getMinutes() < 10 ? '0' : '') + newDateStarts.getMinutes();
                var fullTimeStart = getHours + ":" + getMinutes;
                this.eventForm.starts = fullTimeStart;

                //Starts time ends

                //Ends time starts
                let newDateEnds = new Date(info.event.end);
                var getHours = (newDateEnds.getHours() < 10 ? '0' : '') + newDateEnds.getHours();
                var getMinutes = (newDateEnds.getMinutes() < 10 ? '0' : '') + newDateEnds.getMinutes();
                var fullTimeEnd = getHours + ":" + getMinutes;
                this.eventForm.ends = fullTimeEnd;
                //Ends time ends

                this.eventForm.id = info.event.id;
                this.eventForm.title = info.event.title;

                this.eventForm.color = info.event.backgroundColor;

                this.showPleaseWaitBtn = true;

                this.eventForm.put('calendar/' + this.eventForm.id).then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'The event has been updated!'
                    })
                    $('#addEditEventModal').modal('hide');
                    this.eventForm.reset();
                    this.showPleaseWaitBtn = false;
                    this.loadEvents();


                }).catch((error) => {
                    let errorMessage = error.response.data['message'];
                    ;

                    Toast.fire({
                        icon: 'error',
                        //title: 'Sorry. Something went wrong!'
                        title: errorMessage
                    })

                    this.showPleaseWaitBtn = false;
                })


            },

            deleteEvent() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert the rota!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.eventForm.delete("calendar/" + this.eventId).then(() => {
                            Swal.fire({
                                    title: 'Deleted!',
                                    text: 'The event has been deleted.',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                }
                            )
                            $('#addEditEventModal').modal('hide');
                            this.loadEvents();
                        }).catch((error) => {
                            let errorMessage = error.response.data['message'];

                            Toast.fire({
                                icon: 'error',
                                title: errorMessage
                            })

                        })

                    }
                })
            },

            updateEvent() {

                this.showPleaseWaitBtn = true;

                this.eventForm.put('calendar/' + this.eventForm.id).then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'The event has been updated!'
                    })
                    $('#addEditEventModal').modal('hide');
                    this.eventForm.reset();
                    this.showPleaseWaitBtn = false;
                    this.loadEvents();


                }).catch((error) => {
                    let errorMessage = error.response.data['message'];
                    ;

                    Toast.fire({
                        icon: 'error',
                        //title: 'Sorry. Something went wrong!'
                        title: errorMessage
                    })

                    this.showPleaseWaitBtn = false;
                })

            },

            loadEvents() {
                axios.get('/calendar').then((data) => {
                    this.calendarOptions.events = data.data;

                })

            },

            createEvent() {

                this.eventForm.post('calendar').then(() => {
                    $('#addEditEventModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Event has been added!'
                    })
                    this.eventForm.reset();

                    this.showPleaseWaitBtn = false;
                    this.loadEvents();
                }).catch((error) => {

                    let errorMessage = error.response.data['message'];

                    Toast.fire({
                        icon: 'error',
                        //title: 'Sorry. Something went wrong!'
                        title: errorMessage
                    })

                    this.showPleaseWaitBtn = false;
                });


            },


            editShift(info) {


                this.disabled = false;
                this.eventId = info.event.id;
                this.eventForm.reset();
                this.eventEditmode = true;

                $('#addEditEventModal').modal('show');

                this.eventForm.id = info.event.id;
                this.eventForm.color = info.event.backgroundColor;
                this.eventForm.title = info.event.title;


                //Starts time starts

                let newDateStarts = new Date(info.event.start);

                var rangeFirstDay = (newDateStarts.getDate() < 10 ? '0' : '') + newDateStarts.getDate();
                var rangeFirstMonth = (newDateStarts.getMonth() < 9 ? '0' : '') + (newDateStarts.getMonth() + 1);

                var rangeFirstYear = newDateStarts.getFullYear();
                var fullOfRangeFirst = rangeFirstYear + "-" + rangeFirstMonth + "-" + rangeFirstDay;

                this.eventForm.date = fullOfRangeFirst;

                var getHours = (newDateStarts.getHours() < 10 ? '0' : '') + newDateStarts.getHours();
                var getMinutes = (newDateStarts.getMinutes() < 10 ? '0' : '') + newDateStarts.getMinutes();
                var fullTimeStart = getHours + ":" + getMinutes;
                this.eventForm.starts = fullTimeStart;

                //Starts time ends

                //Ends time starts
                let newDateEnds = new Date(info.event.end);
                var getHours = (newDateEnds.getHours() < 10 ? '0' : '') + newDateEnds.getHours();
                var getMinutes = (newDateEnds.getMinutes() < 10 ? '0' : '') + newDateEnds.getMinutes();
                var fullTimeEnd = getHours + ":" + getMinutes;
                this.eventForm.ends = fullTimeEnd;
                //Ends time ends


            },

            selectCalendar(info) {

                this.eventForm.reset();
                this.eventEditmode = false;
                this.disabled = false;
                //Starts time starts

                let newDateStarts = new Date(info.start);

                var rangeFirstDay = (newDateStarts.getDate() < 10 ? '0' : '') + newDateStarts.getDate();
                var rangeFirstMonth = (newDateStarts.getMonth() < 9 ? '0' : '') + (newDateStarts.getMonth() + 1);

                var rangeFirstYear = newDateStarts.getFullYear();
                var fullOfRangeFirst = rangeFirstYear + "-" + rangeFirstMonth + "-" + rangeFirstDay;

                this.eventForm.date = fullOfRangeFirst;

                var getHours = (newDateStarts.getHours() < 10 ? '0' : '') + newDateStarts.getHours();
                var getMinutes = (newDateStarts.getMinutes() < 10 ? '0' : '') + newDateStarts.getMinutes();
                var fullTimeStart = getHours + ":" + getMinutes;
                this.eventForm.starts = fullTimeStart;


                //Starts time ends

                //Ends time starts

                let newDateEnds = new Date(info.end);
                var getHours = (newDateEnds.getHours() < 10 ? '0' : '') + newDateEnds.getHours();
                var getMinutes = (newDateEnds.getMinutes() < 10 ? '0' : '') + newDateEnds.getMinutes();
                var fullTimeEnd = getHours + ":" + getMinutes;
                this.eventForm.ends = fullTimeEnd;
                //Ends time ends
                $('#addEditEventModal').modal('show');


            },
        },
        created() {

            this.loadEvents();
        }
    }
</script>

<style scoped>


    /*animation starts*/


    .center {
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: gray;
        border-radius: 20px;
    }

    .wave {
        width: 5px;
        height: 30px;
        background: linear-gradient(45deg, cyan, #fff);
        margin: 10px;
        animation: wave 1s linear infinite;
        border-radius: 20px;
    }

    .wave:nth-child(2) {
        animation-delay: 0.1s;
    }

    .wave:nth-child(3) {
        animation-delay: 0.2s;
    }

    .wave:nth-child(4) {
        animation-delay: 0.3s;
    }

    .wave:nth-child(5) {
        animation-delay: 0.4s;
    }

    .wave:nth-child(6) {
        animation-delay: 0.5s;
    }

    .wave:nth-child(7) {
        animation-delay: 0.6s;
    }

    .wave:nth-child(8) {
        animation-delay: 0.7s;
    }

    .wave:nth-child(9) {
        animation-delay: 0.8s;
    }

    .wave:nth-child(10) {
        animation-delay: 0.9s;
    }

    @keyframes wave {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
    }


    /*animation ends*/


</style>
