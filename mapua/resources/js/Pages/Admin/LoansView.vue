<template>
    <AppLayout title="Loans">
        <template #header>
            <div class="flex justify-between">
                <div class="flex items-center ">
                    <h1 class="font-extrabold text-xl text-gray-800 leading-tight">Loans</h1>
                </div>
            </div>
        </template>

        <div class="p-2 px-6 leading-tight flex justify-between items-center">
            <h1 class="text-xl text-gray-700 font-extrabold pl-8">Approved Loans</h1>

            <!-- <div class="flex-1">
                <Link :href="route('registerUser')" class="text-blue-500 font-semibold text-sm hover:underline ml-4">
                    Unapproved/Pending Loans
                </Link>
            </div> -->

            <!-- <input id="search_term"  class="border rounded-md mx-4" v-model="form.search" name="search_term" placeholder="Search" type="text"> -->
                   <div class="flex px-3 py-1 gap-2">
                    <Listbox class="w-80" v-model="form.approval">
                         <div class="relative">
                            <ListboxButton class="elative w-full py-2 pl-3 pr-10 text-left bg-white rounded-lg shadow-md cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-500 sm:text-sm">
                                Sort By: {{form.approval}}
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <SelectorIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                                </span>
                            </ListboxButton>
                            <transition
                                leave-active-class="transition duration-100 ease-in"
                                leave-from-class="opacity-100"
                                leave-to-class="opacity-0"
                            >
                                <ListboxOptions class="absolute w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                    <ListboxOption v-for="status in statuses" :key="status" :value="status" as="template"><li class="px-3 py-2 hover:bg-gray-200 cursor-pointer"> {{status}}</li></ListboxOption>
                                </ListboxOptions>
                            </transition>
                        </div>
                        </Listbox>
                    </div>
                </div>

            <div class="mx-12 my-6 shadow-md">
                <!--
                <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 table-auto">
                                <thead class="inline-flex">
                                <tr class="m-2">
                                    <th class="text-left px-16">Name</th>
                                    <th class="text-left px-16">Loan Type</th>
                                    <th class="text-left px-16">Loan Amount</th>
                                    <th class="text-left px-16">Interest</th>
                                    <th class="text-left px-16">Approval</th>
                                    <th class="text-left px-16">Duration</th>
                                    <th class="text-left px-16">Loan Status</th>
                                    <th class="text-left px-16">Attachment Path</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                -->

                <div class="flex flex-col ">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <tbody class="bg-white divide-y divide-gray-200  border-gray-200 sm:rounded-lg">
                                        
                                        <th class="text-left px-16 bg-gray-100">Name</th> 
                                        <th class="text-left px-16 bg-gray-100">Loan Type</th>
                                        <th class="text-left px-16 bg-gray-100">Loan Amount</th>
                                        <th class="text-left px-16 bg-gray-100">Interest</th>
                                        <th class="text-left px-16 bg-gray-100">Approval</th>
                                        <th class="text-left px-16 bg-gray-100">Duration</th>
                                        <th class="text-left px-16 bg-gray-100">Loan Status</th>
                                        <th class="text-left px-16 bg-gray-100"></th>
                                        
                                        <tr v-for="loan in loans.data" v-bind:key="loan.id">
                                            
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ loan.user.name }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ loan.loan_type }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ loan.loan_amount }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ loan.interest }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ loan.approval }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ loan.duration }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ loan.loan_status }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                            <!--<td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ loan.attachment_path }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>-->

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <!-- Review loan info -->
                                                <div class="inline-flex">
                                                    <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                        stroke-width="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        @click="reviewLoan(loan)">
                                                        <path
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"/>
                                                    </svg>

                                                    <!-- delete Loan -->


                                                    <svg class="h-6 w-6 hover:text-red-500 bg-gray-100 text-red-800" fill="none" stroke="currentColor"
                                                        stroke-width="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        @click="deleteLoan(loan)">
                                                        <path
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"/>
                                                    </svg>

                                                </div>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <pagination :links="loans.links"/>

                                    <Modal :closeable="true" :show="showDeleteModal"
                                        @close="showDeleteModal = !showDeleteModal">
                                        <div class="p-5">
                                            <div class="flex justify-between text-xl font-bold text-gray-900 my-3">
                                                <span>Update Loan Table</span>
                                                <svg class="h-6 w-6 cursor-pointer"
                                                    fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    @click="showDeleteModal = !showDeleteModal">
                                                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"/>
                                                </svg>
                                            </div>
                                            <div class="flex flex-col items-center text-xl font-bold text-gray-900 my-3">
                                                <svg class="h-36 w-36 rounded-full text-red-700 opacity-60 "
                                                    fill="none"
                                                    stroke="currentColor" stroke-width="1.5px"
                                                    version="1.1" viewBox="0 0 40 40" xml:space="preserve"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g>
                                        <path
                                            d="M17.125,0C7.668,0,0,7.667,0,17.125S7.668,34.25,17.125,34.25c9.459,0,17.125-7.667,17.125-17.125S26.584,0,17.125,0z    M23.445,11.422c1.355,0,2.453,1.099,2.453,2.453s-1.098,2.453-2.453,2.453c-1.354,0-2.451-1.099-2.451-2.453   S22.093,11.422,23.445,11.422z M10.806,11.422c1.354,0,2.453,1.099,2.453,2.453s-1.099,2.453-2.453,2.453s-2.453-1.099-2.453-2.453   S9.453,11.422,10.806,11.422z M26.457,25.641c-0.26,0.492-0.77,0.801-1.328,0.801H9.121c-0.559,0-1.067-0.309-1.328-0.801   c-0.26-0.494-0.225-1.09,0.093-1.549c2.098-3.046,5.551-4.865,9.239-4.865c3.689,0,7.146,1.819,9.24,4.866   C26.684,24.55,26.718,25.146,26.457,25.641z"/>
                                    </g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                </svg>
                                                <span class="text-center">You are about to delete {{ loanToDelete.user.name }}'s {{loanToDelete.loan_type}} loan are you sure you want to proceed?</span>
                                            </div>
                                            <div class="flex justify-center">
                                                <div class="flex justify-between text-xl font-bold dark:text-gray-200 my-3">
                                                    <div
                                                        class="flex space-x-2 mr-5 px-4 py-1 border text-md text-red-600 dark:text-red-600 dark:border-red-600 border-red-600 uppercase rounded-full dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500 cursor-pointer"
                                                        @click="submitDeleteLoan">
                                                        <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"/>
                                                        </svg>
                                                        <span>Yes I'm sure</span>
                                                    </div>
                                                </div>
                                                <div class="flex text-xl font-bold dark:text-gray-200 my-3">
                                                    <div
                                                        class="flex space-x-2 px-4 py-1 border text-md text-gray-600 dark:text-gray-600 dark:border-gray-600 border-gray-600 uppercase rounded-full dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-gray-500 cursor-pointer"
                                                        @click="showDeleteModal = !showDeleteModal">
                                                        <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"/>
                                                        </svg>
                                                        <span>Nevermind</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </Modal>

                                    <Modal :closeable="true" :show="showReviewModal"
                                        @close="showReviewModal = !showReviewModal">
                                        <div class="p-5">
                                            <div class="flex justify-between text-xl font-bold text-gray-900 my-3">
                                                <span></span>
                                                <svg class="h-6 w-6 cursor-pointer"
                                                    fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    @click="showReviewModal = !showReviewModal">
                                                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"/>
                                                </svg>
                                            </div>
                                            <div class="flex flex-col items-center text-xl font-bold text-gray-900 my-3">
                                                
                                                <span class="text-center">Approve/Reject {{ loanToReview.user.name }}'s {{loanToReview.loan_type}} loan?</span>
                                            </div>
                                            <div class="flex justify-center">
                                                <div class="flex justify-between text-xl font-bold dark:text-gray-200 my-3">
                                                    <div
                                                        class="flex space-x-2 mr-5 px-4 py-1 border text-md text-green-600 dark:text-green-600 dark:border-green-600 border-green-600 uppercase rounded-full dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-green-500 cursor-pointer"
                                                        @click="submitApproveLoan">
                                                         
                                                        <span>Approve</span>
                                                    </div>
                                                </div>
                                                <div class="flex text-xl font-bold dark:text-gray-200 my-3">
                                                    <div
                                                        class="flex space-x-2 px-4 py-1 border text-md text-red-600 dark:text-red-600 dark:border-red-600 border-red-600 uppercase rounded-full dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500 cursor-pointer"
                                                        @click="submitRejectLoan">
                                                        
                                                        <span>Reject</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </Modal>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue';
