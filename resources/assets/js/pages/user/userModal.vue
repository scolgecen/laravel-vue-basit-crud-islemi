<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="userModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5
                        class="modal-title"
                        v-text="
                            item.id > 0 ? 'Kullanıcı Düzenle' : 'Yeni Kullanıcı'
                        "
                    ></h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div
                        v-if="errorMessage"
                        class="alert alert-danger"
                        v-html="errorMessage"
                    ></div>
                    <form @submit.prevent="true">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"
                                >kullanıcı adı</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    v-model="item.name"
                                    class="form-control"
                                />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">şifre</label>
                            <div class="col-sm-9">
                                <input
                                    type="password"
                                    v-model="item.password"
                                    class="form-control"
                                />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">email</label>
                            <div class="col-sm-9">
                                <input
                                    type="email"
                                    v-model="item.email"
                                    class="form-control"
                                />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        class="btn btn-primary"
                        v-text="item.id > 0 ? 'Güncelle' : 'Kaydet'"
                        @click="saveItem"
                    ></button>
                    <button class="btn btn-secondary" data-dismiss="modal">
                        Kapat
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    props: ["item"],
    data() {
        return {
            errorMessage: ""
        };
    },
    methods: {
        saveItem() {
            if (this.item.id > 0) {
                axios
                    .put("/users/" + this.item.id, this.item)
                    .then(response => {
                        console.log(response);
                        if (response.data.success == true) {
                            //alert(response.data.message);
                            this.$emit("onSaved", this.item);
                            $("#userModal").modal("hide");
                            toastr.success("Kayıt Güncellendi");
                        } else {
                            console.log(response);
                            alert(response.data.message);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                axios
                    .post("/users", this.item)
                    .then(response => {
                        console.log(response);
                        if (response.data.success == true) {
                            alert(response.data.message);
                            this.$emit("onSaved", this.item);
                            $("#userModal").modal("hide");
                            toastr.success("Kayıt Eklendi");
                        } else {
                            console.log(response);
                            alert(response.data.message);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
};
</script>
