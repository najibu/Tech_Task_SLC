<template>
    <div>
        <Header />

        <div class="w-1/5 text-left mr-auto ml-auto -mt-0 mb-0">
            <form @submit.prevent="submit">
                <div class="pt-10">
                    <h2 class="text-center text-3xl pb-10">Edit Book</h2>
                    <div class="pb-10">
                        <label class="w-20 inline-block">Title: </label>
                        <input type="text" v-model="book.title" placeholder="Title" class="rounded-md border-gray-400 border-solid border-[1px] p-2 w-96">
                    </div>
                    <div class="pb-10">
                        <label class="w-20 inline-block">Author: </label>
                        <input type="text" v-model="book.author" placeholder="Author" class="rounded-md border-gray-400 border-solid border-[1px] p-2 w-96">
                    </div>
                    <div class="pb-10">
                        <label class="w-20 inline-block">Rating: </label>
                        <input type="text" v-model="book.rating" placeholder="5" class="rounded-md border-gray-400 border-solid border-[1px] p-2 w-96">
                    </div>
                </div>
                <div class="text-center">
                    <button class="text-white bg-orange py-2 px-4 rounded" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import Header from '../Shared/Header.vue'

export default {
    name: 'EditBook',

    components: {
        Header
    },

    props: {
        bookData: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            book: {
                title: this.bookData.title,
                author: this.bookData.author,
                rating: this.bookData.rating
            },
            loading: false
        }
    },

    methods: {
        submit() {
            this.loading = true

            axios.put(`/api/books/${this.bookData.id}`, this.book)
                .then((response) => {
                    this.loading = false

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = '/'
                    })
                })
                .catch(error => {
                    this.loading = false

                    if (error.response && error.response.status === 422) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: 'Please check the form for errors and try again',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6',
                        })
                    } else {
                        console.error('Error failed to update this book:', error)

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update this book',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        })
                    }
                })
        }
    }

}
</script>
