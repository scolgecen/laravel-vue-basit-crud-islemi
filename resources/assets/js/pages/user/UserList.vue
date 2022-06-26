<template>
    <div>
        <user-modal :item="item" v-on:onSaved="refreshData" ref="userModal" />
        <div class="btn-group float-right">
            <button
                class="btn btn-info btn-sm mr-1"
                @click.prevent="fetchData"
                type="submit"
            >
                <i class="fa fa-refresh" aria-hidden="true"></i> Yenile
            </button>
            <button
                class="btn btn-info btn-sm "
                @click.prevent="createData"
                type="submit"
            >
                <i class="fa fa-plus-circle"></i> Yeni Kullanıcı
            </button>
        </div>
        <h1>
            Kullanıcılar
        </h1>
        <br />
        <p></p>
        <p v-if="errorMessage" class="alert alert-danger">
            @{{ errorMessage }}
        </p>
        <table class="table table-bordered table-hover">
            <thead>
                <th>Id</th>
                <th>İsim</th>
                <th>Email</th>
                <th>İşlem</th>
            </thead>
            <tbody>
                <tr v-for="list in UserList" :key="list.id">
                    <td>{{ list.id }}</td>
                    <td>{{ list.name }}</td>
                    <td>{{ list.email }}</td>
                    <td>
                        <div class="btn-group float-right">
                            <button
                                class="btn btn-info btn-sm mr-1 text-white"
                                @click.prevent="editData(list.id)"
                                type="submit"
                            >
                                <i class="fa fa-edit" aria-hidden="true"></i>
                                Düzenle
                            </button>
                            <button
                                class="btn btn-danger btn-sm "
                                type="submit"
                                @click.prevent="deleteData(list.id)"
                            >
                                <i class="fa fa-remove"></i> Sil
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>kayıt Bulunamadı</p>
        <pagination :meta="meta" v-on:pageChange="fetchData" />
    </div>
</template>

<script>
import Pagination from "../../components/Pagination.vue";
import UserModal from "./userModal.vue";
import axios from "axios";
export default {
    components: { Pagination, UserModal },
    data() {
        return {
            item: {},
            UserList: null,
            errorMessage: null,
            meta: {}
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData(page = 1) {
            this.errorMessage = null;
            this.list = null;
            axios
                .get("/users", { params: { page } })
                .then(res => {
                    console.log(res.data.data);
                    this.UserList = res.data.data;
                    this.meta = res.data.meta;
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else this.errorMessage = error.message;
                });
        },
        createData() {
            this.item = {};
            $("#userModal").modal("show");
        },
        editData(id) {
            //this.item = {};

            axios
                .get("/users/" + id)
                .then(res => {
                    console.log(res.data);
                    this.item = res.data;
                    $("#userModal").modal("show");
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else this.errorMessage = error.message;
                });
            $("#userModal").modal("show");
        },
        refreshData(item) {
            this.fetchData();
        },
        deleteData(id) {
            swal({
                title: "Emin misiniz?",
                text: "Silmek istediğinize emin misiniz?",
                type: "warning",
                showCancelButton: "true",
                cancelButtonText: "İptal",
                confirmButtonText: "Sil"
            }).then(result => {
                if (result.value) {
                    axios.delete("/users/" + id).then(res => {
                        this.fetchData();
                        toastr.success("Kayıt Silindi");
                    });
                }
            });
        }
    }
};
</script>

<style></style>
