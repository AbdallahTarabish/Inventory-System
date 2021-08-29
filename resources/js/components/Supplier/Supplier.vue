<template>
    <div>
        <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة مورد جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form id="supplier_form" method="post"
                          @submit.prevent="!editMode ? save() : update(supplier.id)">
                        <input type="hidden" name="id" :value="supplier.id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-control-label">الاسم:</label>
                                <input v-model="supplier.name" type="text" name="name"
                                       :class="['form-control ',errors.name?'is-invalid':'' ]">

                                <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">الايميل:</label>
                                <input v-model="supplier.email" type="text" name="email"
                                       :class="['form-control ',errors.email?'is-invalid':'' ]">

                                <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">الاصناف التي يتعامل معها :</label>
                                <div class="card card-custom">
                                    <select class="form-control select_2  " multiple="multiple"
                                            name="sub_category_id[]">
                                        <option


                                            v-for="sub_category in sub_categories"
                                            :key="sub_category.id"
                                            :value=sub_category.id
                                            :selected="Supplier_sub_categories.includes(sub_category.id)"


                                        >

                                            {{ sub_category.name }}
                                        </option>


                                    </select>


                                </div>
                                <span v-if="errors.sub_category_id" class="text-danger">{{
                                        errors.sub_category_id[0]
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
                            عرض معلومات الموردين
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


                                <button v-show="this.CheckPremission('suppliers_create')" type="button"
                                        @click="reset_modal()"
                                        class="btn btn-brand btn-elevate btn-icon-sm"
                                        data-toggle="modal"  data-target="#kt_modal_4"><i
                                    class="fa fa-plus-circle"></i>اضافة
                                    مورد جديد
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-padding-25" style="background-color: #F8F8F8">
                    <form id="search_form">
                        <div class="form-group row align-items-end">
                            <div class="col-md-4">
                                <label>الاسم</label>
                                <div class="input-group ">
                                    <input type="text" name="name" v-model="search"
                                           class="form-control " placeholder="ادخل الاسم"


                                    />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button @click.prevent="load" type="button"
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
                                <th class="font-weight-bold ">اسم المورد</th>
                                <th class="font-weight-bold ">ايميل المورد</th>
                                <th class="font-weight-bold ">انشأ بواسطة</th>
                                <th class="font-weight-bold ">تم التعديل بواسطة</th>
                                <th class="font-weight-bold ">الاصناف التي يتعامل معها</th>
                                <th class="font-weight-bold ">الاجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center" v-for="supplier in suppliers.data">
                                <td>{{ supplier.name }}</td>
                                <td>{{ supplier.email }}</td>
                                <td>{{ supplier.created_by }}</td>
                                <td v-if="supplier.updated_by ">{{ supplier.updated_by }}</td>
                                <td v-else>لم يتم التعديل</td>
                                <td>
                                    <div v-for="category in supplier.categories" class="badge badge-success"
                                         style="margin-left: 3px;border-radius: 50px">
                                        {{ category.name }}


                                    </div>
                                </td>

                                <td>
                                    <button v-show="CheckPremission('suppliers_update')" class="btn btn-primary btn-sm" @click="edit(supplier)"><i
                                        class="fa fa-edit"></i></button>
                                    <button v-show="CheckPremission('suppliers_delete')" class="btn btn-danger btn-sm" @click="remove(supplier.id)"><i
                                        class="fa fa-trash-alt"></i></button>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <pagination :data="suppliers" @pagination-change-page="load">
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
            suppliers: {},
            sub_categories: [],
            supplier_categories: [],
            sub_category_selected: false,
            Supplier_sub_categories: [],
            search: '',
            selected: false,

            errors: [],
            editMode: false,
            supplier: {
                id: '',
                name: '',
                email: '',
                sub_categories: [],
            },
            search_main_categories: {
                search_name: '',
                search_status: ''
            },
        }
    },
    methods: {
        load(page = 1) {
            axios.get('get-suppliers?page=' + page, {
                params: {
                    name: this.search,
                    //  status: this.search_main_categories.search_status,
                }
            })
                .then(response => {
                    this.suppliers = response.data;
                    this.supplier_categories = response.data.categories;

                });

            axios.get('/get-all-categories')
                .then(response => {
                    this.sub_categories = response.data;
                });

        },
        save() {

            let formData = new FormData(document.getElementById("supplier_form"));
            axios.post('/suppliers', formData
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
                    axios.delete('/suppliers/' + id)
                        .then((response) => {
                            this.load();
                            swal.fire("تم الحذف", "تم الحذف بنجاح", "success");
                        }).catch(() => {
                        swal("فشل", "هناك خطا ما ", "error");
                    })
                }
            })
        },
        edit(supplier) {
            this.errors = [];
            $('#kt_modal_4').modal('show');
            this.supplier.name = supplier.name;
            this.supplier.id = supplier.id;
            axios.get('get-sub-category-suppliers/' + supplier.id)
                .then(response => {
                    this.Supplier_sub_categories = response.data;


                });
            for (var i = 0; i <= this.Supplier_sub_categories.length; i++) {
                console.log(this.Supplier_sub_categories[i])
            }
            this.sub_category_selected = true;

            this.editMode = true;
        },
        update(id) {
            this.errors = [];
            let formData = new FormData(document.getElementById("supplier_form"));
            axios.post('/suppliers/update/' + id, formData).then((response) => {
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
            axios.post('/main-categories/disable/' + id
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
            axios.post('/main-categories/active/' + id
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
        CheckCategoryInSupplier(id) {
            this.Supplier_sub_categories.forEach((sub) => {
                if (sub == id) {
                    this.selected = true;
                } else {
                    this.selected = false;


                }
            });

            return this.selected;
        }
        ,
        CheckPremission(Permissions) {
            if (window.App.permissions.includes(Permissions) ) {
                return true;
            }
        },
        reset_modal() {
            this.editMode=false;

            this.supplier = {
                id: '',
                name: '',
                sub_categories: [],
            }
            this.Supplier_sub_categories=[];
            this.errors=[];
        }
    },
}
</script>
