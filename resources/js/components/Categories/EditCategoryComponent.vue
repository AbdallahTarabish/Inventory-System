<template>
    <div>
        <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">

            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile h-100">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                        <h3 class="kt-portlet__head-title">

                            تعديل صنف فرعي

                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">

                                <button type="button" @click.prevent="update(category.id)"  class="btn btn-primary float-left"><i
                                    class="fa fa-edit"></i>تحديث
                                </button>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form id="category_form">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الاسم</label>
                                    <div class="input-group ">
                                        <input type="text" name="name"  v-model="category.name"  :class="['form-control ',errors.name?'is-invalid':'' ]" placeholder="ادخل الاسم"/>

                                    </div>
                                    <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>

                                </div>

                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الاصناف الرئيسية  </label>
                                    <select class="form-control  select_2" id="select_2" name="main_category_id">

                                        <option v-for="main_category in main_categories"
                                                :selected="main.id == main_category.id? true : false"
                                                :value=main_category.id
                                        >
                                                {{main_category.name}}



                                        </option>

                                    </select>
                                    <span v-if="errors.main_category_id"
                                          class="text-danger">{{ errors.main_category_id[0] }}</span>

                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>الوصف</label>
                                    <div class="card-body" style="margin-right:-17px">
                                        <input id="description" name="description" type="hidden" :value="category.description">
                                        <div id="kt_quil_2" style="height: 225px">
                                            {{category.description}}

                                        </div>
                                        <span v-if="errors.description" class="text-danger">{{
                                                errors.description[0]
                                            }}</span>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
            <!--end::Portlet-->

        </div>
        <!--begin::Modal-->
    </div>
    <!--end::Modal-->
</template>

<script>
export default {

    created() {
        this.load();

    },
    data() {
        return {
            categories: [],
            main_categories: [],
            errors: [],
            main:'',
            category_form: {
                id: '',
                name: '',
                description: '',
                main_categoty_id: ''

            }


        }
    },
    props: ['category','main'],
    methods: {
        load() {
            axios.get('/get_categories')
                .then(response => {
                    this.categories = response.data;
                });
            axios.get('/get-all-main-categories')
                .then(response => {
                    this.main_categories = response.data;
                });
        },
        update(id) {
            let instance = this;
            this.errors = [];
            let formData = new FormData(document.getElementById("category_form"));

            axios.post('/categories/' + id,
                formData
            )
                .then((response) => {
                    this.errors = [];
                    swal.fire("تم الحفظ", "تم التحديث بنجاح", "success");
                    window.location.replace("/categories");
                }).catch((error) => {
                 //instance.$router.push('/categories');
                this.errors = error.response.data.errors;
            })
        },


    },

}
</script>
