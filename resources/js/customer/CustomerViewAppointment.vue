<template>
    <div class="container">
        <div class="flex justify-center">
            <div class="bg-white w-2/5 h-full rounded shadow-md mt-10">
                <div class="flex py-3 px-3">
                    <div class="w-full flex justify-between">
                        <div class="flex inline-block">
                            <button
                                @click="$router.go(-1)"
                                class="text-gray-600 text-xs hover:text-yellow-600 transition duration-300"
                            >
                                Return to Previous Page
                            </button>
                        </div>
                        <div class="flex items-center">
                            <router-link
                                style="text-decoration:none"
                                class="text-xs text-gray-700 hover:text-yellow-700 transition duration-300"
                                to="/dashboard/main"
                                >Home</router-link
                            >
                            <svg
                                class="fill-current text-xs w-3 h-3 mx-3"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 320 512"
                            >
                                <path
                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"
                                />
                            </svg>
                            <router-link
                                :to="{
                                    name: 'customer-view-appointment',
                                    params: { id: appointment.id }
                                }"
                                style="text-decoration:none"
                                class="text-xs text-gray-700 hover:text-yellow-700 transition duration-300"
                                >View Appointment</router-link
                            >
                        </div>
                    </div>
                </div>
                <div
                    v-if="appointment.status == 'Approved'"
                    class="flex py-1 px-3"
                >
                    <div class="bg-gray-50 w-full p-2 rounded">
                        <div class="flex px-3 py-2 items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-green-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"
                                />
                            </svg>
                            <h1 class="ml-2 text-md font-bold text-gray-700">
                                Remarks
                            </h1>
                        </div>
                        <div class="px-3 py-2 mt-4">
                            <label class="text-xs text-gray-700">
                                Your appointment is scheduled at
                            </label>
                            <label class="ml-1 text-xs font-bold text-gray-700">
                                {{ appointment.date | textDate }}
                            </label>
                            <label class="ml-1 text-xs text-gray-700">
                                between
                            </label>
                            <label class="ml-1 text-xs font-bold text-gray-700">
                                {{ appointment.start_time }}
                            </label>
                            <label class="ml-1 text-xs text-gray-700">
                                to
                            </label>
                            <label class="ml-1 text-xs font-bold text-gray-700">
                                {{ appointment.end_time }}
                            </label>
                        </div>
                        <div class="flex px-3 my-4">
                            <span class="text-gray-400 text-xs">{{
                                appointment.updated_at | date
                            }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex px-3 py-2 mt-4">
                    <h1 class="text-gray-700 font-bold text-lg">
                        Personal Information
                    </h1>
                </div>
                <div class="flex py-2 px-3 mt-2 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Name:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        {{ appointment.user.fname }}
                        {{ appointment.user.mname }}
                        {{ appointment.user.lname }}
                    </p>
                </div>
                <div class="flex px-3 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Email:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        {{ appointment.user.email }}
                    </p>
                </div>
                <div class="flex pb-1 px-3 mt-2 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Address:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        {{ appointment.user.address }}
                    </p>
                </div>
                <div class="flex px-3 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Contact Number:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        +63{{ appointment.user.contact_num }}
                    </p>
                </div>
                <div class="flex px-3 py-2 mt-4">
                    <h1 class="text-gray-700 font-bold text-lg">
                        Car Information
                    </h1>
                </div>
                <div class="flex py-1 px-3 mt-2 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Car Model:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        {{ appointment.car_model }}
                    </p>
                </div>
                <div class="flex py-1 px-3 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Plate Number:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        {{ appointment.plate_number }}
                    </p>
                </div>
                <div class="flex py-1 px-3 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Engine Number:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        {{ appointment.engine_number }}
                    </p>
                </div>
                <div class="flex py-1 px-3 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Chassis Number:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        {{ appointment.chassis_number }}
                    </p>
                </div>
                <div class="flex px-3 py-2 mt-4">
                    <h1 class="text-gray-700 font-bold text-lg">
                        Appointment Information
                    </h1>
                </div>
                <div class="flex py-1 px-3 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Preferred Date:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        {{ appointment.date }}
                    </p>
                </div>
                <div class="flex py-1 px-3 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Preferred Time:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        {{ appointment.time }}
                    </p>
                </div>
                <div class="flex py-1 px-3 space-x-2">
                    <p class="w-full text-md text-gray-700 font-bold">
                        Submitted:
                    </p>
                    <p class="w-full text-md text-gray-700">
                        {{ appointment.created_at | date }}
                    </p>
                </div>
                <div class="flex items-center py-1 px-3 space-x-2 mb-20">
                    <p class="w-1/2 text-md text-gray-700 font-bold">
                        Status:
                    </p>
                    <div class="flex justify-start">
                        <p
                            v-if="appointment.status == 'Approved'"
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"
                        >
                            Approved
                        </p>
                        <p
                            v-if="appointment.status == 'Pending'"
                            class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-sm"
                        >
                            Pending
                        </p>
                        <p
                            v-if="appointment.status == 'Checked'"
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"
                        >
                            Checked
                        </p>
                        <p
                            v-if="appointment.status == 'Declined'"
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm"
                        >
                            Declined
                        </p>
                        <p
                            v-if="appointment.status == 'In Progress'"
                            class="px-2 py-1 font-semibold leading-tight text-indigo-700 bg-indigo-100 rounded-sm"
                        >
                            In Progress
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-96 mt-10 ml-4">
                <div class="bg-white rounded shadow-md">
                    <div class="flex py-4 px-3">
                        <h1 class="text-gray-700 font-bold text-lg">
                            Service Details
                        </h1>
                    </div>
                    <div class="flex py-2">
                        <div class="relative h-72 w-full overflow-hidden">
                            <img
                                :src="`/images/${appointment.service.image}`"
                                alt=""
                                class="absolute h-full w-full object-cover"
                            />
                        </div>
                    </div>
                    <div class="flex px-3 py-2">
                        <h1 class="text-lg text-gray-700 font-bold">
                            {{ appointment.service.service_name }}
                        </h1>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center px-3">
                            <p
                                class="w-full text-sm text-gray-700 font-bold mr-2"
                            >
                                Description:
                            </p>
                        </div>
                        <div class="flex items-center px-3 pb-10">
                            <div v-html="appointment.service.description"></div>
                            <!-- <p
                                class="w-full text-sm text-gray-700 text-justify tracking-tight"
                            >
                                {{ appointment.service.description }}
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    data() {
        return {
            user: null,
            appointment: []
        };
    },
    beforeMount() {
        this.getUser();
        this.getAppointment();
    },
    filters: {
        date(value) {
            if (value) {
                return moment(String(value)).fromNow();
            }
        },
        textDate(value) {
            if (value) {
                return moment(String(value)).format('MMM Do YY');
            }
        }
    },
    methods: {
        getUser() {
            this.user = JSON.parse(localStorage.getItem('user'));
            axios.defaults.headers.common['Content-Type'] = 'application/json';
            axios.defaults.headers.common['Authorization'] =
                'Bearer ' + localStorage.getItem('jwt');
        },
        getAppointment() {
            axios
                .get(`/api/user/${this.$route.params.id}/appointment`)
                .then(response => {
                    this.appointment = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
</script>

<style></style>
