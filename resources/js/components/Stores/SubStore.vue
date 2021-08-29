<template>
    <div>
        <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة مخزن فرعي جديد</h5>
                        <button type="button"  class="close" data-dismiss="modal"
                                aria-label="Close">
                        </button>
                    </div>
                    <form id="sub_store_form" method="post"
                          @submit.prevent="!editMode ?save() : update(sub_store_form.id)">
                        <input type="hidden" name="id" :value="sub_store_form.id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-control-label">الاسم:</label>
                                <input type="text" name="name" v-model="sub_store_form.name"
                                       :class="['form-control ',errors.name?'is-invalid':'' ]">

                                <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">العنوان:</label>
                                <input type="text" name="location_url" v-model="sub_store_form.location_url"
                                       :class="['form-control ',errors.location_url?'is-invalid':'' ]">

                                <span v-if="errors.location_url" class="text-danger">{{ errors.location_url[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">المخازن الرئيسية :</label>
                                <div class="card card-custom">
                                    <select :class="['form-control select_2 ']" name="main_store_id"
                                            style="width: 100%;">

                                        <option v-for="main_store in main_stores" :value=main_store.id
                                                :selected="sub_store_form.main_store_id==main_store.id"

                                        >
                                            {{ main_store.name }}
                                        </option>
                                    </select>


                                </div>
                                <span v-if="errors.main_store_id" class="text-danger">{{
                                        errors.main_store_id[0]
                                    }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">حفظ</button>
                            <button v-show="editMode" type="submit" class="btn btn-primary">تحديث</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile h-100">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand flaticon2-line-chart"></i>
                              </span>
                        <h3 class="kt-portlet__head-title">
                            عرض معلومات المخازن الفرعية
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                            data-toggle="dropdown-menu" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-download"></i> Export
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <li class="kt-nav__section kt-nav__section--first">
                                                <span class="kt-nav__section-text">Choose an option</span>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-print"></i>
                                                    <span class="kt-nav__link-text">Print</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-copy"></i>
                                                    <span class="kt-nav__link-text">Copy</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                    <span class="kt-nav__link-text">Excel</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                    <span class="kt-nav__link-text">CSV</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                    <span class="kt-nav__link-text">PDF</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <button v-show="this.CheckPremission('sub_stores_create')" type="button" class="btn btn-brand btn-elevate btn-icon-sm"
                                        data-toggle="modal" @click="reset_modal()" data-target="#kt_modal_4"><i
                                    class="fa fa-plus-circle"></i>اضافة
                                    مخزن فرعي جديد
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-padding-25" style="background-color: #F8F8F8">
                    <form>
                        <div class="form-group row align-items-end">
                            <div class="col-md-4">
                                <label>الاسم</label>
                                <div class="input-group ">
                                    <input type="text" name="name" v-model="search_main_categories.search_name"
                                           class="form-control " placeholder="ادخل الاسم"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label> الحالة</label>
                                <select class=" form-control " v-model="search_main_categories.search_status">
                                    <option value="">الكل</option>
                                    <option value="1">مفعل</option>
                                    <option value="-1">معطل</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button @click.prevent="load" type="button" href=""
                                        class="btn btn-info btn-elevate btn-icon-sm">
                                    <i class="fa fa-search"></i>
                                    بحث
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="kt-portlet__body">
                    <h3 class="mb-4"></h3>
                    <div class="table-responsive">
                        <table class="table table-bordered products-table">
                            <thead>
                            <tr class="text-center">
                                <th class="font-weight-bold ">اسم المخزن</th>
                                <th class="font-weight-bold ">العنوان</th>
                                <th class="font-weight-bold ">المخزن الرئيسي</th>

                                <th class="font-weight-bold ">انشأ بواسطة</th>
                                <th class="font-weight-bold ">تم التعديل بواسطة</th>
                                <th class="font-weight-bold ">الحالة</th>
                                <th class="font-weight-bold ">الاجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center" v-for="sub_store in sub_stores.data">
                                <td>{{ sub_store.name }}</td>
                                <td>{{ sub_store.location_url }}</td>
                                <td>{{ sub_store.mainstore.name }}</td>

                                <td>{{ sub_store.created_by }}</td>
                                <td v-if="sub_store.updated_by ">{{ sub_store.updated_by }}</td>
                                <td v-else>لم يتم التعديل</td>
                                <td class="text-success font-weight-bold" v-if="sub_store.status ==1">
                                    مفعل
                                </td>
                                <td class="text-danger font-weight-bold" v-else>
                                    معطل
                                </td>
                                <td>
                                    <button v-show="CheckPremission('sub_stores_update')"  class="btn btn-primary btn-sm" @click="edit(sub_store)"><i
                                        class="fa fa-edit"></i></button>
                                    <button v-show="CheckPremission('sub_stores_delete')"  class="btn btn-danger btn-sm" @click="remove(sub_store.id)"><i
                                        class="fa fa-trash-alt"></i></button>
                                    <button title="تعطيل" v-if="sub_store.status ==1"
                                            class="btn btn-warning btn-sm"
                                            @click="disable(sub_store.id)"><i
                                        class="fa fa-window-close"></i></button>
                                    <button title="تفعيل" v-else class="btn btn-success btn-sm"
                                            @click="active(sub_store.id)"><i
                                        class="fa fa-check"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <pagination :data="sub_stores" @pagination-change-page="load">
                            <span slot="prev-nav">&lt; </span>
                            <span slot="next-nav">التالي ></span>
                        </pagination>
                    </div>
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
            sub_stores: {},
            main_stores: [],
            errors: [],
            editMode: false,
            sub_store_form: {
                id: '',
                name: '',
                location_url: '',
                main_store_id: ''
            },
            search_main_categories: {
                search_name: '',
                search_status: ''
            },
        }
    },
    methods: {
        load(page = 1) {
            axios.get('get-sub-stores?page=' + page, {
                params: {
                    name: this.search_main_categories.search_name,
                    status: this.search_main_categories.search_status,
                }
            })
                .then(response => {
                    this.sub_stores = response.data;
                });
            axios.get('get-main-in-sub')
                .then(response => {
                    this.main_stores = response.data;
                });
        },
        save() {
            this.errors = [];
            let formData = new FormData(document.getElementById("sub_store_form"));
            axios.post('/sub-stores', formData
                , {})
                .then(response => {
                    $('#kt_modal_4').modal('hide');
                    $(".modal-backdrop").remove();
                    Swal.fire({
                        type: 'success',
                        title: "تم الاضافة بنجاح",
                    });
                    this.load();
                    this.errors = [];
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
        remove(id) {
            swal.fire({
                text: "هل أنت متأكد من عملية الحذف ؟",
                type: "warning",
                buttonsStyling: false,
                confirmButtonText: "<i class='la la-thumbs-up'></i> تأكيد",
                confirmButtonClass: "btn btn-danger",
                showCancelButton: true,
                cancelButtonText: "<i class='la la-thumbs-down'></i> الغاء",
                cancelButtonClass: "btn btn-default"
            }).then((result) => {
                if (result.value) {
                    axios.delete('/sub-stores/' + id)
                        .then((response) => {
                            this.load();
                            swal.fire("تم الحذف", "تم الحذف بنجاح", "success");
                        }).catch(() => {
                        swal("Deleted_failed", "error", "error");
                    })
                }
            })
        },
        edit(sub_store) {
            this.errors = [];
            $('#kt_modal_4').modal('show');
            this.sub_store_form.name = sub_store.name;
            this.sub_store_form.location_url = sub_store.location_url;
            this.sub_store_form.main_store_id = sub_store.mainstore.id;

            this.sub_store_form.id = sub_store.id;
            this.editMode = true;
        },
        update(id) {
            this.errors = [];
            let formData = new FormData(document.getElementById("sub_store_form"));
            axios.post('/sub-stores/update/' + id,
                formData
            )
                .then((response) => {
                    $('#kt_modal_4').modal('hide');
                    this.load();
                    this.errors = [];
                    Swal.fire({
                        type: 'success',
                        title: "تم التحديث بنجاح",
                    });
                }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        },
        disable(id) {
            axios.post('/sub-stores/disable/' + id
                , {})
                .then(response => {
                    Swal.fire({
                        type: 'success',
                        title: "تم التعطيل بنجاح",
                    });
                    this.load();
                })
                .catch(error => {
                });
        },
        active(id) {
            axios.post('/sub-stores/active/' + id
                , {})
                .then(response => {
                    Swal.fire({
                        type: 'success',
                        title: "تم التفعيل بنجاح",
                    });
                    this.load();
                })
                .catch(error => {
                });
        },
        reset_modal() {
            this.editMode=false;
            this.sub_store_form = {
                id: '',
                name: '',
                location_url: '',
                main_store_id: ''
            }
            this.errors=[];
        },
        CheckPremission(Permissions) {
            if (window.App.permissions.includes(Permissions) ) {
                return true;
            }
        },
    },

}
</script>