import {Link} from '@inertiajs/inertia-vue3';
import Modal from '@/Jetstream/Modal';
import {pickBy, throttle} from 'lodash';
import route from '../../../../vendor/tightenco/ziggy/src/js';
import { useForm } from '@inertiajs/inertia-vue3'
import {Listbox, ListboxButton, ListboxOptions, ListboxOption} from '@headlessui/vue';
// import SelectorIcon 
export default {
    components:{
        AppLayout,
        Pagination,
        JetApplicationLogo,
        Link,
        Modal,
        Listbox,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
        // SelectorIcon

    },
    props: {
        loans: Object,
        filters: Object,
        
    },
    

    setup() {
         const forms = useForm({
             file:null,
         })
         return { forms }
    },

    data() {
        return {
            loanToDelete: Object,
            loanToReview: Object,
            showDeleteModal: false,
            showReviewModal: false,
            
            form:{
                // search: this.filters.search,
                approval: this.filters.approval == null ? 'All' : this.filters.approval,
            },

            statuses:[
                'All',
                'Reviewing',
                'Approved',
                'Pending',
            ],

            deleteForm: this.$inertia.form({
                id: Number,
            }),

            approveForm: this.$inertia.form({
                id: Number, 
                approval:'',
            }),

            rejectForm: this.$inertia.form({
                id: Number,
                approval:'',
            }),
        }
    },

    watch: {
        form: {
            deep: true,
            handler:
                throttle(
                    function () {
                        this.$inertia.get(route('adminLoansView'), pickBy(this.form), {preserveState: true, preserveScroll: true,
                        })
                    },
                    600
                ),
        },
    },

    methods: {
        deleteLoan(loan) {
            this.loanToDelete = loan
            this.showDeleteModal = !this.showDeleteModal
        },
        submitDeleteLoan() {
            this.deleteForm.id = this.loanToDelete.id;
            this.deleteForm.delete(route('loanDelete'), {
                onSuccess: () => {
                    this.showDeleteModal = false
                }
            });
        },

        reviewLoan(loan) {
            this.loanToReview = loan
            this.showReviewModal = !this.showReviewModal
        },

        submitApproveLoan() {
            this.approveForm.id = this.loanToReview.id;
            this.approveForm.approval = 'Approved';
            this.approveForm.post(route('loanApprove'), {
                onSuccess: () => {
                    this.showReviewModal = false
                }
            });
        },

        submitRejectLoan() {
            this.rejectForm.id = this.loanToReview.id;
            this.rejectForm.approval = 'Rejected';
            this.rejectForm.post(route('loanReject'), {
                onSuccess: () => {
                    this.showReviewModal = false
                }
            });
        },
    //  importing(){
    //     this.$inertia.post(route('import'),{
            
    //         _token: this.$page.props.csrf_token
    //     })
    //  }
    }
}
</script>
<style scoped>
 i {
        font-size: 1rem !important;
    }
</style>