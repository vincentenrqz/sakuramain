<template>
    <div class="container mb-10">
        <div class="flex justify-center">
            <div
                class="bg-white px-10 pb-10 rounded shadow-md w-2/3 mt-10 h-full"
            >
                <div class="flex py-3 mb-10">
                    <div class="w-full flex justify-between">
                        <div class="flex inline-block">
                            <router-link
                                to="/manager/services"
                                style="text-decoration:none;"
                                class="text-gray-600 text-xs hover:text-yellow-600 transition duration-300"
                            >
                                Return to Previous Page
                            </router-link>
                        </div>
                        <div class="flex items-center">
                            <router-link
                                to="/manager/services"
                                style="text-decoration:none;"
                                class="text-gray-600 text-xs hover:text-yellow-600 transition duration-300"
                            >
                                Services List
                            </router-link>
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
                                    name: 'manager-edit-service',
                                    params: { id: service.id }
                                }"
                                style="text-decoration:none"
                                class="text-xs text-gray-700 hover:text-yellow-700 transition duration-300"
                                aria-current="page"
                                >{{ service.service_name }}</router-link
                            >
                        </div>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl text-gray-700">Edit service</h1>
                    <p class="text-gray-600">
                        Form will be save once you submit
                    </p>
                </div>
                <div class="flex justify-center mt-4">
                    <div class="relative overflow-hidden">
                        <div class="h-96 w-full">
                            <img
                                :src="
                                    `/images/${service.image}`
                                        ? `/images/${service.image}`
                                        : null
                                "
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center my-4">
                    <input type="file" @change="onChange" />
                    <span
                        class="text-red-500 text-xs mt-14"
                        v-if="errors.image"
                        >{{ errors.image[0] }}</span
                    >
                </div>
                <div class="flex px-10 py-2">
                    <label class="text-md font-bold text-gray-700"
                        >Service Name</label
                    >
                    <span
                        class="ml-2 text-red-500 text-xs"
                        v-if="errors.service_name"
                        >{{ errors.service_name[0] }}</span
                    >
                </div>
                <div class="grid grid-cols-2 gap-4 px-10">
                    <input
                        class="w-full focus:bg-white border-2 border-gray-200 p-2 rounded outline-none focus:border-gray-800 transition duration-150"
                        type="text"
                        v-model="service.service_name"
                    />
                </div>
                <div class="flex px-10 py-2">
                    <label class="text-md font-bold text-gray-700"
                        >Status</label
                    >
                    <span
                        class="ml-2 text-red-500 text-xs"
                        v-if="errors.status"
                        >{{ errors.status[0] }}</span
                    >
                </div>
                <div class="grid grid-cols-2 gap-4 px-10">
                    <select
                        class="w-full focus:bg-white border-2 border-gray-200 p-2 rounded outline-none focus:border-gray-800 transition duration-150"
                        v-model="service.status"
                    >
                        <option value="Available">Available</option>
                        <option value="Out of Service">Out of Service</option>
                    </select>
                </div>
                <div class="flex px-10 py-2">
                    <label class="text-md font-bold text-gray-700"
                        >Description</label
                    >
                    <span
                        class="ml-2 text-red-500 text-xs"
                        v-if="errors.description"
                        >{{ errors.description[0] }}</span
                    >
                </div>
                <div class="flex items-center px-10">
                    <vue-editor v-model="service.description"></vue-editor>
                </div>
                <div class="flex space-x-4 justify-end mt-4">
                    <button
                        @click="updateService"
                        :disabled="loading"
                        class="flex items-center bg-gray-900 px-3 py-2 text-white rounded font-bold text-md hover:bg-gray-500 transition duration-300 mt-2"
                    >
                        <svg
                            v-if="loading"
                            class="animate-spin h-4 w-4 rounded-full bg-transparent border-2 border-transparent border-opacity-50 mr-2"
                            style="border-right-color: white; border-top-color: white;"
                            viewBox="0 0 24 24"
                        ></svg>
                        <span v-if="loading">Please wait...</span>
                        <span v-else>Update</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { VueEditor } from 'vue2-editor';
export default {
    components: {
        VueEditor
    },
    data() {
        return {
            image: '',
            user: null,
            service: {},
            errors: [],
            loading: false,
            loadingUpload: false,
            preview: false
        };
    },
    beforeMount() {
        this.getUser();
        this.getService();
    },
    methods: {
        getUser() {
            this.user = JSON.parse(localStorage.getItem('user'));
            axios.defaults.headers.common['Content-Type'] = 'application/json';
            axios.defaults.headers.common['Authorization'] =
                'Bearer ' + localStorage.getItem('jwt');
        },
        getService() {
            axios
                .get(`/api/services/${this.$route.params.id}`)
                .then(response => {
                    this.service = response.data;
                });
        },
        updateService() {
            this.loading = true;

            // setTimeout(() => {
            //     this.loading = !true;
            axios
                .put(`/api/services/${this.$route.params.id}`, this.service)
                .then(() => {
                    this.$swal({
                        position: 'center',
                        icon: 'success',
                        title: 'Service has successfully updated.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        this.$router.push({ name: 'manager-services' });
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                })
                .finally(() => {
                    this.loading = false;
                });
            // }, 2000);
        },
        onChange(e) {
            this.image = e.target.files[0];

            let reader = new FileReader();
            reader.readAsDataURL(this.image);
            reader.onload = e => {
                this.preview = e.target.result;
            };

            const config = {
                header: { content_type: 'multipart/form-data' }
            };

            let formData = new FormData();
            formData.append('image', this.image);

            axios
                .post('/api/services/upload/image', formData, config)
                .then(response => {
                    this.service.image = response.data;
                    console.log(response);
                })

                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        }
    }
};
</script>

<style></style>
