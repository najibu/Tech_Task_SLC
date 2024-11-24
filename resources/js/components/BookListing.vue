<template>
    <div>
        <Header/>

        <main class="mt-8 flex flex-col items-center">
            <!-- Search Box  -->
            <section class="w-[1220px] mb-10">
                <div class="flex relative">
                    <input type="text"
                        class="border border-gray-300 rounded-md w-1/3 p-2 m-auto block text-xs absolute right-12"
                        v-model="searchQuery"
                        @input="searchBooks"
                        placeholder="Search by book title ..."
                    />
                </div>
            </section>

            <!-- Table  -->
            <section class="text-xs mt-6 w-9/12" v-if="!loading">
                <div class="relative overflow-auto">
                    <template v-if="filteredBooks.length > 0">
                        <table class="table-auto border border-white text-left">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="px-4 py-2 border border-white">Title</th>
                                    <th class="px-4 py-2 border border-white">Author</th>
                                    <th class="px-4 py-2 border border-white">Rating</th>
                                    <th class="px-4 py-2 border border-white"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-300">
                                <tr v-for="book in filteredBooks" :key="book.id">
                                    <td class="px-4 py-3 border border-white">{{ book.title }}</td>
                                    <td class="px-4 py-3 border border-white">{{ book.author }}</td>
                                    <td class="px-4 py-3 border border-white">{{ book.rating }}</td>
                                    <td class="px-4 py-3 border border-white">
                                        <button type="button"
                                            @click="editBook(book.id)"
                                            class="underline block font-bold hover:text-indigo-300">
                                            Edit
                                        </button>
                                        <button type="button"
                                            @click="deleteBook(book.id)"
                                            class="underline font-bold hover:text-indigo-300">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </template>
                    <template v-else>
                        <p class="text-center text-red-500">No books found</p>
                    </template>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from "axios"
import Swal from 'sweetalert2'
import Header from "../Shared/Header.vue"

export default {
    name: 'BookListing',

    components: {
        Header
    },

    data() {
        return {
            books: [],
            searchQuery: '',
            loading: false
        }
    },

    computed: {
        filteredBooks() {
            return this.books
        }
    },

    created() {
        this.fetch()
    },

    methods: {
        fetch() {
            this.loading = true

            axios.get('/api/books')
                .then(response => {
                    this.books = response.data.data
                    this.loading = false
                })
                .catch(error => {
                    this.loading = false
                    console.error('Error fetching books:', error)
                })
        },

        searchBooks() {
            this.loading = true

            axios.get(`/api/books?query=${this.searchQuery}`)
                .then(response => {
                    this.books = response.data.data
                    this.loading = false
                })
                .catch(error => {
                    this.loading = false
                    console.error('Error searching books:', error)
                })
        },

        editBook(id) {
            window.location.href = `/books/${id}/edit`
        },

        deleteBook(id) {
            Swal.fire({
                title: 'Delete Book',
                text: 'Are you sure you want to delete this book?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.loading = true

                    axios.delete(`/api/books/${id}`)
                        .then(() => {
                            this.fetch()
                            this.loading = false
                        })
                        .catch(error => {
                            this.loading = false
                            console.error('Error failed deleting this book:', error)
                        })
                }
            })
        }
    }
}
</script>

